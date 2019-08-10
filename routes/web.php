<?php

Route::get('/', 'TestController@welcome');

Route::get('/prueba',function(){
    return 'Hola soy una prueba';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
