<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\PasienController;

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
    return redirect()->route('login');
});


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    // Memvalidasi data form login
    $credentials = $request->only('username', 'password');

    // Melakukan autentikasi
    if (Auth::attempt($credentials)) {
        return redirect()->route('rumahsakit.index');
    } else {
        return redirect()->route('login')->with('error', 'Username atau password salah');
    }
});
Route::view('/rumahsakit', 'rumahsakit')->name('rumahsakit.index');
Route::get('/rumahsakit', [RumahSakitController::class, 'index'])->name('rumahsakit.index');
Route::post('/rumahsakit', [RumahSakitController::class, 'store'])->name('rumahsakit.store');
Route::get('/rumahsakit/{rumahsakit}/edit', [RumahSakitController::class, 'edit'])->name('rumahsakit.edit');
Route::delete('/rumahsakit/{rumahsakit}', [RumahSakitController::class, 'destroy'])->name('rumahsakit.destroy');

Route::resource('pasien', 'PasienController');  