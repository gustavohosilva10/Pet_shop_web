<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//ESSA ROTA PRECISA FICAR FORA DA MIDDLEWARE PORQUE O LOGIN NÃO ENVIA UM TOKEN
Route::post('login','Api\AuthController@login');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout','Api\AuthController@logout');
    Route::get('refresh','Api\AuthController@refresh');
});