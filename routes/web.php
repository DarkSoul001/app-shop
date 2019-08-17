<?php

Route::get('/', 'TestController@welcome');

Route::get('/prueba',function(){
    return 'Hola soy una prueba';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/products','ProductController@index');// listado de productos
Route::get('/admin/products/create','ProductController@create');//formulario de registro
Route::get('/admin/product/{id}/edit','ProductController@edit');//formulario edicion

Route::post('/admin/product/{id}/delete','ProductController@destroy');//formulario eliminacion
Route::post('/admin/products','ProductController@store');//función registrar
Route::post('/admin/products/{id}/edit','ProductController@update');//funcion update