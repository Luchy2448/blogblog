<?php

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tags', function(Request $request){
    $term = $request->term ?? '';

    $tags = Tag::select('id', 'name as text') 
         ->where('name', 'LIKE', '%' . $term . '%')
         ->limit(10)
         ->get();

    return $tags;     
})->name('api.tags.index');
