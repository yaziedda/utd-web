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

Route::get('/', function () {
	return view('welcome');
});
Route::get('/workshop', 'UserCT@workshop');

Route::group(['middleware' => 'checklogin'], function () {
	Route::get('/user/dashboard', 'UserCT@dashboard');
	Route::get('/user/pembayaran', 'UserCT@pembayaran');
	Route::post('/user/pembayaran-upload', 'UserCT@pembayaranUpload');
	Route::get('/user/tiket', 'UserCT@tiket');
	Route::get('/user/sertifikat', 'UserCT@sertifikat');
});

Route::get('/user/registrasi', 'UserCT@registrasi');
Route::post('/user/registrasi-user', 'UserCT@registrasiUser');
Route::post('/user/login-user', 'UserCT@loginUser');
Route::get('/user/login', 'UserCT@login');
Route::get('/logout', 'UserCT@logout');

Route::resource('/admin/product', 'ProductCT');



Route::group(['middleware' => 'checkloginAdmin'], function () {
	Route::get('/admin/dashboard', 'AdminCT@dashboard');
	Route::get('/admin/transaksi', 'AdminCT@transaksi');
	Route::get('/admin/report', 'AdminCT@report');
	Route::get('/admin/user', 'AdminCT@user');
	Route::get('/admin/transaksi/{id}', 'AdminCT@transaksiDetail');
	Route::post('/admin/transaksi/update', 'AdminCT@transaksiUpdate');

	Route::get('/admin/pembayaran', 'AdminCT@pembayaran');
	Route::post('/admin/pembayaran-upload', 'AdminCT@pembayaranUpload');
	Route::get('/admin/tiket', 'AdminCT@tiket');
	Route::get('/admin/sertifikat', 'AdminCT@sertifikat');
});

Route::post('/admin/login-user', 'AdminCT@loginUser');
Route::get('/admin/login', 'AdminCT@login');
Route::get('/admin/logout', 'AdminCT@logout');