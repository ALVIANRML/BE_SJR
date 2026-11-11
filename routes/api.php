<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KreditLimitController;
use App\Http\Controllers\SegmentController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TebusanController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    // api untuk segment
    Route::post('/add-segment', [SegmentController::class, 'store']);
    Route::get('/get-segment', [SegmentController::class, 'index']);
    Route::get('/get-segment/{id}', [SegmentController::class, 'show']);
    Route::post('/update-segment/{id}', [SegmentController::class, 'update']);
    Route::delete('/delete-segment/{id}', [SegmentController::class, 'destroy']);

    // api crud untuk item
    Route::post('/add-item', [ItemController::class, 'store']);
    Route::get('/get-item', [ItemController::class, 'index']);
    Route::get('/get-item/{id}', [ItemController::class, 'show']);
    Route::post('/update-item/{id}', [ItemController::class, 'update']);
    Route::delete('/delete-item/{id}', [ItemController::class, 'destroy']);

    Route::post('/add-kredit_limit', [KreditLimitController::class, 'store']);
    Route::get('/get-kredit_limit', [KreditLimitController::class, 'index']);
    Route::get('/get-kredit_limit/{id}', [KreditLimitController::class, 'show']);
    Route::post('/update-kredit_limit/{id}', [KreditLimitController::class, 'update']);
    Route::delete('/delete-kredit_limit/{id}', [KreditLimitController::class, 'destroy']);

    Route::post('/add-stok', [StokController::class, 'store']);
    Route::get('/get-stok', [StokController::class, 'index']);
    Route::get('/get-stok/{id}', [StokController::class, 'show']);
    Route::post('/update-stok/{id}  ', [StokController::class, 'update']);
    Route::delete('/delete-stok/{id}', [StokController::class, 'destroy']);

    Route::post('add-tebusan', [TebusanController::class, 'store']);

});
