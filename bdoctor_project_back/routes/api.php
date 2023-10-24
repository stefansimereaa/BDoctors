<?php


use App\Http\Controllers\MessageController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\BraintreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotte api dottori
Route::apiResource('doctors', DoctorController::class);
Route::get('/doctors/specialization/{id}', [DoctorController::class, 'indexBySpecializations']);
Route::get('/doctors/specialization/{id}/{rating}/{orderedByReviews}', [DoctorController::class, 'indexBySpecializationsAndRatingAndReviews']);

// Rotte api messaggi
Route::post('/messages', [MessageController::class, 'store']);

// Rotte reviews
Route::post('/reviews', [ReviewController::class, 'store']);

// Rotte ratings
Route::post('/ratings', [RatingController::class, 'store']);

// Rotte per pagamenti
Route::post('/braintree/client-token', [BraintreeController::class, 'payment']);

// Rotte api specializzazioni
Route::apiResource('specializations', SpecializationController::class);

// Rotte api recensioni
Route::apiResource('reviews', ReviewController::class);
