<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('zones', App\Http\Controllers\API\ZoneAPIController::class)
    ->except(['create', 'edit']);

Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class)
    ->except(['create', 'edit']);

Route::resource('orders', App\Http\Controllers\API\OrderAPIController::class)
    ->except(['create', 'edit']);

Route::resource('order-products', App\Http\Controllers\API\OrderProductAPIController::class)
    ->except(['create', 'edit']);

Route::resource('products', App\Http\Controllers\API\ProductAPIController::class)
    ->except(['create', 'edit']);

Route::resource('stores', App\Http\Controllers\API\StoreAPIController::class)
    ->except(['create', 'edit']);