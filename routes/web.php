<?php

use App\Models\BukuTamu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\RegisteredUserController;

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
    return view('tamu');
});
Route::get('create-data', [BukuTamuController::class, 'create_tamu']);
Route::post('store-data', [BukuTamuController::class, 'store']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', function(){
        return view('dashboard');
    });
    Route::resource('roles', RoleController::class);
    Route::get('/guru/sync-telegram', [GuruController::class, 'sync_telegram'])->name('guru.sync_telegram');
    Route::resource('guru', GuruController::class);
    Route::resource('users', RegisteredUserController::class);
    Route::resource('buku-tamu', BukuTamuController::class);
    Route::get('/excel', [BukuTamuController::class, 'ekspor']);
    Route::get('/account', [RegisteredUserController::class, 'show']);
    Route::patch('/update-user', [RegisteredUserController::class, 'updateUser']);
});

require __DIR__.'/auth.php';
