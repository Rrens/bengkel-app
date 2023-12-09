<?php

namespace App\Http\Controllers\Restcok;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    public function index()
    {
        $active = 'restock';
        $active_detail = 'penerimaan';
        return view('pages.restock.penerimaan', compact('active', 'active_detail'));
    }
}
