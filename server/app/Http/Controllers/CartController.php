<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\AquariumItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CartController extends Controller
{
    protected $middleware = ['auth'];

    public function count(): JsonResponse
    {
        $count = Cart::where('user_id', auth()->id())->sum('quantity');
        
        return response()->json([
            'count' => $count
        ]);
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'item_id' => 'required|exists:aquarium_items,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $item = AquariumItem::findOrFail($request->item_id);

        if ($item->total_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available.',
            ], 400);
        }

        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'aquarium_item_id' => $request->item_id,
            ],
            [
                'quantity' => $request->quantity,
                'price' => $item->price,
            ]
        );

        // Get total cart items count
        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully!',
            'cart_count' => $cartCount,
        ]);
    }

    public function index()
    {
        $cartItems = Cart::with('aquariumItem')
            ->where('user_id', auth()->id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function update(Request $request, Cart $cart): JsonResponse
    {
        if ($cart->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        if ($cart->aquariumItem->total_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available.',
            ], 400);
        }

        $cart->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
        ]);
    }

    public function remove(Cart $cart): JsonResponse
    {
        if ($cart->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $cart->delete();

        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cart_count' => $cartCount,
        ]);
    }

    public function checkout()
    {
        $cartItems = Cart::with('aquariumItem')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        // Convert to cents for Stripe
        $amountInCents = (int) (($total * 1.08) * 100); // Including tax

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Fin Flora Order',
                        ],
                        'unit_amount' => $amountInCents,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('cart.index'),
            ]);

            return redirect($session->url, 303);

        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Unable to create checkout session: ' . $e->getMessage());
        }
    }
}
