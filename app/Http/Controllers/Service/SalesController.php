<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $active = 'transaction';
        $active_detail = 'sales';
        return view('pages.Transaction.sales', compact('active', 'active_detail'));
    }
}
