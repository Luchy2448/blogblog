<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['can:Acceso al dashboard'])
->name('dashboard');

//Caregories
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::post('/categories', [CategoryController::class, 'create'])->name('categories.create');
// Route::match(['get', 'post'], '/categories/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::resource('/categories', CategoryController::class)
               ->except('show')
               ->middleware(['can:Gestion de categorías']);
            
//POST
Route::resource('/posts', PostController::class)
               ->except('show')
               ->middleware(['can:Gestion de artículos']);   
               
//Roles
Route::resource('/roles', RoleController::class)
               ->except('show')
               ->middleware(['can:Gestion de roles']);                
//Permission
Route::resource('/permissions', PermissionController::class)
                ->except('show')
                ->middleware(['can:Gestion de permisos']);;   
Route::resource('/users', UserController::class)
                ->only('index', 'edit', 'update', 'destroy')
                ->middleware(['can:Gestion de usuarios']);;