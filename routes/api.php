<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Profile;

use App\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'users'], function () {
    Route::post('new_user', 'Users@user_new');
    Route::post('login', 'Users@user_login');
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('list', 'Users@users');
        Route::put('edit/{id_user}', 'Users@user_edit');
        Route::delete('delete/{id_user}', 'Users@user_delete');
    });
});