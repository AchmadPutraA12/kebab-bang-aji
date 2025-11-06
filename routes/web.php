<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductStockController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Kasir\KasirController;
use App\Http\Controllers\Kasir\StockKasirController;
use App\Http\Middleware\CategoryMiddleware;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthenticatedSessionController::class, 'index'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

Route::middleware([CategoryMiddleware::class . ':1'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/data', [AdminController::class, 'ajaxData'])->name('dashboard.data');

        Route::prefix('category-admin')->name('category-admin.')->group(function () {
            Route::get('/', [CategoryAdminController::class, 'index'])->name('index');
            Route::get('/create', [CategoryAdminController::class, 'create'])->name('create');
            Route::post('/store', [CategoryAdminController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CategoryAdminController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CategoryAdminController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoryAdminController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('branch')->name('branch.')->group(function () {
            Route::get('/', [BranchController::class, 'index'])->name('index');
            Route::post('/store', [BranchController::class, 'store'])->name('store');
            Route::delete('/{id}', [BranchController::class, 'destroy'])->name('destroy');
            Route::put('/{id}', [BranchController::class, 'update'])->name('update');
        });

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
            Route::put('/{id}/update-branch', [UserController::class, 'updateBranch'])->name('update-branch');
        });

        Route::prefix('category-product')->name('category-product.')->group(function () {
            Route::get('/', [CategoryProductController::class, 'index'])->name('index');
            Route::post('/store', [CategoryProductController::class, 'store'])->name('store');
            Route::put('/{id}', [CategoryProductController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoryProductController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('update');
            Route::put('/updateStock/{id}', [ProductController::class, 'updateStock'])->name('updateStock');
            Route::get('/{product}/stock/{branch}', [ProductController::class, 'getStock'])->name('getStock');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('product-stock')->name('product-stock.')->group(function () {
            Route::get('/', [ProductStockController::class, 'index'])->name('index');
        });

        Route::prefix('recommendation-product-stock')->name('recommendation-product-stock.')->group(function () {
            Route::get('/', [ProductStockController::class, 'indexRecommendation'])->name('index');
        });

        Route::prefix('history-product-stock')->name('history-product-stock.')->group(function () {
            Route::get('/in', [ProductStockController::class, 'indexHistoryIn'])->name('indexHistoryIn');
            Route::get('/out', [ProductStockController::class, 'indexHistoryOut'])->name('indexHistoryOut');
        });

        Route::prefix('transaction')->name('transaction.')->group(function () {
            Route::get('/', [TransactionController::class, 'index'])->name('index');
            Route::get('/{id}', [TransactionController::class, 'show'])->name('show');
        });
    });
});

Route::middleware([CategoryMiddleware::class . ':2'])->group(function () {
    Route::prefix('kasir')->name('kasir.')->group(function () {
        Route::get('/', [KasirController::class, 'index'])->name('index');
        Route::post('/', [KasirController::class, 'store'])->name('checkout');
        Route::get('/{id}', [KasirController::class, 'show'])->name('show');
    });

    Route::prefix('stok-kasir')->name('stok-kasir.')->group(function () {
        Route::get('/', [StockKasirController::class, 'index'])->name('index');
        Route::post('/', [StockKasirController::class, 'store'])->name('store');
    });
});

Route::get('/test-printer', function () {
    try {
        // Deteksi sistem operasi
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Jalankan di Windows (kasir lokal)
            $connector = new WindowsPrintConnector("POS-58");
        } else {
            // Jalankan di Linux (server) -> fallback ke file spool
            $spoolPath = "/var/spool/samba/print-job-" . time() . ".txt";
            $connector = new FilePrintConnector($spoolPath);
        }

        // Buat instance printer
        $printer = new Printer($connector);

        // Isi struk tes
        $printer->text("Tes Cetak Sukses!\n");
        $printer->text("Waktu: " . now()->format('d-m-Y H:i:s') . "\n");
        $printer->cut();
        $printer->close();

        return '✅ Printer berhasil mencetak (atau membuat file spool di Linux).';
    } catch (\Exception $e) {
        return '❌ Gagal mencetak: ' . $e->getMessage();
    }
});
