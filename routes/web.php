<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->get('admin/dashboard', [HomeController::class, 'index'])->name('admindashboard');

// Route::middleware(['auth', 'admin'])->get('admin/categories', [AdminController::class, 'getCategories'])->name('admincateories');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Route for categories CRUD
    Route::resource('categories', CategoryController::class)
        ->except(['show'])
        ->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]);

    // New routes for CSV categories
    Route::post('categories/import', [CategoryController::class, 'importCsv'])->name('categories.import');
    Route::post('categories/delete-csv', [CategoryController::class, 'deleteFromCsv'])->name('categories.deleteCsv');

    // Route for products CRUD
    Route::resource('products', ProductController::class)
        ->except(['show'])
        ->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]);

    // New routes for CSV Products
    Route::post('products/import', [CategoryController::class, 'importCsv'])->name('products.import');
    Route::post('products/delete-csv', [CategoryController::class, 'deleteFromCsv'])->name('products.deleteCsv');

});

