<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function data($month = null)
    {
        if ($month == null) {
            $data = DB::table('penerimaans as pn')
                ->join('pembelians as pb', 'pb.id', '=', 'pn.pembelian_id')
                ->join('suppliers as s', 'pb.supplier_id', '=', 's.id')
                ->join('product_items as pi', 'pi.id', '=', 'pb.item_id')
                ->select('pb.tanggal_pembelian', 'pn.tanggal_penerimaan', 's.name as supplier', 'pi.name as product', 'pb.jumlah_pembelian', 'jumlah_penerimaan')
                ->get();
        } else {
            $data = DB::table('penerimaans as pn')
                ->join('pembelians as pb', 'pb.id', '=', 'pn.pembelian_id')
                ->join('suppliers as s', 'pb.supplier_id', '=', 's.id')
                ->join('product_items as pi', 'pi.id', '=', 'pb.item_id')
                ->whereMonth('pn.tanggal_penerimaan', $month)
                ->select('pb.tanggal_pembelian', 'pn.tanggal_penerimaan', 's.name as supplier', 'pi.name as product', 'pb.jumlah_pembelian', 'jumlah_penerimaan')
                ->get();
        }

        return $data;
    }

    public function index()
    {
        $active = 'laporan';
        $active_detail = 'penerimaan';

        $data = $this->data();
        // dd($data);
        return view('pages.Laporan.Penerimaan', compact('active', 'active_detail', 'data'));
    }

    public function filter($month)
    {
        $active = 'laporan';
        $active_detail = 'penerimaan';

        $data = $this->data($month);
        return view('pages.Laporan.Penerimaan', compact('active', 'active_detail', 'data', 'month'));
    }
}
