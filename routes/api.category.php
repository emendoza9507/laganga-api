<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    // 'middleware' => 'auth:api'
], function() {
    Route::apiResource('category', CategoryController::class);
});
