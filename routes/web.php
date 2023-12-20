<?php

use App\Http\Controllers\Controller;
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

Route::get('/',             [Controller::class, 'index'])      ->name('index');
Route::get('/kontak',       [Controller::class, 'kontak'])     ->name('kontak');
Route::get('/login-regist', [Controller::class, 'loginRegist'])->name('login-regist');
Route::post('/regist',      [Controller::class, 'regist'])     ->name('regist');
Route::post('/login',       [Controller::class, 'login'])      ->name('login');

Route::middleware(['auth'])->group(function () {
  Route::get('/logout',                    [Controller::class, 'logout'])       ->name('logout');
  Route::get('/dashboard',                 [Controller::class, 'dashboard'])    ->name('dashboard');
  Route::get('/dashboard/umkm',            [Controller::class, 'umkm'])         ->name('umkm');
  Route::get('/tambah-umkm',               [Controller::class, 'umkm_tambah'])  ->name('umkm-tambah');
  Route::post('/tambah-umkm',              [Controller::class, 'umkm_store'])   ->name('umkm-store');
  Route::get('/dashboard/{umkm}/accepted', [Controller::class, 'umkm_accepted'])->name('umkm-accepted');
  Route::get('/dashboard/{umkm}/pending',  [Controller::class, 'umkm_pending']) ->name('umkm-pending');
  Route::get('/dashboard/{umkm}/delete',   [Controller::class, 'umkm_delete'])  ->name('umkm-delete');
  Route::get('/dashboard/{umkm}/edit',     [Controller::class, 'umkm_edit'])    ->name('umkm-edit');
  Route::put('/dashboard/{umkm}/edit',     [Controller::class, 'umkm_update'])  ->name('umkm-update');
});
