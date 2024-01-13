<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class TransactionServiceController extends Controller
{
    public function index()
    {
        $active = 'laporan';
        $active_detail = 'transaction service';
        $data = Sale::with('customer', 'user')->get();
        $data_detail = SaleDetail::with('item')->get();
        // dd($data, $data_detail);
        return view('pages.Laporan.Transaksi', compact(
            'active',
            'active_detail',
            'data',
            'data_detail',
        ));
    }

    public function filter_month($month)
    {
        $active = 'laporan';
        $active_detail = 'transaction service';
        $data = Sale::with('customer', 'user')->whereMonth('date', $month)->get();
        $data_detail = SaleDetail::with('item')->get();
        return view('pages.Laporan.Transaksi', compact(
            'active',
            'active_detail',
            'data',
            'data_detail',
            'month'
        ));
    }

    public function print($id)
    {
        $data = Sale::where('id', $id)->with('customer', 'user')->first();
        $data_detail = SaleDetail::where('sale_id', $id)->with('item')->get();
        // dd($data);
        return view('pages.Laporan.print', compact('data', 'data_detail'));
    }
}
