<?php

use App\Http\Controllers\PembalapController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//  Route::get('/', function () {
//      return view('welcome');
// });


Route::get('/', [LoginController::class, 'ShowLoginForm'])->name('login.index');

Route::middleware(['auth'])->group(function(){

    Route::get('/pembalap', [PembalapController::class, 'index'])->name('pembalap.index');
    Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
    Route::get('/tim', [TimController::class, 'index'])->name('tim.index');

    Route::prefix('pembalap')->group(function(){
        Route::get('add', [PembalapController::class, 'create'])->name('pembalap.create');
        Route::post('store', [PembalapController::class, 'store'])->name('pembalap.store');
        Route::get('edit/{id}', [PembalapController::class, 'edit'])->name('pembalap.edit');
        Route::post('update/{id}', [PembalapController::class, 'update'])->name('pembalap.update');
        Route::post('delete/{id}', [PembalapController::class, 'delete'])->name('pembalap.delete');
        Route::post('softdelete/{id}', [PembalapController::class, 'softdelete'])->name('pembalap.softdelete');
        Route::post('search', [PembalapController::class, 'search'])->name('pembalap.search');
    }); 

    Route::prefix('mobil')->group(function(){
        Route::get('add', [MobilController::class, 'create'])->name('mobil.create');
        Route::post('store', [MobilController::class, 'store'])->name('mobil.store');
        Route::get('edit/{id}', [MobilController::class, 'edit'])->name('mobil.edit');
        Route::post('update/{id}', [MobilController::class, 'update'])->name('mobil.update');
        Route::post('delete/{id}', [MobilController::class, 'delete'])->name('mobil.delete');
        Route::post('softdelete/{id}', [MobilController::class, 'softdelete'])->name('mobil.softdelete');
        Route::post('search', [MobilController::class, 'search'])->name('mobil.search');
    });

    Route::prefix('tim')->group(function(){
        Route::get('add', [TimController::class, 'create'])->name('tim.create');
        Route::post('store', [TimController::class, 'store'])->name('tim.store');
        Route::get('edit/{id}', [TimController::class, 'edit'])->name('tim.edit');
        Route::post('update/{id}', [TimController::class, 'update'])->name('tim.update');
        Route::post('delete/{id}', [TimController::class, 'delete'])->name('tim.delete');
        Route::post('softdelete/{id}', [TimController::class, 'softdelete'])->name('tim.softdelete');
        Route::post('search', [TimController::class, 'search'])->name('tim.search');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
