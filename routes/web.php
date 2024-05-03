<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataPinjamController;
use app\Http\Controllers\UserController;


Route::get('/', [DataPinjamController::class, 'index'])->name('datapinjam.index');
Route::get('/pinjam', [DataPinjamController::class, 'pinjamform'])->name('datapinjam.formpinjam');
Route::post('/pinjamstore', [DataPinjamController::class, 'store'])->name('datapinjam.store');
Route::get('/getID', [DataPinjamController::class, 'getKode'])->name('datapinjam.getIDbarang');
Route::get('/edit-data/{id}', [DataPinjamController::class, 'EditDataPinjam'])->name('datapinjam.formeditpinjam');
Route::put('/pinjamedit/{id}', [DataPinjamController::class, 'update'])->name('datapinjam.update');
Route::delete('/delete/{id}', [DataPinjamController::class, 'destroy'])->name('deletepinjam');