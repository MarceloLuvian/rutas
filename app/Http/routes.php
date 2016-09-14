<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::resource('guardarnominal2','listadoNominal');

Route::resource('guardarruta2','rutaController');


Route::get('/home', 'HomeController@index');

Route::get('municipalesusuarios', ['as' => '/municipalesusuarios', 'uses' => 'estatalController@municipalusuarios']);

Route::get('/estatalestructura', ['as' => '/estatalestructura', 'uses' => 'estatalController@index']);

Route::get('/inicio', ['as' => '/inicio', 'uses' => 'listadoNominal@index']);


Route::get('/listado', ['as' => '/listado', 'uses' => 'listadoNominal@vistaNominal']);

Route::get('/ruta', ['as' => '/ruta', 'uses' => 'rutaController@index']);

Route::get('/reportes', ['as' => '/reportes', 'uses' => 'reportesController@index']);

Route::post('/reporteDistrial', ['as' => '/reporteDistrial', 'uses' => 'reportesController@reporteDistrial']);

Route::post('/reporteDistrialnominal', ['as' => '/reporteDistrialnominal', 'uses' => 'reportesController@reporteDistrialnominal']);

Route::post('/reportef3', ['as' => '/reportef3', 'uses' => 'reportesController@reportef3']);

Route::post('/reportef4', ['as' => '/reportef4', 'uses' => 'reportesController@reportef4']);

Route::post('/reportef4estatal', ['as' => '/reportef4estatal', 'uses' => 'estatalController@reportef4']);

Route::get('/secciones/{municipio}', ['as' => '/secciones/{municipio}', 'uses' => 'rutaController@secciones']);

Route::get('/municipio/{municipio}', ['as' => '/municipio/{municipio}', 'uses' => 'listadoNominal@municipio']);

Route::get('/municipios/{distrito}', ['as' => '/municipios/{distrito}', 'uses' => 'estatalController@municipios']);


Route::get('/rutas/{seccion}', ['as' => '/rutas/{seccion}', 'uses' => 'listadoNominal@rutasregistradas']);

Route::get('buscarnominal/{clave_elector}/{seccion}/{ruta}', ['as' => 'buscarnominal/{clave_elector}/{seccion}/{ruta}', 'uses' => 'listadoNominal@buscarnominal']);

Route::post('guardarRuta', ['as' => 'guardarRuta', 'uses' => 'rutaController@guardarRuta']);

Route::get('guardarResponsable/{nombre}/{seccion}/{municipio}', ['as' => 'guardarResponsable/{nombre}/{seccion}/{municipio}', 'uses' => 'rutaController@guardarResponsable']);


Route::post('guardarnominal', ['as' => 'guardarnominal', 'uses' => 'listadoNominal@guardarnominal']);

Route::get('/reportesEstatales', ['as' => '/reportesEstatales', 'uses' => 'estatalController@vistaseleccion']);

Route::get('/reportef4get/{distrito}', ['as' => '/reportef4get/{distrito}', 'uses' => 'estatalController@reportef4get']);

Route::get('/reportef4get2/{distrito}', ['as' => '/reportef4get2/{distrito}', 'uses' => 'estatalController@reportef4get2']);

Route::get('/cargarTabla/{seccion}/{ruta}', ['as' => '/cargarTabla/{seccion}/{ruta}', 'uses' => 'rutaController@cargarTabla']); 

Route::get('/candidatos', ['as' => '/candidatos', 'uses' => 'estatalController@candidatos']);

Route::get('/comprobarrutas/{seccion}/{ruta}', ['as' => '/comprobarrutas/{seccion}/{ruta}', 'uses' => 'listadoNominal@comprobarrutas']);

Route::get('/editarRuta/{id}', ['as' => '/editarRuta/{id}', 'uses' => 'rutaController@editar']);

Route::get('/eliminarRuta/{id}', ['as' => '/eliminarRuta/{id}', 'uses' => 'rutaController@eliminarRuta']);

Route::get('/eliminarNominal/{id}', ['as' => '/eliminarNominal/{id}', 'uses' => 'listadoNominal@eliminarNominal']);

Route::get('/cargarNominal/{ruta}/{seccion}', ['as' => '/eliminarNominal/{ruta}/{seccion}', 'uses' => 'listadoNominal@cargarNominal']);

Route::get('/cargarResponsable/{id}', ['as' => '/cargarResponsable/{id}', 'uses' => 'rutaController@cargarResponsable']);

Route::get('/editarResponsable/{id}/{nombre}', ['as' => '/editarResponsable/{id}/{nombre}', 'uses' => 'rutaController@editarResponsable']);

Route::get('/nominalMunicipal/{municipio}', ['as' => '/nominalMunicipal/{municipio}', 'uses' => 'listadoNominal@nominalMunicipal']);



Route::get('/editarRuta/{id}/{localidad}/{dis}/{vi}/{medio}/{tiempo}/{vehiculo}/{placas}/{cantidadV}/{costo}/{electores}/{meta}', ['as' => '/editarRuta/{id}/{localidad}/{dis}/{vi}/{medio}/{tiempo}/{vehiculo}/{placas}/{cantidadV}/{costo}/{electores}/{meta}', 'uses' => 'rutaController@editarRuta']);
