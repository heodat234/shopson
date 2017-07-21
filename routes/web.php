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
    return view('page.home');
});
Route::get('home',[
	'as'=>'home',
	'uses'=>'Home_Controller@getIndex']);
Route::get('contact',
	['as'=>'contact',
	 'uses'=>'Home_Controller@getContact']);
Route::get('about',
	['as'=>'about',
	 'uses'=>'Home_Controller@getAbout']);
// Route::get('/demo', function () {
//     return view('page.demo');
// });

//login, register
Route::post('login',[
	'as'=>'login',
	'uses'=>'LoginRegister_Controller@postLogin']);
Route::post('register',[
	'as'=>'register',
	'uses'=>'LoginRegister_Controller@postRegister']);
Route::get('logout',[
	'as'=>'logout',
	'uses'=>'LoginRegister_Controller@getLogout']);
//facebook, google
Route::get('login/{provider}', [
	'as'=>'provider_login',
	'uses'=>'LoginRegister_Controller@redirectToProvider'
]);
Route::get('login/{provider}/callback', [
	'as'=>'provider_login_callback',
	'uses'=>'LoginRegister_Controller@handleProviderCallback'
]);

//menu
Route::get('productByIdParent/{id}',
	['as'=>'productByIdParent',
	 'uses'=>'Product_Controller@All_Product']);
Route::get('productByIdChild/{id}',
	['as'=>'productByIdChild',
	 'uses'=>'Product_Controller@Product_Child']);

//lấy sản phẩm theo loại nội, ngoại thất
Route::get('Show_product/{id}',
	['as'=>'Show_product',
	 'uses'=>'Product_Controller@Show_Product_By_Type']);
//chi tiết sản phẩm
Route::get('singleProduct/{id}',
	['as'=>'singleProduct',
	 'uses'=>'Product_Controller@single_Product']);

