<?php

namespace App\Http\Controllers\Restcok;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $active = 'restock';
        $active_detail = 'pembelian';
        return view('pages.restock.pembelian', compact('active', 'active_detail'));
    }
}
