<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $active = 'laporan';
        $active_detail = 'pembelian';

        $data = Pembelian::with('supplier')->get();
        $data_datail = PembelianDetail::with('item')->get();
        // dd($data);
        return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data', 'data_datail'));
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
