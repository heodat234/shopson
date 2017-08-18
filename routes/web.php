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
Route::get('profile',
	['as'=>'profile',
	 'uses'=>'Home_Controller@getProfile']);


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
Route::post('editProfile',[
	'as'=>'editProfile',
	'uses'=>'LoginRegister_Controller@postEditProfile']);
Route::post('changePassword', [
	'as'=>'changePassword',
	'uses'=>'LoginRegister_Controller@changePassword'
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
Route::get('deleteCart',
	['as'=>'deleteCart',
	 'uses'=>'CartController@deleteCart']); 
Route::get('checkout',[
	'as'=>'checkout',
	'uses'=>'CartController@getCheckOut']);
Route::post('postCheckOut',[
	'as'=>'postCheckOut',
	'uses'=>'CartController@postCheckOut']);

Route::get('checkEmail',[
	'as'=>'checkEmail',
	'uses'=>'LoginRegister_Controller@checkEmail']);

Route::get('demo',
	['as'=>'demo',
	 'uses'=>'Admin_Product_Controller@View_Kho']); 





//News
Route::get('news',
	['as'=>'news',
	 'uses'=>'News_Controller@getNews']);

Route::get('news_By_Id/{id}',
	['as'=>'news_By_Id',
	 'uses'=>'News_Controller@news_By_Id']); 

Route::get('news_Admin',
	['as'=>'news_Admin',
	 'uses'=>'News_Controller@getNews_Admin']);

Route::get('ViewPage_InsertNews',[
	'as'=>'ViewPage_InsertNews',
	'uses'=>'News_Controller@ViewPageInsertNews']);
Route::get('ViewPage_EditNews/{id}',[
	'as'=>'ViewPage_EditNews',
	'uses'=>'News_Controller@ViewPageEditNews']);

Route::post('Edit_News',
	['as'=>'Edit_News',
	 'uses'=>'News_Controller@Edit_News']);
Route::post('Insert_News',
	['as'=>'Insert_News',
	 'uses'=>'News_Controller@Insert_News']);
Route::get('Delete_News',
	['as'=>'Delete_News',
	 'uses'=>'News_Controller@Delete_News']);





//Admin

//vào trang admin
Route::get('ViewContent_Admin',
	['as'=>'ViewContentAdmin',
	'uses'=>'Admin_Product_Controller@View_Kho']);


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

Route::get('loginForgetPassword/{email}/{pass}',
	['as'=>'loginForgetPassword',
	'uses'=>'Admin_Controller@loginForgetPassword']);

Route::get('profileAdmin',
	['as'=>'profileAdmin',
	 'uses'=>'Admin_Controller@getProfileAdmin']);

Route::get('logout_Admin',[
	'as'=>'logout_Admin',
	'uses'=>'LoginRegister_Controller@getLogout_Admin']);


//Product
Route::get('ViewProduct_Admin',
	['as'=>'ViewProductAdmin',
	'uses'=>'Admin_Product_Controller@Select_Product']);

Route::get('ViewProduct_Admin_ByType/{id}/{name}',
	['as'=>'ViewProductAdmin_ByType',
	'uses'=>'Admin_Product_Controller@FindProductByType']);

Route::post('Edit_Product',
	['as'=>'Edit_Product',
	 'uses'=>'Admin_Product_Controller@Edit_Product']);

Route::post('Insert_Product',
	['as'=>'Insert_Product',
	 'uses'=>'Admin_Product_Controller@Insert_Product']);

Route::get('Delete_Product/{id}/{idsize}',
	['as'=>'Delete_Product',
	 'uses'=>'Admin_Product_Controller@Delete_Product']);
Route::get('ViewPage_InsertProduct',[
	'as'=>'ViewPage_InsertProduct',
	'uses'=>'Admin_Product_Controller@ViewPageInsertProduct']);

Route::get('ViewPage_EditProduct/{id}/{idsize}',[
	'as'=>'ViewPage_EditProduct',
	'uses'=>'Admin_Product_Controller@ViewPageEditProduct']);

Route::get('ViewPage_ImportProduct/{id}/{idsize}',[
	'as'=>'ViewPage_ImportProduct',
	'uses'=>'Admin_Product_Controller@ViewPageImportProduct']);

Route::post('Insert_Import_Product',
	['as'=>'Insert_Import_Product',
	 'uses'=>'Admin_Product_Controller@Insert_Import_Product']);




//Kho
Route::get('View_Kho',
	['as'=>'View_Kho',
	 'uses'=>'Admin_Product_Controller@View_Kho']);

Route::get('ViewPage_InsertKho',
	['as'=>'ViewPage_InsertKho',
	 'uses'=>'Admin_Product_Controller@ViewPage_InsertKho']);

Route::post('Insert_Kho',
	['as'=>'Insert_Kho',
	 'uses'=>'Admin_Product_Controller@Insert_Kho']);

Route::get('ViewPage_EditKho/{id}',
	['as'=>'ViewPage_EditKho',
	 'uses'=>'Admin_Product_Controller@ViewPage_EditKho']);

Route::post('Edit_Kho',
	['as'=>'Edit_Kho',
	 'uses'=>'Admin_Product_Controller@Edit_Kho']);




//bang hàng lỗi, bảng export
Route::get('View_Export',
	['as'=>'View_Export',
	 'uses'=>'Admin_Product_Controller@View_Export']);

Route::post('updateErrorQuantity',
	['as'=>'updateErrorQuantity',
	 'uses'=>'Admin_Product_Controller@updateErrorQuantity']);


//Category
Route::get('View_Category',
	['as'=>'View_Category',
	 'uses'=>'Category_Controller@View_Category']);

Route::get('View_Category_By_Parent/{id}',
	['as'=>'View_Category_By_Parent',
	 'uses'=>'Category_Controller@View_Category_By_Parent']);

Route::get('ViewPage_EditCategory/{id}',
	['as'=>'ViewPage_EditCategory',
	 'uses'=>'Category_Controller@ViewPage_EditCategory']);

Route::post('Edit_Category',
	['as'=>'Edit_Category',
	 'uses'=>'Category_Controller@Edit_Category']);

Route::get('ViewPage_InsertCategory',
	['as'=>'ViewPage_InsertCategory',
	 'uses'=>'Category_Controller@ViewPage_InsertCategory']);

Route::post('Insert_Category',
	['as'=>'Insert_Category',
	 'uses'=>'Category_Controller@Insert_Category']);

Route::get('Delete_Category',
	['as'=>'Delete_Category',
	 'uses'=>'Category_Controller@Delete_Category']);









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

Route::get('Show_Bill_By_User/{id}',
	['as'=>'Show_Bill_By_User',
	 'uses'=>'Bill_Controller@Show_Bill_By_User']);






//bill admin
Route::get('ViewPageBill_Admin',
	['as'=>'ViewPageBill_Admin',
	'uses'=>'Bill_Controller@ViewPageBill_Admin']);

Route::get('ViewPageBill_Detail_Admin/{id}',
	['as'=>'ViewPageBill_Detail_Admin',
	'uses'=>'Bill_Controller@ViewPageBill_Detail_Admin']);

Route::get('ViewModify_BillDetail/{id}/{name}',
	['as'=>'ViewModify_BillDetail',
	'uses'=>'Bill_Controller@ViewModify_BillDetail']);

Route::post('Update_Bill_Detail',
	['as'=>'Update_Bill_Detail',
	'uses'=>'Bill_Controller@Update_Bill_Detail']);

Route::get('ViewPageBill_Admin_Insert/{id}',
	['as'=>'ViewPageBill_Admin_Insert',
	'uses'=>'Bill_Controller@ViewPageBill_Admin_Insert']);

Route::post('Update_Bill',
	['as'=>'Update_Bill',
	'uses'=>'Bill_Controller@Update_Bill']);

Route::get('Delete_One_BillDetail/{id}/{id_pro}/{qty}/{size}/{id_bill}',
	['as'=>'Delete_One_BillDetail',
	'uses'=>'Bill_Controller@Delete_One_BillDetail']);

Route::get('CheckQuantity/{idPro}/{size}/{qty}',
	['as'=>'CheckQuantity',
	'uses'=>'Bill_Controller@CheckQuantity']);


//xem chi tiết hóa đơn trong trang profile
Route::get('ViewBill_Detail/{id}',
	['as'=>'ViewBill_Detail',
	'uses'=>'Bill_Controller@ViewBill_Detail']);

//đếm hóa đơn mới
Route::get('Count_Bill',
	['as'=>'Count_Bill',
	'uses'=>'Bill_Controller@Count_Bill']);