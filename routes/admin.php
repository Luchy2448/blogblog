<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {


    return view('admin.dashboard');
})->name('dashboard');

//Caregories
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::post('/categories', [CategoryController::class, 'create'])->name('categories.create');
// Route::match(['get', 'post'], '/categories/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::resource('/categories', CategoryController::class)
               ->except('show');