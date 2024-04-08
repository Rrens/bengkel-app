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

        $year = $this->year();
        return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data', 'year'));
    }

    public function filter($month, $tahun)
    {
        $active = 'laporan';
        $active_detail = 'pembelian';

        $data = $this->data($month, $tahun);
        $year = $this->year();

        return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data', 'month', 'tahun', 'year'));
    }

    public function data($month, $year)
    {
        $query = DB::table('pembelians as p')
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
            ->groupBy('pi.id');

        if (!empty($month)) {
            $query->whereMonth('p.tanggal_pembelian', $month);
        }

        if (!empty($year)) {
            $query->whereYear('p.tanggal_pembelian', $year);
        }

        if (!empty($year) && !empty($month)) {
            $query->whereYear('p.tanggal_pembelian', $year)
                ->whereMonth('p.tanggal_pembelian', $month);
        }

        $data = $query->get();
        return $data;
    }

    public function year()
    {
        $year = DB::table('pembelians')
            ->selectRaw('YEAR(tanggal_pembelian) as year')
            ->groupBy('year')
            ->pluck('year');

        return $year;
    }
}
