<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USUARIOS
//ruta para ver los usuarios registrados
Route::get('/view_users','App\Http\Controllers\usersController@read')->name('view_users');
//ruta para ver los usuarios registrados detallados
Route::post('/details_users','App\Http\Controllers\usersController@details')->name('details_users');
//ruta para el formulario de registro de usuarios
Route::get('/form_users','App\Http\Controllers\usersController@form')->name('form_users');
//ruta para registrar usuarios
Route::post('/register', 'App\Http\Controllers\adminRegistrationController@store')->name('register')->middleware('auth');
//ruta para el formulario de edicion de usuarios
Route::get('/form_update_users','App\Http\Controllers\usersController@read_update')->name('form_update_users');
//ruta para editar a los usuarios
Route::put('/update_users/{id}','App\Http\Controllers\usersController@update')->name('update_users');
//ruta para eliminar usuarios
Route::delete('delete_users/{id}','App\Http\Controllers\usersController@destroy')->name('delete_users');

//ROLES
//ruta para ver los roles registrados
Route::get('/view_roles','App\Http\Controllers\rolesController@read')->name('view_roles');
//ruta para el formulario de registro de roles
Route::get('/form_roles','App\Http\Controllers\rolesController@form')->name('form_roles');
//ruta para registrar roles
Route::post('/create_roles', 'App\Http\Controllers\rolesController@create')->name('create_roles');
//ruta para el formulario de edicion de roles
Route::post('/form_update_roles','App\Http\Controllers\rolesController@read_update')->name('form_update_roles');
//ruta para editar a los roles
Route::put('/update_roles/{id}','App\Http\Controllers\rolesController@update')->name('update_roles');
//ruta para eliminar los roles
Route::delete('delete_roles/{id}','App\Http\Controllers\rolesController@destroy')->name('delete_roles');

//SUPERVISORES
Route::get('/view_supervisors', [App\Http\Controllers\supervisorsController::class, 'read'])->name('view_supervisors');
Route::get('/form_supervisors', [App\Http\Controllers\supervisorsController::class, 'form'])->name('form_supervisors');
Route::post('/create_supervisor', [App\Http\Controllers\supervisorsController::class, 'create'])->name('create_supervisor');

//ASESORES
//rura para ver los asesores
Route::get('/view_advisors', [App\Http\Controllers\advisorsController::class, 'read'])->name('view_advisors');
//ruta para el formulario de edicion de roles
Route::post('/supervisor_advisor','App\Http\Controllers\advisorsController@supervisor_advisor')->name('supervisor_advisor');

//VENTAS
//ruta para ver las ventas registradas en la db 
Route::get('/view_sales', [App\Http\Controllers\salesController::class, 'view'])->name('view_sales');
//ruta para ve detalle de la venta
Route::post('/details_sales', [App\Http\Controllers\salesController::class, 'details_sales'])->name('details_sales');


//ruta para el formulario de creacion de ventas
    //ruta para formulario de ventas si el cliente no esta registrado en la db 
    Route::get('/form_sales', [App\Http\Controllers\salesController::class, 'form'])->name('form_sales');
    //ruta para formulario de ventas si el cliente esta registrado
    Route::post('/form_sales', [App\Http\Controllers\salesController::class, 'form'])->name('form_sales');
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
Route::post('/create_sales', [App\Http\Controllers\salesController::class, 'create'])->name('create_sales');
//ruta para eliminar las ventas
Route::delete('/delete_sales/{id}', 'App\Http\Controllers\salesController@destroy')->name('delete_sales');


//CLIENTES
//ruta para el formulario de buscar cliente en la db
Route::get('/form_customers', [App\Http\Controllers\customersController::class, 'form'])->name('form_customers');
//ruta para buscar los clientes en la db
Route::post('/search_customers','App\Http\Controllers\customersController@search_customers')->name('search_customers');
//ruta para elegir el cliente y mandarlo al formulario de ventas
Route::post('/choose_customers','App\Http\Controllers\customersController@choose_customers')->name('choose_customers');

//BANCOS
//ruta para ver los bancos registrados en la db
Route::get('/view_banks', 'App\Http\Controllers\banksController@view')->name('view_banks');
//ruta para el formulario de registro de nuevo banco
Route::get('/form_banks', 'App\Http\Controllers\banksController@form')->name('form_banks');
//ruta para la creacion de nuevo banco
Route::post('/create_banks', 'App\Http\Controllers\banksController@create')->name('create_banks');
//ruta para el formulario de edicion del banco seleccionado
Route::post('/form_update_banks', 'App\Http\Controllers\banksController@form_update')->name('form_update_banks');
//ruta para actualizar los bancos
Route::put('/update_banks/{id}', 'App\Http\Controllers\banksController@update')->name('update_banks');
//ruta para eliminar los bancos
Route::delete('/delete_banks/{id}', 'App\Http\Controllers\banksController@destroy')->name('delete_banks');

//CUENTAS
//ruta para ver las cuentas registradas en la db
Route::get('/index_accounts', 'App\Http\Controllers\accountsController@index')->name('index_accounts');
//ruta para el formulario de registro de nueva cuenta
Route::get('/create_accounts', 'App\Http\Controllers\accountsController@create')->name('create_accounts');
//ruta para la creacion de nueva cuenta
Route::post('/store_accounts', 'App\Http\Controllers\accountsController@store')->name('store_accounts');
//ruta para el formulario de edicion de la cuenta seleccionada
Route::post('/form_update_accounts', 'App\Http\Controllers\accountsController@form_update')->name('form_update_accounts');
//ruta para actualizar las cuentas
Route::put('/update_accounts/{id}', 'App\Http\Controllers\accountsController@update')->name('update_accounts');
//ruta para eliminar las cuentas
Route::delete('/delete_accounts/{id}', 'App\Http\Controllers\accountsController@destroy')->name('delete_accounts');

//INFORMES
//ruta para ver los informes
Route::get('/view_informes', 'App\Http\Controllers\informesController@view')->name('view_informes');
Route::post('/view_informe', 'App\Http\Controllers\informesController@supervisors')->name('view_informe');
Route::get('/search_supervisor', 'App\Http\Controllers\informesController@search_supervisor');
Route::post('/search_supervisor', 'App\Http\Controllers\informesController@search_supervisor')->name('search_supervisor');


