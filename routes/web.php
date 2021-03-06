<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

//Route::view('/{any}','admin.index')->middleware(['auth'])
//->where('any','.*');

require __DIR__.'/auth.php';

Route::get('{path}', function () {
    return view('admin.index');
})->where('path','.*')->middleware(['auth']);
