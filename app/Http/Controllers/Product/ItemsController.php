<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $active = 'product';
        $active_detail = 'items';
        return view('pages.Product.Items', compact('active', 'active_detail'));
    }
}
