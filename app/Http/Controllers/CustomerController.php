<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $active = 'customer';
        $active_detail = '';
        return view('pages.customer', compact('active', 'active_detail'));
    }
}
