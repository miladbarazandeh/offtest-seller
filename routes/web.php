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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('promotions', 'PromotionController@indexAction')->name('panel.promotions');
Route::get('promotion-edit/{id?}', 'PromotionController@editAction')->name('panel.promotion.edit');
Route::post('promotion-edit', 'PromotionController@editSaveAction')->name('panel.promotion.edit.save');