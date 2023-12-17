<?php

namespace App\Http\Controllers\Restcok;

use App\Http\Controllers\Controller;
use App\Models\ProductItems;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $active = 'restock';
        $active_detail = 'pembelian';
        $supplier = Supplier::all();
        $items = ProductItems::all();
        return view('pages.restock.pembelian', compact(
            'active',
            'active_detail',
            'supplier',
            'items',
        ));
    }
}
