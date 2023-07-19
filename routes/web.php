<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//unregistered users
Route::get('/', [QuoteController::class, 'list']);
Route::get('/quotes', [QuoteController::class, 'list']);
Route::get('/filter', [QuoteController::class, 'quotesFilter']);
Route::get('/categories', [CategoryController::class, 'index']);

//registration
Route::post('/signup', [SignupController::class, 'signup']);
Route::get('/signup', [SignupController::class, 'index']);

//authentication
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/checkUserLevel', [LoginController::class, 'check_user_level']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//registered users
Route::get('/mg/add', [ManagementController::class, 'insert'])->middleware('auth');
Route::post('/mg/add', [ManagementController::class, 'insert'])->middleware('auth');
Route::post('/mg/remove', [ManagementController::class, 'remove'])->middleware('auth');
Route::get('/mg/update/{id}', [ManagementController::class, 'update'])->name('get_update')->middleware('auth');
Route::post('/mg/update', [ManagementController::class, 'update'])->middleware('auth');

//super registered users
Route::post('/categories/add', [CategoryController::class, 'add'])->middleware('auth');
Route::get('/category/delete', [CategoryController::class, 'delete'])->middleware('auth');