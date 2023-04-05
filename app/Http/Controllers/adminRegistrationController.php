<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use App\Models\user;
use App\Models\advisors;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class adminRegistrationController extends Controller
{
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function store(Request $request)
    {
        //dd($request);
        // Validar los datos del usuario
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'addres' => ['required', 'string', 'max:255'],
            'role' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'supervisor' => ['required', 'integer'],
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'lastname.required' => 'El campo apellido es obligatorio',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.email' => 'Ingrese una dirección de correo electrónico válida',
            'email.unique' => 'Esta dirección de correo electrónico ya está en uso',
            'phone.required' => 'El campo teléfono es obligatorio',
            'addres.required' => 'El campo dirección es obligatorio',
            'role.required' => 'El campo rol es obligatorio',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'La confirmación de la contraseña no coincide',
            'supervisor.required' => 'El campo supervisor es obligatorio',
        ]);


        // Crear un nuevo usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'addres' => $validatedData['addres'],
            'role_id' => $validatedData['role'],
            'password' => Hash::make($validatedData['password']),
        ]);

        //obtener el ultimo id de la entrada para registrar al usuario como asesor
        $lastregister = User::latest()->latest()->value('id');
        $porcentage = 1;
        
        /* asignar al supervisor */
        $advisor = advisors::create([
            'user_id' => $lastregister,
            'porcentage_id' => $porcentage,
            'supervisor_id' =>  $validatedData['supervisor'],
        ]);

        // Redireccionar a la vista de usuarios
        return redirect()->route('view_users')->with('success', 'Usuario Guardado con exito');
    }
    
}
