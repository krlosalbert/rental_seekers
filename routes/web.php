<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USERS
    //ruta para ver los usuarios registrados
    Route::get('/users','App\Http\Controllers\usersController@index')->name('users.index');
    //ruta para ver los usuarios registrados detallados
    Route::get('/users/{id}','App\Http\Controllers\usersController@show')->name('users.show');
    //ruta para el formulario de registro de usuarios
    Route::get('/form_users','App\Http\Controllers\usersController@create')->name('users.create');
    //ruta para registrar usuarios
    Route::post('/register', 'App\Http\Controllers\adminRegistrationController@store')->name('register')->middleware('auth');
    //ruta para el formulario de edicion de usuarios
    Route::get('/users/{id}/edit','App\Http\Controllers\usersController@edit')->name('users.edit');
    //ruta para editar a los usuarios
    Route::put('/users/{id}','App\Http\Controllers\usersController@update')->name('users.update');
    //ruta para eliminar usuarios
    Route::delete('users/{id}','App\Http\Controllers\usersController@destroy')->name('users.destroy');
//FIN RUTAS DE LOS USUARIOS

//ROLES
    //ruta para ver los roles registrados
    Route::get('/roles','App\Http\Controllers\rolesController@index')->name('roles.index');
    //ruta para el formulario de registro de roles
    Route::get('/roles/create','App\Http\Controllers\rolesController@create')->name('roles.create');
    //ruta para registrar roles
    Route::post('/roles', 'App\Http\Controllers\rolesController@store')->name('roles.store');
    //ruta para el formulario de edicion de roles
    Route::get('/roles/{id}/edit','App\Http\Controllers\rolesController@edit')->name('roles.edit');
    //ruta para editar a los roles
    Route::put('/roles/{id}','App\Http\Controllers\rolesController@update')->name('roles.update');
    //ruta para eliminar los roles
    Route::delete('roles/{id}','App\Http\Controllers\rolesController@destroy')->name('roles.destroy');
//FIN RUTA DE LOS ROLES

//SUPERVISORS
    //ruta para ver los supervisores registrados en la db
    Route::get('/supervisors', 'App\Http\Controllers\supervisorsController@index')->name('supervisors.index');
    //ruta para el formulario de creacion de nuevo supervisor
    Route::get('/supervisors/create', 'App\Http\Controllers\supervisorsController@create')->name('supervisors.create');
    //ruta para la creacion de un nuevo supervisor
    Route::post('/supervisors', 'App\Http\Controllers\supervisorsController@store')->name('supervisors.store');
    //ruta para ver detalle de los supervisores
    Route::get('/supervisors/{id}', 'App\Http\Controllers\supervisorsController@show')->name('supervisors.show');
    //ruta para el formulario de edicion del asesor seleccionado
    Route::get('/supervisors/{id}/edit', 'App\Http\Controllers\supervisorsController@edit')->name('supervisors.edit');
    //ruta para actualizar el supervisor del asesor
    Route::put('/supervisors/{id}', 'App\Http\Controllers\supervisorsController@update')->name('supervisors.update');
//FIN RUTA DE LOS SUPERVISORS

//ADVISORS
    //rura para ver los asesores
    Route::get('/advisors', 'App\Http\Controllers\advisorsController@index')->name('advisors.index');
    //ruta para ver las ventas de los asesores
    Route::get('/advisors/{id}', 'App\Http\Controllers\advisorsController@show')->name('advisors.show');
    //ruta para el formulario de edicion del asesor seleccionada
    Route::get('/advisors/{id}/edit', 'App\Http\Controllers\advisorsController@edit')->name('advisors.edit');
    //ruta para actualizar el supervisor del asesor
    Route::put('/advisors/{id}', 'App\Http\Controllers\advisorsController@update')->name('advisors.update');
    //ruta para el reporte de los asesores
    Route::get('/advisors/{id}/reports', 'App\Http\Controllers\advisorsController@reports')->name('advisors.reports');
//FIN RUTA DE LOS ADVISORS

//CLIENTES
    //ruta para el formulario de buscar cliente en la db
    Route::get('/customers', 'App\Http\Controllers\customersController@search')->name('customers.search');
    //ruta para buscar los clientes en la db
    Route::get('/customers/{search}','App\Http\Controllers\customersController@show')->name('customers.show');
    //ruta para elegir el cliente y mandarlo al formulario de ventas
    Route::post('/customers','App\Http\Controllers\customersController@choose_customers')->name('customers.choose');
//FIN RUTA DE CLIENTES

//VENTAS
    //ruta para ver las ventas registradas en la db 
    Route::get('/sales', 'App\Http\Controllers\salesController@index')->name('sales.index');
    //ruta para ve detalle de la venta
    Route::get('/sales/{id}', 'App\Http\Controllers\salesController@show')->name('sales.show');

    //ruta para el formulario de creacion de ventas
        //ruta para formulario de ventas si el cliente no esta registrado en la db 
        Route::get('/form_sales', 'App\Http\Controllers\salesController@create')->name('sales.create');
        //ruta para obtener los barrios dependiendo de la ciudad
        Route::post('/get-neighborhoods', 'App\Http\Controllers\salesController@get_neighborhoods')->name('get-neighborhoods');
        //ruta para obtener los inmuebles dependiendo del barrio
        Route::post('/get_property', 'App\Http\Controllers\salesController@get_property')->name('get_property');
        //ruta para obtener los asesores dependiendo del supervisor
        Route::post('/get-advisors', 'App\Http\Controllers\salesController@get_advisors');
        //ruta para obtener la cuenta dependiendo del banco
        Route::post('/get-accounts', 'App\Http\Controllers\salesController@get_accounts');
    //fin de las rutas

    //ruta para crear una nueva venta
    Route::post('/sales', 'App\Http\Controllers\salesController@store')->name('sales.store');
    //ruta para eliminar las ventas
    Route::delete('/sales/{id}', 'App\Http\Controllers\salesController@destroy')->name('sales.destroy');
//FIN RUTA DE LA VENTAS

//BANCOS
    //ruta para ver los bancos registrados en la db
    Route::get('/banks', 'App\Http\Controllers\banksController@index')->name('banks.index');
    //ruta para el formulario de registro de nuevo banco
    Route::get('/banks/create', 'App\Http\Controllers\banksController@create')->name('banks.create');
    //ruta para la creacion de nuevo banco
    Route::post('/banks', 'App\Http\Controllers\banksController@store')->name('banks.store');
    //ruta para el formulario de edicion del banco seleccionado
    Route::get('/banks/{id}/edit', 'App\Http\Controllers\banksController@edit')->name('banks.edit');
    //ruta para actualizar los bancos
    Route::put('/banks/{id}', 'App\Http\Controllers\banksController@update')->name('banks.update');
    //ruta para eliminar los bancos
    Route::delete('/banks/{id}', 'App\Http\Controllers\banksController@destroy')->name('banks.destroy');
//FIN RUTA DE LOS BANCOS

//CUENTAS
    //ruta para ver las cuentas registradas en la db
    Route::get('/accounts', 'App\Http\Controllers\accountsController@index')->name('accounts.index');
    //ruta para el formulario de registro de nueva cuenta
    Route::get('/accounts/create', 'App\Http\Controllers\accountsController@create')->name('accounts.create');
    //ruta para la creacion de nueva cuenta
    Route::post('/accounts', 'App\Http\Controllers\accountsController@store')->name('accounts.store');
    //ruta para el formulario de edicion de la cuenta seleccionada
    Route::get('/accounts/{id}/edit', 'App\Http\Controllers\accountsController@edit')->name('accounts.edit');
    //ruta para actualizar las cuentas
    Route::put('/accounts/{id}', 'App\Http\Controllers\accountsController@update')->name('accounts.update');
    //ruta para eliminar las cuentas
    Route::delete('/accounts/{id}', 'App\Http\Controllers\accountsController@destroy')->name('accounts.destroy');
//FIN RUTA DE LAS CUENTAS

//CITIES
    //ruta para ver las ciudades registradas en la db
    Route::get('/cities', 'App\Http\Controllers\citiesController@index')->name('cities.index');
    //ruta para el formulario de registro de nueva ciudad
    Route::get('/cities/create', 'App\Http\Controllers\citiesController@create')->name('cities.create');
    //ruta para la creacion de nueva ciudades
    Route::post('/cities', 'App\Http\Controllers\citiesController@store')->name('cities.store');
    //ruta para el formulario de edicion de la ciudad seleccionada
    Route::get('/cities/{id}/edit', 'App\Http\Controllers\citiesController@edit')->name('cities.edit');
    //ruta para actualizar las ciudades
    Route::put('/cities/{id}', 'App\Http\Controllers\citiesController@update')->name('cities.update');
    //ruta para eliminar las ciudades
    Route::delete('/cities/{id}', 'App\Http\Controllers\citiesController@destroy')->name('cities.destroy');
//FIN RUTA DE LAS CIUDADES

//NEIGHBORHOODS
    //ruta para ver los barrios registrados en la db
    Route::get('/neighborhoods', 'App\Http\Controllers\neighborhoodsController@index')->name('neighborhoods.index');
    //ruta para el formulario de registro de nuevo barrio
    Route::get('/neighborhoods/create', 'App\Http\Controllers\neighborhoodsController@create')->name('neighborhoods.create');
    //ruta para la creacion de nueva ciudades
    Route::post('/neighborhoods', 'App\Http\Controllers\neighborhoodsController@store')->name('neighborhoods.store');
    //ruta para el formulario de edicion de la ciudad seleccionada
    Route::get('/neighborhoods/{id}/edit', 'App\Http\Controllers\neighborhoodsController@edit')->name('neighborhoods.edit');
    //ruta para actualizar las ciudades
    Route::put('/cneighborhoods/{id}', 'App\Http\Controllers\neighborhoodsController@update')->name('neighborhoods.update');
    //ruta para eliminar las ciudades
    Route::delete('/neighborhoods/{id}', 'App\Http\Controllers\neighborhoodsController@destroy')->name('neighborhoods.destroy');
//FIN RUTA DE LOS NEIGHBORHOODS

//PROPERTIES
    //ruta para ver las propiedades registradas en la db
    Route::get('/properties', 'App\Http\Controllers\propertiesController@index')->name('properties.index');
    //ruta para el formulario de registro de nueva propiedad
    Route::get('/properties/create', 'App\Http\Controllers\propertiesController@create')->name('properties.create');
    //ruta para la creacion de nueva propiedad
    Route::post('/properties', 'App\Http\Controllers\propertiesController@store')->name('properties.store');
    //ruta para el formulario de edicion de la propiedad seleccionada
    Route::get('/properties/{id}/edit', 'App\Http\Controllers\propertiesController@edit')->name('properties.edit');
    //ruta para actualizar las propiedades
    Route::put('/properties/{id}', 'App\Http\Controllers\propertiesController@update')->name('properties.update');
    //ruta para eliminar las propiedades
    Route::delete('/properties/{id}', 'App\Http\Controllers\propertiesController@destroy')->name('properties.destroy');
//FIN RUTA DE LOS PROPERTIES

//SERVICES
    //ruta para ver los servicios registrados en la db
    Route::get('/services', 'App\Http\Controllers\servicesController@index')->name('services.index');
    //ruta para el formulario de registro de un nuevo servicio
    Route::get('/services/create', 'App\Http\Controllers\servicesController@create')->name('services.create');
    //ruta para la creacion de un nuevo servicio
    Route::post('/services', 'App\Http\Controllers\servicesController@store')->name('services.store');
    //ruta para el formulario de edicion de un servicio seleccionado
    Route::get('/services/{id}/edit', 'App\Http\Controllers\servicesController@edit')->name('services.edit');
    //ruta para actualizar los servicios
    Route::put('/services/{id}', 'App\Http\Controllers\servicesController@update')->name('services.update');
    //ruta para eliminar los servicios
    Route::delete('/services/{id}', 'App\Http\Controllers\servicesController@destroy')->name('services.destroy');
//FIN RUTA DE LOS SERVICES

//REPORTS
    //ruta para ver los informes
    Route::post('/reports', 'App\Http\Controllers\reportsController@index')->name('reports.index');
//FIN RUTA DE LOS REPORTS

