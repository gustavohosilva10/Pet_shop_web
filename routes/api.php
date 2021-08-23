<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//ESSA ROTA PRECISA FICAR FORA DA MIDDLEWARE PORQUE O LOGIN NÃO ENVIA UM TOKEN
Route::post('login','Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');

Route::group(['middleware' => ['jwt.verify']], function () {
    //LOGIN
    Route::post('logout','Api\AuthController@logout');
    Route::get('refresh','Api\AuthController@refresh');
    //

    //COMPLETA REGISTRO USUARIO
    
    Route::get('index/address', 'Api\CompleteRegisterUserController@index');
    Route::post('store/address', 'Api\CompleteRegisterUserController@store');
    Route::get('show/{id}/address', 'Api\CompleteRegisterUserController@show');
    Route::patch('update/{id}/address', 'Api\CompleteRegisterUserController@update');
    Route::post('store/saveProfilePicture', 'Api\CompleteRegisterUserController@saveProfilePicture');
    //

   
    // SALVA PETS E AÇÕES
    Route::get('index/petsUsers', 'Api\CompleteRegisterUserController@index');
    Route::post('store/petsUsers', 'Api\CompleteRegisterUserController@store');
    Route::get('show/{id}/address', 'Api\CompleteRegisterUserController@show');
    Route::patch('update/{id}/address', 'Api\CompleteRegisterUserController@update');
    Route::get('index/petsUsers', 'Api\CompleteRegisterUserController@index');

    //

    Route::get('/types/petsUsers', 'Api\CompleteRegisterUserController@listCategories');

});

