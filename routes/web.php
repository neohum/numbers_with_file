<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\NumberMakeController;


// 가정 통신문 채번 서비스
Route::get('/', [NumberMakeController::class, 'index']);
Route::get('/make', [NumberMakeController::class, 'make']);
Route::get('/first_number', [NumberMakeController::class, 'first_number'])->name('first_number');
Route::Post('/save', [NumberMakeController::class, 'save'])->name('save');
Route::get('/numbers/list', [NumberMakeController::class, 'list'])->name('numbers.list');
Route::Post('/first_number_save', [NumberMakeController::class, 'first_number_save'])->name('first_number_save');
Route::Post( '/number_save', [NumberMakeController::class, 'save'])->name('number_save');
Route::Post( '/content_save', [NumberMakeController::class, 'content_save'])->name('content_save');
Route::get('/edit/{id}', [NumberMakeController::class, 'edit'])->name('edit');
Route::Post( '/content_update/{id}', [NumberMakeController::class, 'content_update'])->name('content_update');

