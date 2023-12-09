<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $active = 'supplier';
        $active_detail = '';
        return view('pages.supplier', compact('active', 'active_detail'));
    }
}
