<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Laporan\PembelianController as LaporanPembelianController;
use App\Http\Controllers\Laporan\PenerimaanController as LaporanPenerimaanController;
use App\Http\Controllers\Laporan\TransactionServiceController;
use App\Http\Controllers\MinMax\PeriodeController;
use App\Http\Controllers\MinMax\RealtimeController;
use App\Http\Controllers\Restcok\PembelianController;
use App\Http\Controllers\Restcok\PenerimaanController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('spare-part', [SparePartController::class, 'index'])->name('sparepart.index');

Route::group([
    'prefix' => 'restock'
], function () {
    Route::get('pembelian', [PembelianController::class, 'index'])->name('restock.pembelian.index');
    Route::get('penerimaan', [PenerimaanController::class, 'index'])->name('restock.penerimaan.index');
});

Route::get('transaction', [TransaksiServiceController::class, 'index'])->name('transaction-service.index');

Route::group([
    'prefix' => 'min-max',
], function () {
    Route::get('real-time', [RealtimeController::class, 'index'])->name('min-max.realtime.index');
    Route::get('periode', [PeriodeController::class, 'index'])->name('min-max.periode.index');
});

Route::group([
    'prefix' => 'laporan'
], function () {
    Route::get('transaction-service', [TransactionServiceController::class, 'index'])->name('laporan.transaction.index');
    Route::get('pembelian', [LaporanPembelianController::class, 'index'])->name('laporan.pembelian.index');
    Route::get('penerimaan', [LaporanPenerimaanController::class, 'index'])->name('laporan.penerimaan.index');
});
