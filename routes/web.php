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

//Route::get('/', function () {
//    return view('welcome');
//});



Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/payinfos','HomeController@payinfos')->name('payinfos');

Route::get('/workchecks','HomeController@workchecks')->name('workchecks');

Route::get('/doorchecks','HomeController@doorchecks')->name('doorchecks');
Route::get('door','DoorChecksController@web_get');

Route::get('uncheckedusers','HomeController@unchecked')->name('uncheckedusers');
Route::get('checkedusers','HomeController@checked')->name('checkedusers');
Route::post('deleteuser','HomeController@delete_user')->name('deleteuser');
Route::post('checkuser','HomeController@check_user')->name('checkuser');

//A Test Route for AliPay
//Route::post('test','AlipayController@Alipay');









