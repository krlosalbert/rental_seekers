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
//ruta para el formulario de registro de usuarios
Route::get('/form_roles','App\Http\Controllers\rolesController@form')->name('form_roles');
Route::post('/create_roles', 'App\Http\Controllers\rolesController@create')->name('create_roles');

//supervisors
Route::get('/view_supervisors', [App\Http\Controllers\supervisorsController::class, 'read'])->name('view_supervisors');
Route::get('/form_supervisors', [App\Http\Controllers\supervisorsController::class, 'form'])->name('form_supervisors');
Route::post('/create_supervisor', [App\Http\Controllers\supervisorsController::class, 'create'])->name('create_supervisor');

//advisors
Route::get('/view_advisors', [App\Http\Controllers\advisorsController::class, 'read'])->name('view_advisors');

//sales
Route::get('/form_sales', [App\Http\Controllers\salesController::class, 'form'])->name('form_sales');