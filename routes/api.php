<?php

use App\Http\Controllers\Api\Auth\AuthControllerApi;
use App\Http\Controllers\Api\ProdutosControllerApi;
use App\Http\Controllers\Api\UserControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('produtos',[ProdutosControllerApi::class,'index']);
Route::get('users',[UserControllerApi::class,'index'])->middleware('apiJwt');
Route::post('auth/login',[AuthControllerApi::class,'login']);