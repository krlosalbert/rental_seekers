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
//ruta para el formulario de registro de usuarios
Route::get('/form_users','App\Http\Controllers\usersController@form')->name('form_users');
//ruta para registrar usuarios
Route::get('/register', 'App\Http\Controllers\adminRegistrationController@showRegistrationForm');
Route::post('/register', 'App\Http\Controllers\adminRegistrationController@store')->name('register')->middleware('auth');
//ruta para el formulario de edicion de usuarios
Route::get('/ReadUpdate/{id}','App\Http\Controllers\UserController@ReadUpdate')->name('ReadUpdate');
//ruta para editar a los usuarios
Route::put('/Update/{id}','App\Http\Controllers\UserController@Update')->name('Update');
//ruta para eliminar usuarios
Route::delete('DeleteUsers/{id}','App\Http\Controllers\UserController@destroy')->name('DeleteUsers.destroy');


//supervisors
Route::get('/view_supervisors', [App\Http\Controllers\supervisorsController::class, 'read'])->name('view_supervisors');
Route::get('/form_supervisors', [App\Http\Controllers\supervisorsController::class, 'form'])->name('form_supervisors');
Route::post('/create_supervisor', [App\Http\Controllers\supervisorsController::class, 'create'])->name('create_supervisor');

//advisors
Route::get('/view_advisors', [App\Http\Controllers\advisorsController::class, 'read'])->name('view_advisors');

//sales
Route::get('/form_sales', [App\Http\Controllers\salesController::class, 'form'])->name('form_sales');