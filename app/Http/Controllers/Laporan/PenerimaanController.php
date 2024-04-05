<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function year()
    {
        $year = DB::table('penerimaans')
            ->selectRaw('YEAR(tanggal_penerimaan) as year')
            ->groupBy('year')
            ->pluck('year');

        return $year;
    }

    // public function data($month = null)
    // {
    //     if ($month == null) {
    //         $data = DB::table('penerimaans as pn')
    //             ->join('penerimaan_details as pnd', 'pnd.penerimaan_id', '=', 'pn.id')
    //             ->join('pembelians as pb', 'pb.id', '=', 'pn.pembelian_id')
    //             ->join('pembelian_details as pd', 'pb.id', '=', 'pd.pembelian_id')
    //             ->join('suppliers as s', 'pb.supplier_id', '=', 's.id')
    //             ->join('product_items as pi', 'pi.id', '=', 'pd.item_id')
    //             ->select(
    //                 'pb.tanggal_pembelian',
    //                 'pn.tanggal_penerimaan',
    //                 's.name as supplier',
    //                 'pi.name as product',
    //                 'pd.jumlah_pembelian',
    //                 // 'pnd.jumlah_penerimaan'
    //             )
    //             ->selectRaw('COUNT(pnd.jumlah_penerimaan) as jumlah_penerimaan')
    //             ->groupBy('pn.tanggal_penerimaan')
    //             ->groupBy('pd.item_id')
    //             ->get();
    //         // dd($data);
    //     } else {
    //         $data = DB::table('penerimaans as pn')
    //             ->join('penerimaan_details as pnd', 'pnd.penerimaan_id', '=', 'pn.id')
    //             ->join('pembelians as pb', 'pb.id', '=', 'pn.pembelian_id')
    //             ->join('pembelian_details as pd', 'pb.id', '=', 'pd.pembelian_id')
    //             ->join('suppliers as s', 'pb.supplier_id', '=', 's.id')
    //             ->join('product_items as pi', 'pi.id', '=', 'pd.item_id')
    //             ->whereMonth('pn.tanggal_penerimaan', $month)
    //             ->select(
    //                 'pb.tanggal_pembelian',
    //                 'pn.tanggal_penerimaan',
    //                 's.name as supplier',
    //                 'pi.name as product',
    //                 'pd.jumlah_pembelian',
    //                 // 'pnd.jumlah_penerimaan'
    //             )
    //             ->groupBy('pn.tanggal_penerimaan')
    //             ->groupBy('pd.item_id')
    //             ->selectRaw('COUNT(pnd.jumlah_penerimaan) as jumlah_penerimaan')
    //             ->get();
    //     }

    //     return $data;
    // }

    public function index()
    {
        $active = 'laporan';
        $active_detail = 'penerimaan';

        // $data = $this->data();
        $data = DB::table('penerimaans as pn')
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
                ->selectRaw('pnd.jumlah_penerimaan')
                ->groupBy('pn.tanggal_penerimaan')
                ->groupBy('pd.item_id')
                ->get();
        // dd($data);
        $year = $this->year();
        return view('pages.Laporan.Penerimaan', compact(
            'active',
            'active_detail',
            'data',
            'year'));
    }

    public function filter($month, $year)
    {
        $active = 'laporan';
        $active_detail = 'penerimaan';

        if ($month == 'all' && $year == 'all') {
            $data = DB::table('penerimaans as pn')
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
                ->selectRaw('pnd.jumlah_penerimaan')
                ->groupBy('pn.tanggal_penerimaan')
                ->groupBy('pd.item_id')
                ->get();
        }

        if ($month == 'all' && $year != 'all') {
            $data = DB::table('penerimaans as pn')
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
                ->where(DB::raw('YEAR(tanggal_penerimaan)'), '=', $year)
                ->selectRaw('pnd.jumlah_penerimaan')
                ->groupBy('pn.tanggal_penerimaan')
                ->groupBy('pd.item_id')
                ->get();
        }

        if ($month != 'all' && $year == 'all') {
            $data = DB::table('penerimaans as pn')
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
                ->whereMonth('tanggal_penerimaan', $month)
                ->selectRaw('pnd.jumlah_penerimaan')
                ->groupBy('pn.tanggal_penerimaan')
                ->groupBy('pd.item_id')
                ->get();
        }

        if ($month != 'all' && $year != 'all') {
            $data = DB::table('penerimaans as pn')
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
                ->whereMonth('tanggal_penerimaan', $month)
                ->where(DB::raw('YEAR(tanggal_penerimaan)'), '=', $year)
                ->selectRaw('pnd.jumlah_penerimaan')
                ->groupBy('pn.tanggal_penerimaan')
                ->groupBy('pd.item_id')
                ->get();
        }

        $year = $this->year();
        return view('pages.Laporan.Penerimaan', compact(
            'active',
            'active_detail',
            'data',
            'month',
            'year'));
    }
}
