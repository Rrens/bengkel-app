<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $active = 'laporan';
        $active_detail = 'pembelian';

        $data = Pembelian::with('supplier', 'item')->get();
        return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data'));
    }

    public function filter($month)
    {
        $active = 'laporan';
        $active_detail = 'pembelian';

        $data = Pembelian::with('supplier', 'item')
            ->whereMonth('tanggal_pembelian', $month)
            ->get();
        return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data', 'month'));
    }
}
