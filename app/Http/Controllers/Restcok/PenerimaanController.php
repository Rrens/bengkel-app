<?php

namespace App\Http\Controllers\Restcok;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use App\Models\Penerimaan;
use App\Models\ProductItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PenerimaanController extends Controller
{
    public function index()
    {
        $active = 'restock';
        $active_detail = 'penerimaan';
        $data = DB::table('penerimaans as pn')
            ->join('pembelians as pb', 'pb.id', '=', 'pn.pembelian_id')
            ->join('suppliers as s', 's.id', '=', 'pb.supplier_id')
            ->join('product_items as pi', 'pi.id', '=', 'pb.item_id')
            ->select(
                'pb.id as id_pembelian',
                'pn.id as id_penerimaan',
                's.name as supplier_name',
                'pi.name as item_name',
                'pn.tanggal_penerimaan',
                'pb.tanggal_pembelian',
                'pn.jumlah_penerimaan',
                'pb.jumlah_pembelian',
            )
            ->whereNull('pb.deleted_at')
            ->whereNull('pn.deleted_at')
            ->get();
        return view('pages.restock.penerimaan', compact('active', 'active_detail', 'data'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pembelian' => 'required|exists:pembelians,id',
            'id' => 'required|exists:penerimaans,id',
            'jumlah_pembelian' => 'required|numeric',
            'jumlah_penerimaan' => 'required|numeric|lte:jumlah_pembelian',
            'tanggal_pembelian' => 'required|date',
            'tanggal_penerimaan' => 'required|date|after:tanggal_pembelian'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);

        $data = Penerimaan::findOrFail($request->id);
        $data->fill($request->all());
        $data->save();

        $item = ProductItems::findOrFail(Pembelian::where('id', $request->id_pembelian)->first()['item_id']);
        $item->stock += $request->jumlah_penerimaan;
        $item->save();

        Alert::toast('Sukses Merubah', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penerimaan' => 'required|exists:penerimaans,id',
            'id_pembelian' => 'required|exists:pembelians,id'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }


        $penerimaan = Penerimaan::where('id', $request->id_penerimaan)->first();
        $item = ProductItems::findOrFail(Pembelian::where('id', $request->id_pembelian)->first()['item_id']);
        // dd($item, $penerimaan->jumlah_penerimaan);
        $item->stock -= $penerimaan->jumlah_penerimaan;
        $item->save();

        Pembelian::where('id', $request->id_pembelian)->delete();
        $penerimaan->delete();


        Alert::toast('Sukses Menghapus', 'success');
        return back();
    }
}
