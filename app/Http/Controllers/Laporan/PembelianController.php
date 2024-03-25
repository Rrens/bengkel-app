<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function year()
    {
        $year = DB::table('pembelians')
            ->selectRaw('YEAR(tanggal_pembelian) as year')
            ->groupBy('year')
            ->pluck('year');

        return $year;
    }

    // public function index()
    // {
    //     $active = 'laporan';
    //     $active_detail = 'pembelian';

    //     // $data = Pembelian::with('supplier')
    //     // ->orderBy('')
    //     // ->get();
    //     $data = DB::table('pembelians as p')
    //         ->join('pembelian_details as pd', 'p.id', '=', 'pd.pembelian_id')
    //         ->join('product_items as pi', 'pd.item_id', '=', 'pi.id')
    //         ->join('suppliers as s', 'p.supplier_id', '=', 's.id')
    //         ->select(
    //             'p.tanggal_pembelian',
    //             's.name as supplier_name',
    //             'pi.name as sparepart',
    //             'pd.jumlah_pembelian'
    //         )
    //         ->groupBy('p.id')
    //         ->groupBy('pi.id')
    //         ->get();
    //     // dd($data);
    //     // $data_datail = PembelianDetail::with('item')->get();
    //     // dd($data);
    //     return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data'));
    // }

    public function index()
    {
        $active = 'laporan';
        $active_detail = 'pembelian';

        // $data = Pembelian::with('supplier')->get();
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

        // $data_detail = PembelianDetail::with('item')->get();
        $year = $this->year();

        // dd($data, $data_detail);
        return view('pages.Laporan.Pembelian', compact(
            'active',
            'active_detail',
            'data',
            // 'data_detail',
            'year'
        ));
    }

    // public function filter($month)
    // {
    //     $active = 'laporan';
    //     $active_detail = 'pembelian';

    //     // $data = Pembelian::with('supplier')
    //     //     ->whereMonth('tanggal_pembelian', $month)
    //     //     ->get();

    //     // $data_datail = PembelianDetail::with('item')->get();

    //     $data = DB::table('pembelians as p')
    //         ->join('pembelian_details as pd', 'p.id', '=', 'pd.pembelian_id')
    //         ->join('product_items as pi', 'pd.item_id', '=', 'pi.id')
    //         ->join('suppliers as s', 'p.supplier_id', '=', 's.id')
    //         ->select(
    //             'p.tanggal_pembelian',
    //             's.name as supplier_name',
    //             'pi.name as sparepart',
    //             'pd.jumlah_pembelian'
    //         )
    //         ->whereMonth('p.tanggal_pembelian', $month)
    //         ->groupBy('p.id')
    //         ->groupBy('pi.id')
    //         ->get();
    //     return view('pages.Laporan.Pembelian', compact('active', 'active_detail', 'data', 'month'));
    // }

    public function filter($month, $year)
    {
        // dd($year);
        $active = 'laporan';
        $active_detail = 'pembelian';

        if ($month == 'all' && $year == 'all') {
            // $data = Pembelian::with('supplier')->get();
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
        }

        if ($month == 'all' && $year != 'all') {
            // $data = Pembelian::with('supplier')->where(DB::raw('YEAR(tanggal_pembelian)'), '=', $year)->get();
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
            ->where(DB::raw('YEAR(tanggal_pembelian)'), '=', $year)
            ->groupBy('p.id')
            ->groupBy('pi.id')
            ->get();
        }

        if ($month != 'all' && $year == 'all') {
            // $data = Pembelian::with('supplier')->whereMonth('tanggal_pembelian', $month)->get();
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
            ->whereMonth('tanggal_pembelian', $month)
            ->groupBy('p.id')
            ->groupBy('pi.id')
            ->get();
        }

        if ($month != 'all' && $year != 'all') {
            // $data = Pembelian::with('supplier')->whereMonth('tanggal_pembelian', $month)->where(DB::raw('YEAR(tanggal_pembelian)'), '=', $year)->get();
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
            ->whereMonth('tanggal_pembelian', $month)
            ->where(DB::raw('YEAR(tanggal_pembelian)'), '=', $year)
            ->groupBy('p.id')
            ->groupBy('pi.id')
            ->get();
        }

        // $data_detail = PembelianDetail::with('item')->get();
        $year = $this->year();
        return view('pages.Laporan.Pembelian', compact(
            'active',
            'active_detail',
            'data',
            // 'data_detail',
            'month',
            'year'
        ));
    }
}
