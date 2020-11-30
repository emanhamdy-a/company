<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmpolyeeController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'],
function (){

  Route::get('/login',[AdminController::class, 'index']);
  Route::post('/dologin',[AdminController::class, 'login']);
  Route::get('/logout',[AdminController::class, 'logout']);

});

Route::group(['prefix' => 'admin','middleware' => ['is_super']],
  function (){

    Route::get('/',[HomeController::class,'index']);

    Route::resource('/companies', CompanyController::class);

    Route::get('/companies/enable/{id}',[CompanyController::class, 'enable']);

    Route::get('/companies/disable/{id}',[CompanyController::class, 'disable']);
    Route::put('/companies',[CompanyController::class, 'search']);


    Route::resource('/empolyees', EmpolyeeController::class);

    Route::get('/empolyees/enable/{id}',[EmpolyeeController::class, 'enable']);

    Route::get('/empolyees/disable/{id}',[EmpolyeeController::class, 'disable']);
    Route::put('/empolyees',[EmpolyeeController::class, 'search']);

  });
