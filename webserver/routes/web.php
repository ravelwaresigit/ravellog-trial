<?php

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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/','DashboardController@index');

//Trial v1
Route::get('/v1/result','V1Controller@showResult')->name('v1');
Route::get('/v1/getresult','V1Controller@getResult');
Route::post('/v1/settrialnumber','V1Controller@setTrialNumber');
Route::get('/v1/downloadlog','V1Controller@downloadLogV1');

//Trial v2
Route::get('/v2/setmatrix','V2Controller@setMatrix')->name('v2');
Route::post('/v2/storematrix','V2Controller@storeMatrix')->name('storematrix');
Route::get('/v2/matrix','V2Controller@Matrix')->name('matrix');
Route::post('/v2/creatematrix','V2Controller@createMatrix')->name('creatematrix');
Route::get('/v2/setkanban','V2Controller@setKanban')->name('setkanban');
Route::post('/v2/storekanban','V2Controller@storeKanban')->name('storekanban');
Route::get('/v2/result','V2Controller@showResult')->name('resultv2');
Route::get('/v2/getresult','V2Controller@getResult');
Route::post('/v2/clearresult','V2Controller@clearResult');
Route::get('/v2/getmatrix','V2Controller@getMatrix')->name('getmatrix');
Route::post('/v2/updatematrix','V2Controller@updateMatrix')->name('updatematrix');
Route::post('/v2/settrialnumber','V2Controller@setTrialNumber');
Route::post('/v2/checkduplicatekanban','V2Controller@checkDuplicateKanban');
Route::get('/v2/resetkanban','V2Controller@resetKanban')->name('resetkanban');