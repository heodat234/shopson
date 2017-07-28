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
Route::get('checkout',[
	'as'=>'checkout',
	'uses'=>'HomeController@getCheckout']);
Route::get('/demo', function () {
    return view('admin.demo_Admin');
});

//search

Route::get('search',
	['as'=>'search',
	 'uses'=>'SearchController@autocomplete']);
Route::post('searchSingle',
	['as'=>'searchSingle',
	 'uses'=>'SearchController@singleProduct']);

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
Route::get('activeUser', [
	'as'=>'activeUser',
	'uses'=>'LoginRegister_Controller@activeUser'
]);




//login Admin
Route::get('Login_Admin',
	['as'=>'Login_Admin',
	'uses'=>'Admin_Controller@Login_Admin']);
Route::post('PostLogin_Admin',
	['as'=>'PostLogin_Admin',
	'uses'=>'Admin_Controller@PostLogin_Admin']);
Route::get('ForgetPassword',[
	'as'=>'ForgetPassword',
	'uses'=>'Admin_Controller@ForgetPassword']);
Route::post('ForgetPassword_Admin',
	['as'=>'ForgetPassword_Admin',
	'uses'=>'Admin_Controller@PostForgetPassword']);
//vào trang admin
Route::get('ViewContent_Admin',
	['as'=>'ViewContentAdmin',
	'uses'=>'Admin_Controller@ViewContent_Admin']);

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


//Cart route
Route::get('add-to-cart/{idsize}/{quantity}/{color}',
	['as'=>'add-to-cart',
	 'uses'=>'CartController@addToCart']); 
Route::get('show-cart',
	['as'=>'show-cart',
	 'uses'=>'CartController@showCart']); 
Route::get('rise-to-qty/{id}',
	['as'=>'rise-to-qty',
	 'uses'=>'CartController@riseByOne']); 
Route::get('reduce-to-qty/{id}',
	['as'=>'reduce-to-qty',
	 'uses'=>'CartController@reduceByOne']); 
Route::get('remove-to-item/{id}',
	['as'=>'remove-to-item',
	 'uses'=>'CartController@deleteItemCart']); 



//Admin

//Product
Route::get('ViewProduct_Admin',
	['as'=>'ViewProductAdmin',
	'uses'=>'Admin_Controller@Select_Product']);
Route::post('Edit_Product',
	['as'=>'Edit_Product',
	 'uses'=>'Admin_Controller@Edit_Product']);
Route::post('Insert_Product',
	['as'=>'Insert_Product',
	 'uses'=>'Admin_Controller@Insert_Product']);
Route::get('Delete_Product',
	['as'=>'Delete_Product',
	 'uses'=>'Admin_Controller@Delete_Product']);

//customer
Route::get('ViewCustomer',
	['as'=>'ViewCustomer',
	 'uses'=>'Admin_Controller@ViewAllCustomer']);


//user admin
Route::get('user_Admin',
	['as'=>'user_Admin',
	 'uses'=>'Admin_Controller@Select_User']);
Route::post('Edit_User',
	['as'=>'Edit_User',
	 'uses'=>'Admin_Controller@Edit_User']);
Route::post('Insert_User',
	['as'=>'Insert_User',
	 'uses'=>'Admin_Controller@Insert_User']);
Route::get('Delete_User',
	['as'=>'Delete_User',
	 'uses'=>'Admin_Controller@Delete_User']);

