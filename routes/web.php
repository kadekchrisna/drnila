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

use Dronila\Post;
use Dronila\Product;

Route::get('/', function () {
    return view('profile');
});

Route::get('/train', function () {
    return view('pelatihan');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/admin', function () {
    return view('layout.admin');
});
Route::get('/beranda', function () {
    return view('beranda');
});




Route::resource('posts', 'PostsController');
Route::resource('products', 'ProductsController');

Route::get('/adminpost', 'PostsController@index');
Route::get('/adminproduct', 'ProductsController@index');
Route::get('/post/{id}', 'PostsController@showPost');




// Authentication Routes...
Route::get('dronilalogin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('dronilalogin', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('dronilaregister', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('dronilaregister', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/homeadmindronila', 'HomeController@index');

View::composer('*', function ($view) {
    $posts = Post::orderBy('created_at', 'desc')->paginate(2);
    $view->with('posts',$posts);
});
View::composer('*', function ($view) {
    $product = Product::orderBy('created_at', 'desc')->paginate(2);
    $view->with('product',$product);
});
