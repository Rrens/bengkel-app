<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiServiceController extends Controller
{
    public function index()
    {
        $active = 'transaksi service';
        $active_detail = '';
        return view('pages.transaksi-service', compact('active', 'active_detail'));
    }
}
