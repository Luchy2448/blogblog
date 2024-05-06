<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    // session()->flash('swal', 
    // [
    //     'type' => 'success',
    //     'icon' => 'success',
    //     'title' => 'Welcome!',
    //     'text' => 'You are logged in!'
    // ]);

    return view('admin.dashboard');
})->name('admin.dashboard');