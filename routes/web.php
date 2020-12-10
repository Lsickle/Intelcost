<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('bienes.index');
});

Route::resource('/bienes', 'BienesController');
Route::post('/filtrar', 'AjaxController@filtrar')->name('filtrar');


// Route::post('/changeRol/{id}', 'userController@changeRol');
// Route::resource('/bienes', 'BienesController');
// Route::post('/clientes/{id}/changeComercial', 'ClientController@changeComercial');
// Route::get('/cliente/{slug}', 'ClienteController@show')->name('cliente-show');
// Route::get('/cliente/{slug}/edit', 'ClienteController@edit')->name('cliente-edit');
// Route::put('/cliente/{slug}/update', 'ClienteController@update')->name('cliente-update');
// Route::get('/cliente/{slug}/updateCliStatus', 'ClienteController@updateCliStatus')->name('cliente-updateCliStatus');
// Route::get('/cliente/{slug}/negarCliStatus', 'ClienteController@negarCliStatus')->name('cliente-negarCliStatus');
// Route::get('/cliente/{slug}/TipoFacturacionContado', 'ClienteController@facturacionContado')->name('cliente-facturacionContado');
// Route::get('/cliente/{slug}/TipoFacturacionCredito', 'ClienteController@facturacionCredito')->name('cliente-facturacionCredito');
// Route::resource('/contactos', 'ContactoController');
// Route::post('/contacto-vehiculo-create/{id}', 'VehiculoContactoController@store');
// Route::put('/contacto-vehiculo-edit/{id}', 'VehiculoContactoController@update');
// Route::delete('/contacto-vehiculo-delete/{id}', 'VehiculoContactoController@destroy');
