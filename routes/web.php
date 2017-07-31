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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','web']], function(){
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	Route::get('/get-members', 'SupplierController@getMembers')->name('get-members');
	Route::get('/assign-member', 'SupplierController@assignMember')->name('assign-member');

	Route::get('/order-product-details/{id}', 'OrderProductController@orderProductDetails')->name('order-product-details');

	Route::get('/orders', 'OrderController@index')->name('orders');
	Route::get('/order-details/{id}', 'OrderController@orderDetails')->name('order-details');

	Route::get('/photography/{id}','PhotographyController@index')->name('photography');
	Route::get('/video/{id}','PhotographyController@index')->name('video');
	Route::get('/photo-editor/{id}','PhotographyController@index')->name('photo-editor');
	Route::get('/video-editor/{id}','PhotographyController@index')->name('video-editor');
	Route::get('/photo-quality-checker/{id}','PhotographyController@index')->name('photo-quality-checker');
	Route::get('/video-quality-checker/{id}','PhotographyController@index')->name('video-quality-checker');
	Route::get('/submit-images','PhotographyController@submitImages')->name('submit-images');
	Route::get('/success','PhotographyController@successPage')->name('success');

	Route::post('/upload','FileController@upload')->name('upload');
	Route::post('/upload-brochure-image','FileController@uploadBrochure')->name('upload');
	Route::get('/delete-photo','FileController@deletePhoto')->name('delete-photo');
	Route::get('/zip-file','FileController@zipFile')->name('zip-file');
	Route::get('/zip-brochure','FileController@zipBrochure')->name('zip-brochure');

	Route::get('/get-notif', 'NotificationController@getNotifs')->name('get-notif');

	Route::get('/upload-brochure/{id}','MarketingController@index')->name('upload-brochure');
	Route::get('/brochure-checker/{id}','MarketingController@index')->name('brochure-checker');
});