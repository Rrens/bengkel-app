<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Laporan\PembelianController as LaporanPembelianController;
use App\Http\Controllers\Laporan\PenerimaanController as LaporanPenerimaanController;
use App\Http\Controllers\Laporan\TransactionServiceController;
use App\Http\Controllers\MinMax\PeriodeController;
use App\Http\Controllers\MinMax\RealtimeController;
use App\Http\Controllers\Product\CategoriesController;
use App\Http\Controllers\Product\ItemsController;
use App\Http\Controllers\Restcok\PembelianController;
use App\Http\Controllers\Restcok\PenerimaanController;
use App\Http\Controllers\Service\SalesController;
use App\Http\Controllers\Service\SalesInController;
use App\Http\Controllers\Service\SalesOutController;
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

Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');

Route::group([
    'prefix' => 'customer'
], function () {
    Route::get('', [CustomerController::class, 'index'])->name('customer.index');
    Route::post('', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('update', [CustomerController::class, 'update'])->name('customer.update');
    Route::post('delete', [CustomerController::class, 'delete'])->name('customer.delete');
});

Route::group([
    'prefix' => 'supplier'
], function () {
    Route::get('', [SupplierController::class, 'index'])->name('supplier.index');
    Route::post('', [SupplierController::class, 'store'])->name('supplier.store');
    Route::post('update', [SupplierController::class, 'update'])->name('supplier.update');
    Route::post('delete', [SupplierController::class, 'delete'])->name('supplier.delete');
});

Route::group([
    'prefix' => 'products'
], function () {
    Route::group([
        'prefix' => 'categories'
    ], function () {
        Route::get('', [CategoriesController::class, 'index'])->name('product.categories.index');
        Route::post('', [CategoriesController::class, 'store'])->name('product.categories.store');
        Route::post('update', [CategoriesController::class, 'update'])->name('product.categories.update');
        Route::post('delete', [CategoriesController::class, 'delete'])->name('product.categories.delete');
    });

    Route::group([
        'prefix' => 'items'
    ], function () {
        Route::get('', [ItemsController::class, 'index'])->name('product.items.index');
        Route::post('', [ItemsController::class, 'store'])->name('product.items.store');
        Route::post('update', [ItemsController::class, 'update'])->name('product.items.update');
        Route::post('delete', [ItemsController::class, 'delete'])->name('product.items.delete');
    });
});

Route::group([
    'prefix' => 'restock'
], function () {
    Route::group([
        'prefix' => 'pembelian',
    ], function () {
        Route::get('', [PembelianController::class, 'index'])->name('restock.pembelian.index');
    });
    Route::get('penerimaan', [PenerimaanController::class, 'index'])->name('restock.penerimaan.index');
});

Route::get('transaction', [TransaksiServiceController::class, 'index'])->name('transaction-service.index');
Route::group([
    'prefix' => 'transaction'
], function () {
    Route::group([
        'prefix' => 'sales'
    ], function () {
        Route::get('', [SalesController::class, 'index'])->name('service.sales.index');
    });
    // Route:group([
    //     'prefix' => 'sales-in'
    // ])
    // Route::get('sales-in', [SalesInController::class, 'index'])->name('service.sales-in.index');
    // Route::get('sales-out', [SalesOutController::class, 'index'])->name('service.sales-out.index');
});

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
