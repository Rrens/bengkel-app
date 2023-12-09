<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
    public function index()
    {
        $active = 'spare part';
        $active_detail = '';
        return view('pages.sparepart', compact('active', 'active_detail'));
    }
}
