<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\porcentages;
use App\Models\supervisors;
use App\Models\advisors;
use Illuminate\Support\Facades\Session;

class supervisorsController extends Controller
{
    /* metodo para mostrar los supervisores */
    public function index(){
        $supervisors = supervisors::select( '*',
                                            'supervisors.id as id_supervisors',
                                            'name as name_supervisors',
                                            'lastname as lastname_supervisors')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();

        return view('supervisors.index', compact('supervisors'));
    }
    /* metodo para mostar el formulario de creacion de nuevo supervisor */
    public function create()
    {
        //declaro una coleccion para atrapar los id de los supervisores ya registrados
        $id_supervisors = collect();
        //instancio la clase para traer esos id
        $supervisors = supervisors::select('supervisors.user_id as id_supervisors')
        ->get();
        //recorro el arreglo y los añado a mi coleccion
        foreach($supervisors as $supervisor){
            $id_supervisors->push($supervisor->id_supervisors);
        }
        //instancio la clase de los usuarios para traer solo los que no son supervisores
        $users = User::select('*')
        ->whereNotIn('id', $id_supervisors->all())
        ->get();
        //retorno la variable a la vista
        return view('supervisors.create', compact('users'));
    }

    /* metodo para insertar en la db el nuevo supervisor */
    protected function store(Request $request)
    {
        
        $supervisors = $request->validate([
            'user_id' => ['required', 'integer'],
        ]);
    
        // Crear un nuevo supervisor
        $supervisor = supervisors::create([
            'user_id' => $supervisors['user_id'],
            'porcentage_id' => 2,
        ]);
        
        // Redireccionar a la vista de roles
        return redirect()->route('supervisors.index')->with('success', 'supervisor Guardado  con exito');
    }

    //metodo para ver detalles de los supervisores
    public function show(Request $request, $id)
    {
        //le asigno a la variable la clave para diferenciar la vista
        $delete = $request->clave;
        //consulto si tiene asesores a su cargo
        $advisors = advisors::select('*',
                                    'advisors.id as id_advisors',
                                    'users.name as name_advisors',
                                    'users.lastname as lastname_advisors')
        ->join('users', 'advisors.user_id', '=', 'users.id')
        ->where('advisors.supervisor_id', '=', $id)
        ->get();

        if($request->clave == 2){

            //valido si la respuesta es vacia
            if ($advisors->isEmpty())
            {
                //llamo el metodo destroy y elimino el asesor
                $response = $this->destroy($id);
                //mando la respuesta a la vista
                return $response;
            }
        }
        //en caso de tener asesores mando a la vista para cambiar al supervisor
        return view('supervisors.show', compact('advisors', 'delete')); 

    }

    //metodo para editar el supervisor de los asesores
    public function edit(Request $request, $id)
    {   // Obtener el array de IDs y asignarlo a una variable
        $advisorIds = [$request->ids];
        $advisor_id = $id;
        // Agregar el array a la sesión
        Session::put('advisor_ids', $advisorIds);

        //instancio la calse para traer los supervisores
        $supervisors = supervisors::select( '*', 'supervisors.id as supervisor_id')
        ->join('users', 'supervisors.user_id', '=', 'users.id')
        ->get();
        //retorno las variables a la vista
        return view('supervisors.edit', compact('supervisors', 'advisor_id'));
    }

    /* metodo para actualizar el supervisor */
    public function update(Request $request)
    {
        $ids = Session::get('advisor_ids')[0];
        //dd($ids);
        $validatedData = $request->validate([
            'supervisor_id' => 'required|integer'
        ]);
    
        foreach ($ids as $id) {
            advisors::where('id', $id)->update($validatedData);
        }
        //redirecciono a la vista
        return redirect()->route('supervisors.index')->with('update', 'Supervisor asigando correctamente');
    }

    //metodo para eliminar los supervisores
    public function destroy($id){
        $supervisor = supervisors::findOrFail($id);
        //pregunto su fue exitoso la eliminacion
        if ($supervisor->delete()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
