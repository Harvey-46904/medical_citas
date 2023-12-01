<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\CitasController;
class UserController extends Controller
{
    public function index()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'administrador@esesansebastian.com',
            'password' => bcrypt('123456'),
        ]);
      
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create');
    }

    // Almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario según tus necesidades
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Crear un nuevo usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

       return response(["data"=>"admin creado"]);
    }

    // Mostrar información sobre un usuario específico
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit()
    {
        $logicaCompartida = new CitasController();
        $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
        $user = User::find(1);
        return view('dash.credenciales', compact('user',"totalCitasEnEspera"));
    }

    // Actualizar un usuario específico en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario según tus necesidades
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        // Obtener el usuario a actualizar
        $user = User::find($id);

        // Actualizar los campos
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);
        return redirect('/credenciales')->with('success', 'Credenciales actualizadas correctamente');
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar un usuario específico de la base de datos
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            $logicaCompartida = new CitasController();
            $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
            $nservicios = DB::table("servicios")->count();
            $nusuarios = DB::table("usuarios")->count();
            $ncitas = DB::table("citas")->count();
           
            return view('dash.inicio',compact("totalCitasEnEspera","nservicios","nusuarios","ncitas"));
        } else {
            // Autenticación fallida
            return redirect()->back()->with('success', 'Credenciales incorrectas.');
        }
    }
}
