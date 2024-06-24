<?php

use App\Http\Controllers\Api\McqController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StickerController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
// Grouped Routes with Sanctum Middleware
Route::middleware('auth:sanctum')->group(function () {
    // Get Authenticated User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Create a Question
    Route::post('/mcqs', [McqController::class, 'store']);
    Route::get('/mcqs', [McqController::class, 'index']);
    Route::get('/mcqs/{id}', [McqController::class, 'show']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/stickers', [StickerController::class, 'index']);
Route::get('test', function(){
    echo 'tested ok';
});

Route::post('/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken('token-name')->plainTextToken;
});