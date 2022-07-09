<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HeathNewsController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SlidesController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('company',[CompanyController::class,'index']);
Route::get('company-insert',[CompanyController::class,'insert']);
Route::get('company-destroy',[CompanyController::class,'destroy']);


Route::get('healthNews',[HeathNewsController::class,'index']);
Route::get('healthNews-insert',[HeathNewsController::class,'insert']);
Route::get('healthNews-destroy',[HeathNewsController::class,'destroy']);


Route::get('productCategory',[ProductCategoryController::class,'index']);
Route::get('productCategory-insert',[ProductCategoryController::class,'insert']);
Route::get('productCategory-destroy',[ProductCategoryController::class,'destroy']);


Route::get('product',[ProductController::class,'index']);
Route::get('product-insert',[ProductController::class,'insert']);
Route::get('product-destroy',[ProductController::class,'destroy']);

Route::get('slides',[SlidesController::class,'index']);
Route::get('slides-insert',[SlidesController::class,'insert']);
Route::get('slides-destroy',[SlidesController::class,'destroy']);