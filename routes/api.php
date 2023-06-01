<?php

use App\Http\Controllers\Api\Auth\AuthControllerApi;
use App\Http\Controllers\Api\ProdutosControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('produtos',[ProdutosControllerApi::class,'index']);
Route::post('auth/login',[AuthControllerApi::class,'login']);