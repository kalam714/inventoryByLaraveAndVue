<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});

Route::apiResource('/employee','App\Http\Controllers\Api\EmployeeController');
Route::apiResource('/supplier','App\Http\Controllers\Api\SupplierController');
Route::apiResource('/category','App\Http\Controllers\Api\CategoryController'); 
Route::apiResource('/product','App\Http\Controllers\Api\ProductController'); 
Route::apiResource('/expense','App\Http\Controllers\Api\ExpenseController'); 
Route::apiResource('/customer','App\Http\Controllers\Api\CustomerController'); 

Route::Post('/salary/paid/{id}','App\Http\Controllers\Api\SalaryController@Paid'); 
Route::get('/salary','App\Http\Controllers\Api\SalaryController@allSalary'); 
Route::get('/salary/view/{id}','App\Http\Controllers\Api\SalaryController@viewSalary');
Route::post('/stock/update/{id}','App\Http\Controllers\Api\ProductController@stockUpdate'); 
Route::get('/get/product/{id}','App\Http\Controllers\Api\PosController@getProduct'); 
Route::get('/addToCart/{id}','App\Http\Controllers\Api\CartController@addToCart'); 
Route::get('/cartProduct','App\Http\Controllers\Api\CartController@cartProduct'); 
Route::get('/removeCart/{id}','App\Http\Controllers\Api\CartController@removeCart'); 

Route::get('/increment/{id}','App\Http\Controllers\Api\CartController@increment'); 
Route::get('/decrement/{id}','App\Http\Controllers\Api\CartController@decrement'); 