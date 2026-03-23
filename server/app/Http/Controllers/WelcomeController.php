<?php

namespace App\Http\Controllers;

use App\Models\AquariumItem;

class WelcomeController extends Controller
{
    public function index()
    {
        $items = AquariumItem::with(['fish', 'plants'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('welcome', compact('items'));
    }
}
