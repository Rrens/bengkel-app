<?php

namespace App\Http\Controllers\Restcok;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Penerimaan;
use App\Models\ProductItems;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PembelianController extends Controller
{
    public function index()
    {
        $active = 'restock';
        $active_detail = 'pembelian';
        $supplier = Supplier::all();
        $items = ProductItems::all();
        $data = Pembelian::with('supplier', 'item')
            ->orderBy('tanggal_pembelian', 'desc')
            ->get();
        $date = Carbon::today()->toDateString();

        return view('pages.restock.pembelian', compact(
            'active',
            'active_detail',
            'supplier',
            'items',
            'date',
            'data',
        ));
    }

    public function data_hitung($id)
    {
        $current = Carbon::now()->subMonth(1)->format('m');

        $jum_hari = DB::table('history')
            ->select(DB::raw('DAY(LAST_DAY(date)) as jum_hari'))
            ->whereMonth('date', $current)
            ->where('item_id', $id)
            ->get();
        foreach ($jum_hari as $item) {
            $jum_hari = $item->jum_hari;
        }

        $hitung = DB::table('history')
            ->join("product_items", function ($join) {
                $join->on("product_items.id", "=", "history.item_id");
            })
            //->select(DB::raw('MAX(total) as besar, round(SUM(total)/30) as rata'))
            ->select(DB::raw('*,MAX(total) as besar, SUM(total) as rata'))
            ->whereMonth('date', $current)
            ->where('item_id', $id)
            ->groupBy('product_items.id')
            ->get();


        // dd($data);

        $data_part = DB::table('product_items')
            ->join("history", function ($join) {
                $join->on("product_items.id", "=", "history.item_id");
            })
            ->whereMonth('history.date', $current)
            ->where('product_items.id', $id)
            ->select("product_items.id as id_part", "product_items.name as nm_motor", "product_items.stock as stok", "product_items.lead_time as time")
            ->get();

        // return response()->json($data_part[0]);
        if (empty($data_part[0])) {
            $data = 0;
            return response()->json($data);
        }

        if ($data_part[0]->stok <= ($hitung[0]->besar - ceil($hitung[0]->rata / $jum_hari)) * $data_part[0]->time) {
            $data = ceil($hitung[0]->rata / $jum_hari) * $data_part[0]->time * 2 + ($hitung[0]->besar - ceil($hitung[0]->rata / $jum_hari)) * $data_part[0]->time - (ceil($hitung[0]->rata / $jum_hari) * $data_part[0]->time + ($hitung[0]->besar - ceil($hitung[0]->rata / $jum_hari)) * $data_part[0]->time);
        } elseif (
            $data_part[0]->stok <=
            ceil($hitung[0]->rata / $jum_hari) * $data_part[0]->time +
            ($hitung[0]->besar - ceil($hitung[0]->rata / $jum_hari)) * $data_part[0]->time
        ) {
            $data = ceil($hitung[0]->rata / $jum_hari) * $data_part[0]->time * 2 + ($hitung[0]->besar - ceil($hitung[0]->rata / $jum_hari)) * $data_part[0]->time - (ceil($hitung[0]->rata / $jum_hari) * $data_part[0]->time + ($hitung[0]->besar - ceil($hitung[0]->rata / $jum_hari)) * $data_part[0]->time);
        } else {
            $data = 0;
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_pembelian' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:product_items,id',
            'stock' => 'required|exists:product_items,stock',
            'jumlah_pembelian' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);
        $pembelian = new Pembelian();
        $pembelian->fill($request->all());
        $pembelian->save();

        $penerimaan = new Penerimaan();
        $penerimaan->pembelian_id = $pembelian->id;
        $penerimaan->save();

        Alert::toast('Sukses Menyimpan', 'success');
        return back();
    }

    public function update(Request $request)
    {
        //
    }
}
