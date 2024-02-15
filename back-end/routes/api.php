<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// API CALLS FOR LISTINGS (DON'T NEED AUTHENTICATION)

Route::prefix('listings')->group(function () {
    //* show all listings
    Route::get('/',[ListingController::class,'index']);
    //* show a listing
    Route::get('/{id}',[ListingController::class,'show']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
