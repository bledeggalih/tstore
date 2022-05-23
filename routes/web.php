<?php


Route::get('/', function () {
    return redirect('home');
});

Auth::routes();


Route::get('/home', 'HomeController@view')->name('home');
//user
Route::get('/profileUser','ProfileController@profile')->name('profileUser');
Route::post('/updateUser','ProfileController@update')->name('updateUser');

//store
Route::get('/viewStore','StoresController@view')->name('viewStore');
Route::get('/addStore','StoresController@add')->name('addStore');
Route::get('/editStore','StoresController@edit')->name('editStore');
Route::post('/dataStore','StoresController@store')->name('dataStore');
Route::post('{id}/deleteStore','StoresController@delete')->name('deleteStore');
Route::post('/updateStore','StoresController@update')->name('updateStore');


//clothes
Route::get('/viewClothes','ClothesController@view')->name('viewClothes');
Route::get('/addClothes','ClothesController@add')->name('addClothes');
Route::get('/editClothes','ClothesController@edit')->name('editClothes');
Route::post('/storeClothes', 'ClothesController@store')->name('storeClothes');
Route::get('/category/{name}', 'ClothesController@search')->name('pageClothes');
Route::post('{id}/deleteClothes', 'ClothesController@delete')->name('deleteClothes');
Route::post('/updateClothes', 'ClothesController@update')->name('updateClothes');
Route::get('/pageClothes','ClothesController@page')->name('pageClothes');//gak kepake
Route::get('{id}/detailClothes','ClothesController@viewDetail')->name('detailClothes');

//category
Route::get('/viewCategory','CategoryController@view')->name('viewCategory');
Route::get('/addCategory','CategoryController@add')->name('addCategory');
Route::get('{id}/editCategory','CategoryController@edit')->name('editCategory');
Route::post('/storeCategory','CategoryController@store')->name('storeCategory');
Route::post('{id}/updateCategory', 'CategoryController@update')->name('updateCategory'); //update
Route::post('{id}/delete', 'CategoryController@delete')->name('deleteCategory');

//cart
Route::get('/viewTransaction', 'Transaction_detailController@view')->name('viewTransaction');
//Route::get('/viewTransaction', 'CartController@transaction')->name('viewTransaction');
Route::get('/viewCart','CartController@view')->name('viewCart');
Route::post('/addCart','CartController@add')->name('addCart');
Route::get('/editCart','CartController@edit')->name('editCart');
Route::post('{id}/updateCart', 'CartController@update')->name('updateCart');
Route::post('{id}/deleteCart', 'CartController@delete')->name('deleteCart');
Route::post('/storeCart','CartController@store')->name('storeCart');
Route::post('/checkoutCart', 'CartController@checkout')->name('checkoutCart');