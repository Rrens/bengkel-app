<?php

namespace App\Http\Controllers\MinMax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RealtimeController extends Controller
{
    public function index()
    {
        $active = 'min-max';
        $active_detail = 'realtime';
        return view('pages.transaksi-service', compact('active', 'active_detail'));
    }
}
