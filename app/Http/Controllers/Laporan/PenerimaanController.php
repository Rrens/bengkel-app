<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function data($month = null, $year = null)
    {
        $query = DB::table('penerimaans as pn')
            ->join('penerimaan_details as pnd', 'pnd.penerimaan_id', '=', 'pn.id')
            ->join('pembelians as pb', 'pb.id', '=', 'pn.pembelian_id')
            ->join('pembelian_details as pd', 'pb.id', '=', 'pd.pembelian_id')
            ->join('suppliers as s', 'pb.supplier_id', '=', 's.id')
            ->join('product_items as pi', 'pi.id', '=', 'pd.item_id')
            ->select(
                'pb.tanggal_pembelian',
                'pn.tanggal_penerimaan',
                's.name as supplier',
                'pi.name as product',
                'pd.jumlah_pembelian',
                // 'pnd.jumlah_penerimaan'
            )
            ->selectRaw('COUNT(pnd.jumlah_penerimaan) as jumlah_penerimaan')
            ->groupBy('pn.tanggal_penerimaan')
            ->groupBy('pd.item_id');

        if (!empty($month)) {
            $query->whereMonth('pn.tanggal_penerimaan', $month);
        }

        if (!empty($year)) {
            $query->whereYear('pn.tanggal_penerimaan', $year);
        }

        if (!empty($month) && !empty($year)) {
            $query->whereYear('pn.tanggal_penerimaan', $year)
                ->whereMonth('pn.tanggal_penerimaan', $month);
        }

        $data = $query->get();
        return $data;
    }

    public function year()
    {
        $year = DB::table('penerimaans')
            ->selectRaw('YEAR(tanggal_penerimaan) as year')
            ->groupBy('year')
            ->pluck('year');

        return $year;
    }

    public function index()
    {
        $active = 'laporan';
        $active_detail = 'penerimaan';

        $data = $this->data();
        $year = $this->year();
        // dd($year);
        return view('pages.Laporan.penerimaan.Penerimaan', compact('active', 'active_detail', 'data', 'year'));
    }

    public function filter($month, $tahun)
    {
        $active = 'laporan';
        $active_detail = 'penerimaan';

        $data = $this->data($month, $tahun);
        $year = $this->year();

        return view('pages.Laporan.penerimaan.Penerimaan', compact('active', 'active_detail', 'data', 'month', 'year', 'tahun'));
    }

    public function print($month = null, $year = null)
    {
        if (!isset($month) && !isset($year)) {
            $data = $this->data($month, $year);
        } else {
            $data = $this->data();
        }
        return view('pages.Laporan.penerimaan.print', compact('data'));
    }
}
