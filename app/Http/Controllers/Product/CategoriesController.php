<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $active = 'product';
        $active_detail = 'categories';
        return view('pages.Product.Categories', compact('active', 'active_detail'));
    }
}
