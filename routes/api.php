<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\ImageGenerationController;
// use App\Http\Controllers\Api\V2\PostController as V2PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum','throttle:api'])->group(function(){

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    //auto define all five functions;
    Route::apiResource('posts', PostController::class);
     Route::apiResource('image-generations', ImageGenerationController::class)->only('index','store');
});
});


//prefix and route group
// Route::prefix('v1')->group(function(){
//     //auto define all five functions;
// Route::apiResource('posts',V1PostController::class);
// });

// Route::prefix('v2')->group(function(){
//     //auto define all five functions;
// Route::apiResource('posts',V2PostController::class);
// });



require __DIR__ . '/auth.php';
