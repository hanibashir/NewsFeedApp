<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Item;

class HomeController extends Controller
{

    public function index()
    {
        return view('index', [
            'items' => Item::latest()->filter(request(['category', 'source']))->simplePaginate(15)
        ]);
    }

    public function showItem(Item $item)
    {
        return view('items.item', ['item' => $item]);
    }

}
