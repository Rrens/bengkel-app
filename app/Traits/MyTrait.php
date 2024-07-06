<?php

namespace App\Traits;

use App\Models\ProductItems;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait MyTrait
{
    public function minmax($item_id = null, $jumlah = null, $date = null)
    {
        try {
            $today = date("Y-m-d");
            $current = Carbon::now()->format('m');

            $jum_hari = DB::table('history')
                ->select(DB::raw('DAY(LAST_DAY(date)) as jum_hari'))
                ->whereMonth('date', Carbon::parse($date)->format('m'))
                ->whereNull('deleted_at')
                ->get();

            foreach ($jum_hari as $data) {
                $jum_hari = $data->jum_hari;
            }

            $hitung = DB::table('history')
                //->select(DB::raw('MAX(total) as besar, ceil(SUM(total)/30) as rata'))
                ->selectRaw('MAX(total) as terbesar, SUM(total) as rata')
                ->whereMonth('date', Carbon::parse($date)->format('m'))
                ->where('item_id', $item_id)
                ->whereNull('deleted_at')
                ->get();


            foreach ($hitung as $data) {
                $rata = (int) $data->rata;
                $terbesar = $data->terbesar;
            }

            $data_stok = ProductItems::where('id', $item_id)
                ->get();

            foreach ($data_stok as $data) {
                $dt_stok =  $data->stock;
                $time =  $data->lead_time;
            }

            // dd($jum_hari);
            $rata2 = ceil($rata / $jum_hari);

            $cek = ceil($dt_stok - $jumlah);

            //ss=(maksimum permintaan - rata2 permintaan K ) x lead time W
            $ss = ($terbesar - $rata2) * $time;

            //min = (K x W) + SS
            $min = ceil(($rata2 * $time) + $ss);

            //max = (2x(K x W)) + SS
            $max = ceil((2 * ($rata2 * $time)) + $ss);

            // = max - min
            $Q = ceil($max - $min);

            $tgl = DB::table('history')
                ->select(DB::raw('COUNT(date) as tgl'))
                ->whereMonth('date', Carbon::parse($date)->format('m'))
                ->whereNull('deleted_at')
                ->get();


            foreach ($tgl as $data) {
                $tgl = $data->tgl;
            }

            $part = DB::table('history')
                ->select(DB::raw('COUNT(item_id) as part'))
                ->where('item_id', $item_id)
                ->whereMonth('date', Carbon::parse($date)->format('m'))
                ->whereNull('deleted_at')
                ->get();
            foreach ($part as $data) {
                $part = $data->part;
            }

            if ($tgl == 0) {

                if ($cek < 0) {
                    return back()->withErrors('Stock Tidak Mencukupi ' . $Q . '');
                } else if ($cek > $min) {

                    // INSERT IKI
                    // DB::table('history')
                    //     ->whereNull('deleted_at')
                    //     ->insert([
                    //         'date' => $today,
                    //         'item_id' => $item_id,
                    //         'total' => $jumlah
                    //     ]);
                } else if ($cek < $ss) {
                    if ($dt_stok <= $ss) {
                        return back()->withErrors('Sudah Mencapai Safety Stock Tidak Dapat Dilayani');
                    } else {

                        $sisa = $dt_stok - $ss;

                        return back()->withSuccess('Sudah Mencapai Safety Stock, Hanya Dapat Dilayani ' . $sisa . ' Item');
                    }
                } else {

                    return back()->with('toast_success', 'Minimal Stock, Waktunya Restock Spare Part');
                }
            } else {

                ///CEK HISTORY PART ADA TIDAK

                if ($part >= 1) {
                    if ($cek < 0) {
                        return back()->withSuccess('Stock Tidak Mencukupi');
                    } else if ($cek > $min) {
                        $up = DB::table('history')
                            ->whereMonth('date', Carbon::parse($date)->format('m'))
                            ->where('item_id', $item_id)
                            ->sum('total');
                        // dd($up, $date, $item_id);
                        // ->get();
                        // foreach ($up as $data) {
                        //     $total = $data->total;
                        // }
                        $total = $up;

                        // $hasil = $total + $jumlah;
                        // dd($up);

                        // dd('ini');
                        DB::table('history')
                            ->whereMonth('date', Carbon::parse($date)->format('m'))
                            ->where('item_id', $item_id)
                            ->update(
                                [
                                    // 'total' => $hasil
                                    'result_total' => $total
                                ]
                            );

                        return back()->with('toast_success', 'Data Berhasil Disimpan');
                    } else if ($cek < $ss) {
                        if ($dt_stok <= $ss) {
                            return back()->withErrors('Sudah Mencapai Safety Stock Tidak Dapat Dilayani');
                        } else {
                            $sisa1 = $dt_stok - $ss;

                            $up12 = DB::table('history')
                                ->select("*")
                                ->whereMonth('date', Carbon::parse($date)->format('m'))
                                ->where('item_id', $item_id)
                                ->sum('total');
                            // foreach ($up12 as $data) {
                            //     $total12 = $data->total;
                            // }
                            $hasil12 = $up12 + $sisa1;

                            DB::table('history')
                                ->whereMonth('date', Carbon::parse($date)->format('m'))
                                ->where('item_id', $item_id)
                                ->update(
                                    [
                                        'result_total' => $hasil12
                                    ]
                                );

                            return back()->withSuccess('Sudah Mencapai Safety Stock, Hanya Dapat Dilayani ' . $sisa1 . ' Item');
                        }
                    } else {
                        $up1 = DB::table('history')
                            ->select("*")
                            ->whereMonth('date', Carbon::parse($date)->format('m'))
                            ->where('item_id', $item_id)
                            ->sum('total');
                        // foreach ($up1 as $data) {
                        //     $total1 = $data->total;
                        // }
                        $hasil1 = $up1 + $jumlah;

                        DB::table('history')
                            ->whereMonth('date', Carbon::parse($date)->format('m'))
                            ->where('item_id', $item_id)
                            ->update(
                                [
                                    'result_total' => $hasil1
                                ]
                            );

                        return back()->with('toast_success', 'Minimal Stock, Waktunya Restock Spare Part');
                    }


                    ///TIDAK ADA PART YA INPUT
                } else {

                    if ($cek < 0) {
                        return back()->withSuccess('Stock Tidak Mencukupi');
                    } else if ($cek > $min) {
                        return back()->with('toast_success', 'Data Berhasil Disimpan');
                    } else if ($cek <= $ss) {
                        return back()->withWarning('Sudah Mencapai Safety Stock');
                    } else {

                        return back()->with('toast_success', 'Sudah Mencapai Minimal Stock');
                    }
                }
            }
        } catch (Exception $error) {
            dd($error->getMessage(), $error);
        }
    }
}
