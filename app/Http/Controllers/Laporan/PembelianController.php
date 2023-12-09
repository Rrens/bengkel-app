<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $active = 'laporan';
        $active_detail = 'pembelian';
        return view('pages.transaksi-service', compact('active', 'active_detail'));
    }
}
