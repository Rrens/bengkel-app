<?php

use App\Http\Controllers\AuthController;
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
// use App\Http\Controllers\Service\SalesInController;
// use App\Http\Controllers\Service\SalesOutController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiServiceController;
use Illuminate\Support\Facades\Auth;
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

Route::redirect('', 'auth/login');

Route::redirect('daftar', 'auth/register');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::get('login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('login', [AuthController::class, 'post_login'])->name('auth.post-login');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'store'])->name('register.store');
    Route::post('register/update', [AuthController::class, 'update'])->name('register.update');
    Route::post('register/delete', [AuthController::class, 'delete'])->name('register.delete');
});

Route::group(
    [
        'middleware' => ['auth']
    ],
    function () {

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
                Route::post('', [PembelianController::class, 'store'])->name('restock.pembelian.store');
                Route::post('update', [PembelianController::class, 'update'])->name('restock.pembelian.update');
                Route::post('delete', [PembelianController::class, 'delete'])->name('restock.pembelian.delete');
                Route::post('store-pembelian', [PembelianController::class, 'store_pembelian'])->name('restock.pembelian.store-pembelian');
            });

            Route::group([
                'prefix' => 'penerimaan'
            ], function () {
                Route::get('', [PenerimaanController::class, 'index'])->name('restock.penerimaan.index');
                Route::post('update', [PenerimaanController::class, 'update'])->name('restock.penerimaan.update');
                Route::post('delete', [PenerimaanController::class, 'delete'])->name('restock.penerimaan.delete');
            });
        });

        // Route::get('transaction', [TransaksiServiceController::class, 'index'])->name('transaction-service.index');
        Route::group([
            'prefix' => 'transaction'
        ], function () {
            Route::group([
                'prefix' => 'sales'
            ], function () {
                Route::get('', [SalesController::class, 'index'])->name('service.sales.index');
                Route::get('cart-data', [SalesController::class, 'cart_data'])->name('cart-data');
                Route::post('add-cart', [SalesController::class, 'add_cart'])->name('service.sales.add-cart');
                Route::post('delete', [SalesController::class, 'delete'])->name('service.sales.delete');
                Route::post('update', [SalesController::class, 'update'])->name('service.sales.update');
                Route::post('store-sales', [SalesController::class, 'store_sale'])->name('service.sales.store-sales');
                Route::post('cancel-sales', [SalesController::class, 'cancel_sale'])->name('service.sales.cancel-sales');
                Route::get('print/{id}', [SalesController::class, 'print'])->name('service.sales.print');

                Route::get('check-min-stock/{id}', [SalesController::class, 'check_min_stock']);

                Route::get('data-restock/{item}', [SalesController::class, 'data_restock']);
            });
        });

        Route::group([
            'prefix' => 'min-max',
        ], function () {
            Route::get('real-time', [RealtimeController::class, 'index'])->name('min-max.realtime.index');
            Route::get('periode', [RealtimeController::class, 'next_periode'])->name('min-max.periode.index');
        });

        Route::group([
            'prefix' => 'laporan'
        ], function () {
            Route::group([
                'prefix' => 'transaction-service'
            ], function () {
                Route::get('', [TransactionServiceController::class, 'index'])->name('laporan.transaction.index');
                Route::get('filter/{month}/{year}', [TransactionServiceController::class, 'filter'])->name('laporan.transaction.filter');
                Route::get('print', [TransactionServiceController::class, 'print'])->name('laporan.transaction.print');
                Route::get('print/{month}/{year}', [TransactionServiceController::class, 'print'])->name('laporan.transaction.print-filter');
            });

            Route::group([
                'prefix' => 'pembelian',
            ], function () {
                Route::get('', [LaporanPembelianController::class, 'index'])->name('laporan.pembelian.index');
                Route::get('filter/{month}/{year}', [LaporanPembelianController::class, 'filter'])->name('laporan.pembelian.filter');
                Route::get('print', [LaporanPembelianController::class, 'print'])->name('laporan.pembelian.print');
                Route::get('print/{month}/{year}', [LaporanPembelianController::class, 'print'])->name('laporan.pembelian.print-filter');
            });

            Route::group([
                'prefix' => 'penerimaan'
            ], function () {
                Route::get('', [LaporanPenerimaanController::class, 'index'])->name('laporan.penerimaan.index');
                Route::get('filter/{month}/{year}', [LaporanPenerimaanController::class, 'filter'])->name('laporan.penerimaan.filter');
                Route::get('print', [LaporanPenerimaanController::class, 'print'])->name('laporan.penerimaan.print');
                Route::get('print/{month}/{year}', [LaporanPenerimaanController::class, 'print'])->name('laporan.penerimaan.print-filter');
            });
        });
    }
);

Route::get('/data-hitung/{id}', [PembelianController::class, 'data_hitung']);
