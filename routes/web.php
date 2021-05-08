<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('register');
});
Auth::routes();

Route::group(['middleware'=>'auth'],function (){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/upload','FileController@getUpload')->name('get-upload');
    Route::post('/upload','FileController@upload')->name('post-upload');
    Route::get('/view/{public_id}','FileController@view')->name('view');
    Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('signout');

});
