<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// api routes that need auth

Route::middleware(['auth:api'])->group(function () {


/* routes for Inventaris Controller  */	
	Route::get('inventaris/', 'InventarisController@index');
	Route::get('inventaris/index', 'InventarisController@index');
	Route::get('inventaris/index/{filter?}/{filtervalue?}', 'InventarisController@index');	
	Route::get('inventaris/view/{rec_id}', 'InventarisController@view');	
	Route::post('inventaris/add', 'InventarisController@add');	
	Route::any('inventaris/edit/{rec_id}', 'InventarisController@edit');	
	Route::any('inventaris/delete/{rec_id}', 'InventarisController@delete');

/* routes for JadwalTurne Controller  */	
	Route::get('jadwalturne/', 'JadwalTurneController@index');
	Route::get('jadwalturne/index', 'JadwalTurneController@index');
	Route::get('jadwalturne/index/{filter?}/{filtervalue?}', 'JadwalTurneController@index');	
	Route::get('jadwalturne/view/{rec_id}', 'JadwalTurneController@view');	
	Route::post('jadwalturne/add', 'JadwalTurneController@add');	
	Route::any('jadwalturne/edit/{rec_id}', 'JadwalTurneController@edit');	
	Route::any('jadwalturne/delete/{rec_id}', 'JadwalTurneController@delete');

/* routes for Stasi Controller  */	
	Route::get('stasi/', 'StasiController@index');
	Route::get('stasi/index', 'StasiController@index');
	Route::get('stasi/index/{filter?}/{filtervalue?}', 'StasiController@index');	
	Route::get('stasi/view/{rec_id}', 'StasiController@view');	
	Route::post('stasi/add', 'StasiController@add');	
	Route::any('stasi/edit/{rec_id}', 'StasiController@edit');	
	Route::any('stasi/delete/{rec_id}', 'StasiController@delete');

/* routes for User Controller  */	
	Route::get('user/', 'UserController@index');
	Route::get('user/index', 'UserController@index');
	Route::get('user/index/{filter?}/{filtervalue?}', 'UserController@index');	
	Route::get('user/view/{rec_id}', 'UserController@view');	
	Route::any('account/edit', 'AccountController@edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword');	
	Route::get('account/currentuserdata', 'AccountController@currentuserdata');	
	Route::post('user/add', 'UserController@add');	
	Route::any('user/edit/{rec_id}', 'UserController@edit');	
	Route::any('user/delete/{rec_id}', 'UserController@delete');

});

Route::get('home', 'HomeController@index');
	
	Route::post('auth/login', 'AuthController@login');
	Route::get('login', 'AuthController@login')->name('login');
		
	Route::post('auth/forgotpassword', 'AuthController@forgotpassword')->name('password.reset');	
	Route::post('auth/resetpassword', 'AuthController@resetpassword');
	
	Route::get('components_data/user_username_exist/{arg1?}', 'Components_dataController@user_username_exist');	
	Route::get('components_data/user_email_exist/{arg1?}', 'Components_dataController@user_email_exist');	
	Route::get('components_data/linechart_pertumbuhanstasi/{arg1?}', 'Components_dataController@linechart_pertumbuhanstasi');	
	Route::get('components_data/barchart_totalumat/{arg1?}', 'Components_dataController@barchart_totalumat');


/* routes for FileUpload Controller  */	
Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');