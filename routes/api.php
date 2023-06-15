<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::get('/applianceBrand', [BrandController::class, 'getBrandAll']);
Route::get('/applianceBrand/{id}', [BrandController::class, 'getBrandOne']);
Route::post('/applianceBrandCreate', [BrandController::class, 'createBrand']);
Route::put('/applianceBrand/{id}', [BrandController::class, 'editBrand']);
Route::delete('/applianceBrand/{id}', [BrandController::class, 'deleteBrand']);


Route::get('/applianceProduct', [ProductController::class, 'getProductAll']);
Route::get('/applianceProduct/{id}', [ProductController::class, 'getProductOne']);
Route::post('/applianceProductCreate', [ProductController::class, 'createProduct']);
Route::put('/applianceProduct/{id}', [ProductController::class, 'editProduct']);
Route::delete('/applianceProduct/{id}', [ProductController::class, 'deleteProduct']);
