<?php

use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Auth\CreateTokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::get('/token/create', [CreateTokensController::class, "index"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    return response()->json([
        "email" => $user->email,
        "date" => date("Y-m-d",strtotime($user->created_at)),
        "name" => $user->name,
    ]);
});

Route::middleware(['auth:sanctum', 'abilities:news-command'])->resource('news', NewsController::class)->only(['create', 'edit', 'store', 'update', 'destroy']);
Route::resource('news', NewsController::class)->only(['index', 'show']);

