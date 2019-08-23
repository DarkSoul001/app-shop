<?php

Route::get('/', 'TestController@welcome');

Route::get('/prueba',function(){
	return 'Hola soy una prueba';
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth','admin'])->prefix('admin')->group(function(){

	Route::get('/products','ProductController@index');// listado de productos

	Route::get('/products/create','ProductController@create');//formulario de registro
	Route::post('/products','ProductController@store');//función registrar
	
	Route::get('/products/{id}/edit','ProductController@edit');//formulario edicion
	Route::post('/products/{id}/edit','ProductController@update');//funcion update
	
	Route::post('/products/{id}/delete','ProductController@destroy');//formulario eliminacion
	
	Route::get('/products/{id}/images','ImageController@index');//listdo
	Route::post('/products/{id}/images','ImageController@store');//Agregar imagenes
	Route::delete('/products/{id}/images','ImageController@destroy');//eliminar imagens
	Route::post('/products/{id}/images/featured/{image}','ImageController@featured');//destacar imagen
});



