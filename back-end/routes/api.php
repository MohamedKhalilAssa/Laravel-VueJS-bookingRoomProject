<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// API CALLS FOR LISTINGS (DON'T NEED AUTHENTICATION)

Route::prefix('listings')->group(function () {
    //* show all listings
    Route::get('/', [ListingController::class, 'index']);
    //* show a listing
    Route::get('/{id}', [ListingController::class, 'show'])->where('id', '[0-9]+');
    // get Listings by user
    Route::get('/User/{user_id}', [ListingController::class, 'getByUser'])->where('user_id', '[0-9]+');
    // delete
    Route::delete('/{id}', [ListingController::class, 'destroy'])->where('id', '[0-9]+');
});
