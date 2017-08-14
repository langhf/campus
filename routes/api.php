<?php

use Illuminate\Http\Request;

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


Route::get('home/{user_id}','Api\Auth\AndroidController@home');
Route::post('register','Api\Auth\AndroidController@register');
Route::post('login','Api\Auth\AndroidController@login');
Route::post('refresh','Api\Auth\AndroidController@refresh');
Route::middleware('auth:api')->group(function ( ) {
    Route::post('logout','Api\Auth\AndroidController@logout');
});


Route::get('doorchecks','DoorChecksController@all')->middleware('auth:api');  //此路由不应该出现在API内
Route::get('doorchecks/{user_id}/{query_date?}','DoorChecksController@api_get')->middleware('auth:api');
Route::post('doorchecks','DoorChecksController@api_post')->middleware('auth:api');

Route::get('workchecks','WorkCheckController@all')->middleware('auth:api');
Route::get('workchecks/{user_id}/{query_date?}','WorkCheckController@api_get')->middleware('auth:api');
Route::post('workchecks','WorkCheckController@api_post')->middleware('auth:api');

Route::get('payinfos','PayInfoController@all')->middleware('auth:api');
Route::get('payinfos/{user_id}/{query_date?}','PayInfoController@api_get')->middleware('auth:api');
Route::post('payinfos','PayInfoController@api_post')->middleware('auth:api');

Route::get('userinfo/{user_id}','UserController@api_get')->middleware('auth:api');