<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionServiceController extends Controller
{

    public function year()
    {
        $year = DB::table('sales')
            ->selectRaw('YEAR(date) as year')
            ->groupBy('year')
            ->pluck('year');

        return $year;
    }

    public function index()
    {
        $active = 'laporan';
        $active_detail = 'transaction service';
        // $data = Sale::with('customer', 'user')->get();
        $data_detail = SaleDetail::all();
        $year = $this->year();

        // dd($data, $data_detail);
        return view('pages.Laporan.transaksi.Transaksi', compact(
            'active',
            'active_detail',
            // 'data',
            'data_detail',
            'year'
        ));
    }

    public function filter($month, $year)
    {
        $active = 'laporan';
        $active_detail = 'transaction service';
        $tahun = $year;

        if ($month == 'all' && $year == 'all') {
            // $data = Sale::with('customer', 'user')->get();
            $data_detail = SaleDetail::with('item')
                ->get();
        }

        if ($month == 'all' && $year != 'all') {
            // $data = Sale::with('customer', 'user')->where(DB::raw('YEAR(date)'), '=', $year)->get();
            $data_detail = SaleDetail::with('item')
                ->whereHas('sale', function ($query) use ($month, $year) {
                    $query->where(DB::raw('YEAR(date)'), '=', $year);
                })
                ->get();
        }

        if ($month != 'all' && $year == 'all') {
            // $data = Sale::with('customer', 'user')->whereMonth('date', $month)->get();
            $data_detail = SaleDetail::with('item')
                ->whereHas('sale', function ($query) use ($month, $year) {
                    $query->whereMonth('date', $month);
                })->get();
        }

        if ($month != 'all' && $year != 'all') {
            // $data = Sale::with('customer', 'user')->whereMonth('date', $month)->where(DB::raw('YEAR(date)'), '=', $year)->get();
            $data_detail = SaleDetail::with('item')
                ->whereHas('sale', function ($query) use ($month, $year) {
                    $query->whereMonth('date', $month)->where(DB::raw('YEAR(date)'), '=', $year);
                })
                ->get();
        }

        $year = $this->year();
        return view('pages.Laporan.transaksi.Transaksi', compact(
            'active',
            'active_detail',
            // 'data',
            'data_detail',
            'month',
            'year',
            'tahun',
        ));
    }

    public function print($month = null, $year = null)
    {
        if (!isset($month) && !isset($year)) {
            $data =
                SaleDetail::all();
        } else {
            $data = SaleDetail::with('item')
                ->whereHas('sale', function ($query) use ($month, $year) {
                    $query->whereMonth('date', $month)->where(DB::raw('YEAR(date)'), '=', $year);
                })
                ->get();
        }

        return view('pages.Laporan.transaksi.print', compact('data'));
    }
}
