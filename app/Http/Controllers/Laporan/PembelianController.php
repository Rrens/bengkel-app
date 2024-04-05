<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{

    public function index()
    {
        $active = 'laporan';
        $active_detail = 'pembelian';
        $data = DB::table('pembelians as p')
            ->join('pembelian_details as pd', 'p.id', '=', 'pd.pembelian_id')
            ->join('product_items as pi', 'pd.item_id', '=', 'pi.id')
            ->join('suppliers as s', 'p.supplier_id', '=', 's.id')
            ->select(
                'p.tanggal_pembelian',
                's.name as supplier_name',
                'pi.name as sparepart',
                'pd.jumlah_pembelian'
            )
            ->groupBy('p.id')
            ->groupBy('pi.id')
            ->get();
        return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data'));
    }

    public function filter($month)
    {
        $active = 'laporan';
        $active_detail = 'pembelian';
        $data = DB::table('pembelians as p')
            ->join('pembelian_details as pd', 'p.id', '=', 'pd.pembelian_id')
            ->join('product_items as pi', 'pd.item_id', '=', 'pi.id')
            ->join('suppliers as s', 'p.supplier_id', '=', 's.id')
            ->select(
                'p.tanggal_pembelian',
                's.name as supplier_name',
                'pi.name as sparepart',
                'pd.jumlah_pembelian'
            )
            ->whereMonth('p.tanggal_pembelian', $month)
            ->groupBy('p.id')
            ->groupBy('pi.id')
            ->get();
        return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data', 'month'));
    }
}
