<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataPinjamController;
use app\Http\Controllers\UserController;


Route::get('/', [DataPinjamController::class, 'login'])->name('datapinjam.login');
Route::get('/register-menu', [DataPinjamController::class, 'registerindex'])->name('datapinjam.register');
Route::get('/index', [DataPinjamController::class, 'index'])->name('datapinjam.index');
Route::get('/pinjam', [DataPinjamController::class, 'pinjamform'])->name('datapinjam.formpinjam');
Route::post('/pinjamstore', [DataPinjamController::class, 'store'])->name('datapinjam.store');
Route::get('/getID', [DataPinjamController::class, 'getKode'])->name('datapinjam.getIDbarang');
Route::get('/edit-data/{id}', [DataPinjamController::class, 'EditDataPinjam'])->name('datapinjam.formeditpinjam');
Route::put('/pinjamedit/{id}', [DataPinjamController::class, 'update'])->name('datapinjam.update');
Route::delete('/delete/{id}', [DataPinjamController::class, 'destroy'])->name('deletepinjam');
Route::get('/laporanpinjam', [DataPinjamController::class, 'index'])->name('datapinjam.laporan');
Route::get('/indexbarang', [DataPinjamController::class, 'indexbarang'])->name('databarang.index');
Route::get('/addbarang', [DataPinjamController::class, 'formbarang'])->name('form.barang');
Route::post('/barangstore', [DataPinjamController::class, 'barangstore'])->name('databarang.store');
Route::get('/edit-barang/{id}', [DataPinjamController::class, 'EditDataBarang'])->name('databarang.formeditbarang');
Route::put('/barangedit/{id}', [DataPinjamController::class, 'updatebarang'])->name('databarang.update');
Route::delete('/delete-barang/{id}', [DataPinjamController::class, 'destroybarang'])->name('deletebarang');
Route::post('/auth', [DataPinjamController::class, 'Authuser'])->name('user-auth');
Route::post('/register', [DataPinjamController::class, 'register'])->name('register');
Route::get('logout', [DataPinjamController::class, 'logout'])->name('logout');
Route::post('/info/getName', [DataPinjamController::class, 'getName'])->name('info.getName');
Route::post('/info/getDomainEdit', [DataPinjamController::class, 'getNameEdit'])->name('info.getNameEdit');