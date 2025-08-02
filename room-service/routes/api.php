<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoomController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::middleware('auth:sanctum')->group(function() {
    Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('room.store');
    Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('room.show');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
});
