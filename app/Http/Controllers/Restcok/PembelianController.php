<?php

namespace App\Http\Controllers\Restcok;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Penerimaan;
use App\Models\ProductItems;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $data = Pembelian::with('supplier', 'item')->get();
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_pembelian' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'item_id' => 'required|exists:product_items,id',
            'stock' => 'required|exists:product_items,stock',
            'jumlah_pembelian' => 'required|lte:stock',
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

        Alert::toast('Sukses Menyimpan', 'succes');
        return back();
    }

    public function update(Request $request)
    {
        //
    }
}
