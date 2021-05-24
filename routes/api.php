<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\UserController;
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

// Route::get('/products', [ProductController::class, 'index']);

Route::post('/login', [UserController::class, 'login'])->middleware('auth.pb');
Route::delete('/logout', [UserController::class, 'logout'])->middleware('auth.jwt');

Route::resource('products', ProductController::class)->except(['create', 'edit'])
        ->middleware('auth.jwt');


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
