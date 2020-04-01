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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','Index\IndexController@index');
Route::get('inde','Index\IndexController@inde');
Route::get('ewm','Index\IndexController@ewm');
Route::get('aouth','Index\IndexController@aouth');
Route::get('oauth','Index\IndexController@oauth');
Route::get('list','Index\IndexController@list');

Route::get('login','Index\IndexController@login');
Route::post('dologin','Index\IndexController@dologin');
Route::get('reg','Index\IndexController@reg');
Route::post('doreg','Index\IndexController@doreg');
Route::post('code','Index\IndexController@code');

Route::get('wx','Index\IndexController@wx');
Route::get('yue','Index\IndexController@yue');
Route::get('tou','Index\IndexController@tou');


Route::get('alipay','Index\IndexController@alipay');
Route::get('return','Index\IndexController@return');
Route::post('notify','Index\IndexController@notify');
