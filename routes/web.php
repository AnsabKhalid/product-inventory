<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MainController::class, 'productList']);
Route::get('/productForm', [MainController::class, 'productForm']);
Route::post('/addProducts', [MainController::class, 'addProducts']);
Route::get('/editProduct/{id}', [MainController::class, 'editProduct']);
Route::post('/update-product', [MainController::class, 'updateProduct']);


Route::get('/inventory/{id}', [MainController::class, 'inventory']);
Route::post('/addInventory', [MainController::class, 'addInventory']);
