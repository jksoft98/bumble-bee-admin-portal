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

Route::get('/', function () {
    return view('welcome');
});



/*
|--------------------------------------------------------------------------
| Web Route / Authenticated and Permissioned, Verify Authorise routes
|--------------------------------------------------------------------------
*/ 

Route::group([
    'middleware' => ['authorise','check_permissions'],
    'namespace'  => 'App\Http\Controllers',

],function ($router) {

    /*
    |--------------------------------------------------------------------------
    | ViewController
    |--------------------------------------------------------------------------
    */ 

    /*----------------------------  Dashboard View -------------------------------*/     
    Route::get('/'                                  , 'ViewController@dashboard')->name('dashboard-view');

    /*----------------------------  User List View -------------------------------*/     
    Route::get('/user-list'                         , 'ViewController@userList')->name('user-list-view');

    /*----------------------------  User Create View -------------------------------*/     
    Route::get('/user-create'                       , 'ViewController@userCreate')->name('user-create-view');

    /*----------------------------  User Edit View -------------------------------*/     
    Route::get('/user-edit/{id}'                    , 'ViewController@userEdit')->name('user-edit-view');

    /*----------------------------  Customer List View -------------------------------*/     
    Route::get('/customer-list'                     , 'ViewController@customerList')->name('customer-list-view');

    /*----------------------------  Customer Create View -------------------------------*/     
    Route::get('/customer-create'                   , 'ViewController@customerCreate')->name('customer-create-view');

    /*----------------------------  Customer Edit View -------------------------------*/     
    Route::get('/customer-edit/{id}'                , 'ViewController@customerEdit')->name('customer-edit-view');

    /*----------------------------  User Role Create View -------------------------------*/     
    Route::get ('/user-role-create'                 , 'ViewController@userRoleCreate')->name('user-role-create-view');

    /*----------------------------  User Role Edit View -------------------------------*/     
    Route::get('/user-role-edit/{id}'               , 'ViewController@userRoleEdit')->name('user-role-edit-view');

    /*----------------------------  User Role List View -------------------------------*/     
    Route::get('/user-role-list'                    , 'ViewController@userRoleList')->name('user-role-list-view');

    /*----------------------------  Brand List View -------------------------------*/     
    Route::get('/brand-list'                        , 'ViewController@brandList')->name('brand-list-view');

    /*----------------------------  Category List View -------------------------------*/     
    Route::get('/category-list'                     , 'ViewController@categoryList')->name('category-list-view');

    /*----------------------------  Product Create View -------------------------------*/     
    Route::get('/product-create'                    , 'ViewController@productCreate')->name('product-create-view');

    /*----------------------------  Product Edit View -------------------------------*/     
    Route::get('/product-edit/{id}'                 , 'ViewController@productEdit')->name('product-edit-view');

    /*----------------------------  Product List View -------------------------------*/     
    Route::get('/product-list/{status?}'            , 'ViewController@productList')->name('product-list-view');

    /*----------------------------  Order Create View -------------------------------*/     
    Route::get('/order-create'                      , 'ViewController@orderCreate')->name('order-create-view');



});



/*
|--------------------------------------------------------------------------
| Web Route / Authenticated Verify Authorise routes
|--------------------------------------------------------------------------
*/ 

Route::group([
    'middleware' => ['authorise'],
    'namespace'  => 'App\Http\Controllers',

],function ($router) {


    /*
    |--------------------------------------------------------------------------
    | ViewController
    |--------------------------------------------------------------------------
    */ 

    /*----------------------------  403 page View -------------------------------*/     
    Route::get ('/403'                          , 'ViewController@forbidden')->name('Forbidden');

    

   
    /*
    |--------------------------------------------------------------------------
    | ApiController
    |--------------------------------------------------------------------------
    */ 

    /*---------------------------- Display Product Image  ------------------------------------*/
    Route::get('/product-image/{filename}'      , 'ApiController@getStorgeProductImage')->name('display-product-image');

    /*----------------------------  User Create Form Submit ------------------------------------*/    
    Route::post('/user-create-submit'           , 'ApiController@userCreate')->name('user-create-submit');

    /*----------------------------  User Edit Form Submit ------------------------------------*/    
    Route::post('/user-edit-submit'             , 'ApiController@userEdit')->name('user-edit-submit');

    /*----------------------------  User Role Create Form Submit ------------------------------------*/    
    Route::post('/user-role-create-submit'      , 'ApiController@userRoleCreate')->name('user-role-create-submit');

    /*----------------------------  User Role Create Form Submit ------------------------------------*/    
    Route::post('/user-role-edit-submit'        , 'ApiController@userRoleEdit')->name('user-role-edit-submit');

    /*----------------------------  Cuustomer Create Form Submit ------------------------------------*/    
    Route::post('/customer-create-submit'       , 'ApiController@customerCreate')->name('customer-create-submit');

    /*----------------------------  Cuustomer Edit Form Submit ------------------------------------*/    
    Route::post('/customer-edit-submit'         , 'ApiController@customerEdit')->name('customer-edit-submit');

    /*----------------------------  Brand Create Form Submit ------------------------------------*/    
    Route::post('/brand-create-submit'          , 'ApiController@brandCreate')->name('brand-create-submit');

    /*----------------------------  Brand Edit Form Submit ------------------------------------*/    
    Route::post('/brand-edit-submit'            , 'ApiController@brandEdit')->name('brand-edit-submit');

    /*----------------------------  Category Create Form Submit ------------------------------------*/    
    Route::post('/category-create-submit'       , 'ApiController@categoryCreate')->name('category-create-submit');

    /*----------------------------  Category Edit Form Submit ------------------------------------*/    
    Route::post('/category-edit-submit'         , 'ApiController@categoryEdit')->name('category-edit-submit');

    /*----------------------------  Product Create Form Submit ------------------------------------*/    
    Route::post('/product-create-submit'        , 'ApiController@productCreate')->name('product-create-submit');

    /*----------------------------  Product Edit Form Submit ------------------------------------*/    
    Route::post('/product-edit-submit'          , 'ApiController@productEdit')->name('product-edit-submit');

    /*---------------------------- Change Product Status Form Submit ------------------------------------*/    
    Route::post('/change-product-status-submit' , 'ApiController@changeProductStatus')->name('change-product-status-submit');

    

    



    /*
    |--------------------------------------------------------------------------
    | Ajax Routes
    |--------------------------------------------------------------------------
    */ 

    /*----------------------------  get notifications ajax ------------------------------------*/    
    Route::get('/get-notifications-ajax'        , 'ApiController@getNotificationsAjax')->name('get-notifications-ajax');

    /*----------------------------  change user status ajax ------------------------------------*/    
    Route::post('/change-user-status-ajax'      , 'ApiController@changeUserStatusAjax')->name('change-user-status-ajax');

    /*----------------------------  change customer status ajax ------------------------------------*/    
    Route::post('/change-customer-status-ajax'  , 'ApiController@changeCustomerStatusAjax')->name('change-customer-status-ajax');

    /*----------------------------  change user role status ajax ------------------------------------*/    
    Route::post('/change-role-status-ajax'      , 'ApiController@changeRoleStatusAjax')->name('change-role-status-ajax');

    /*----------------------------  change brand status ajax ------------------------------------*/    
    Route::post('/change-brand-status-ajax'     , 'ApiController@changeBrandStatusAjax')->name('change-brand-status-ajax');

    /*----------------------------  change category status ajax ------------------------------------*/    
    Route::post('/change-category-status-ajax'  , 'ApiController@changeCategoryStatusAjax')->name('change-category-status-ajax');
    
    /*----------------------------  get single customer data ajax ------------------------------------*/    
    Route::get('/get-single-customer-data-ajax' , 'ApiController@getSingleCustomerDataAjax')->name('get-single-customer-data-ajax');

    

    


    

});










/*
|--------------------------------------------------------------------------
| Web Route /  Non-authenticated routes
|--------------------------------------------------------------------------
*/ 
Route::group([

    'namespace'=>'App\Http\Controllers',

],function ($router) {  

   
    /*----------------------------  Admin Login  -------------------------------*/     
    Route::get('/admin-login'                       , 'ViewController@adminLogin')->name('admin-login');

    /*----------------------------  Customer Register  -------------------------------*/     
    Route::get('/customer-register'                 , 'ViewController@customerRegister')->name('customer-register');

    Route::get('/404'                               , 'ViewController@notFound')->name('not-found');

    Route::get('/logout'                            , 'ApiController@logout');


    /*
    |--------------------------------------------------------------------------
    | ApiController
    |--------------------------------------------------------------------------
    */ 

    /*----------------------------  New Customer Register Form Submit ------------------------------------*/     
    Route::post('/customer-register-submit'        , 'ApiController@customerRegister')->name('customer-register-submit');

    /*----------------------------  Admin Login Form Submit ------------------------------------*/    
    Route::post('/admin-login-submit'              , 'ApiController@adminLogin')->name('admin-login-submit');
    


});

