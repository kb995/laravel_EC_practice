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

Auth::routes();
// 商品一覧
Route::get('', 'ItemsController@showItems')->name('top');
// 商品詳細
Route::get('items/{item}', 'ItemsController@showItemDetail')->name('item');

Route::middleware('auth')
->group(function () {
    // 商品詳細 / 購入
    Route::get('items/{item}/buy', 'ItemsController@showBuyItemForm')->name('item.buy');

    // 商品出品
    Route::get('sell', 'SellController@showSellForm')->name('sell');
    Route::post('sell', 'SellController@sellItem')->name('sell');
});

Route::prefix('mypage')
->namespace('MyPage')
->middleware('auth')
->group(function () {
    // プロフィール編集
    Route::get('edit-profile', 'ProfileController@showProfileEditForm')->name('mypage.edit-profile');
    Route::post('edit-profile', 'ProfileController@editProfile')->name('mypage.edit-profile');
    // 出品商品
    Route::get('sold-items', 'SoldItemsController@showSoldItems')->name('mypage.sold-items');

});

// home
Route::get('/home', 'HomeController@index')->name('home');
