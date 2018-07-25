<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' =>['auth']],function(){

  //Ruta para el home
  Route::get('/', 'HomeController@index')->name('home');
  //-----------------------------------------------------

  //Cargar Productos
  Route::get('cargarProductos',[
    'uses' => 'ProductosController@vista',
    'as'   => 'cargarProductos'
  ]);
  //Ruta para crear el producto
  Route::post('cargarProductos',[
    'uses' => 'ProductosController@store',
    'as'   => 'cargarProductos.store'
  ]);
  //Ruta para eliminar los productos
  Route::get('cargarProductos/{id}/destroy',[
    'uses' => 'ProductosController@destroy',
    'as'   => 'cargarProductos.destroy'
  ]);
  //-----------------------------------------------------

  //Cotizar
  Route::get('cotizar',[
    'uses' => 'CotizarController@vista',
    'as'   => 'cotizar'
  ]);

  //Rutas para el CRUD de menus
  Route::resource('menus','MenuController');
  Route::get('menus/{id}/destroy',[
    'uses' => 'MenuController@destroy',
    'as'   => 'menus.destroy'
  ]);
  //-----------------------------------------------------
  //Ruta para los ver los iconos de los menus
  Route::get('iconos',[
    'uses' => 'MenuController@iconos',
    'as'   => 'menus.iconos'
  ]);
  //-----------------------------------------------------
  //Rutas para el CRUD de permisos
  Route::resource('permisos','PermisoController');
  Route::get('permisos/menus/{id}/{tipo}','PermisoController@menus');
  //-----------------------------------------------------
  //Rutas para el CRUD de usuarios
  Route::resource('users','UserController');
  Route::get('users/{id}/destroy',[
    'uses' => 'UserController@destroy',
    'as'   => 'users.destroy'
  ]);
  //-----------------------------------------------------

});
Auth::routes();
