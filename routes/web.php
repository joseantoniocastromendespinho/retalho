<?php

use App\Http\Controllers\Admin\ProductPhotoController;
use App\User;
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
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

//Rotas administrativas
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function()
    {
        Route::resource('stores','StoreController');
        Route::resource('products','ProductController'); 
        Route::resource('categories','CategoryController');
        Route::post('photos/remove','ProductPhotoController@removerPhoto')->name('remove.photo');
    }
);

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

