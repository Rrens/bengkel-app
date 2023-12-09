<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesInController extends Controller
{
    public function index()
    {
        $active = 'transaction';
        $active_detail = 'sales-in';
        return view('pages.Transaction.sales-in
        ', compact('active', 'active_detail'));
    }
}
