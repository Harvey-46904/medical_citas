<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\CitasController;
use Carbon\Carbon;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes=DB::table("usuarios")->select()->get();
        $logicaCompartida = new CitasController();
            $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
        return view("dash.pacientes",compact("pacientes","totalCitasEnEspera"));
        return response(["data"=>$pacientes]);
    }
    public function buscarDocumento($documento){
        $paciente=DB::table("usuarios")->select("nombre_completo","id","usuarios.cedula")->where("cedula","=",$documento)->first();
        $citas=DB::table("citas")
        ->join("usuarios","citas.usuario_id","=","usuarios.id")
        ->join("servicios","citas.servicio_id","=","servicios.id")
        ->where("usuarios.cedula","=",$documento)
        ->select("citas.id","usuarios.cedula","servicios.nombre_servicio","usuarios.nombre_completo","citas.fecha_cita","citas.estado")
        ->get();

        //limite de citas mensauales dos 
        $mesActual = Carbon::now()->month;
        // Realizar la consulta para contar las citas en el mes actual
        $numeroCitas = DB::table("citas")
        ->join("usuarios","usuarios.id","=","citas.usuario_id")
        ->where("usuarios.cedula","=",$documento)
        ->whereMonth('fecha_cita', $mesActual)
        ->where("citas.estado","=","Aprobada")
        ->count();
       


        return response(["data"=>$paciente,"cita"=>$citas,"informacion"=>$numeroCitas]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $crear_usuario=new usuarios;
        $crear_usuario->cedula=$request->numero_documento;
        $crear_usuario->nombre_completo=$request->nombres_completos;
        $crear_usuario->telefono=$request->telefono;
        $crear_usuario->role_id=1;
        $crear_usuario->save();
        return response(["data"=>$crear_usuario]);
       
    }


    public function post_user(Request $request){
        $crear_usuario=new usuarios;
        $crear_usuario->cedula=$request->numero_documento;
        $crear_usuario->nombre_completo=$request->nombres_completos;
        $crear_usuario->telefono=$request->telefono;
        $crear_usuario->role_id=1;
        $crear_usuario->save();
        return redirect('/usuario')->with('success', 'Paciente guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logicaCompartida = new CitasController();
            $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
        $usuario = usuarios::find($id);
        return view("dash.actualizar_paciente",compact("totalCitasEnEspera","usuario"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = usuarios::find($id);
        if ($usuario) {
            // Actualiza los campos según tus necesidades
            $usuario->cedula = $request->numero_documento;
            $usuario->nombre_completo = $request->nombres_completos;
            $usuario->telefono = $request->telefono;
        
            // Guarda los cambios
            $usuario->save();
            return redirect('/usuario')->with('success', 'Paciente actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('usuarios')
        ->where('id', $id)
        ->delete();
        return back()->with('success', 'Paciente Eliminado');
    }

    public function login(Request $request){
       // return response(["data"=>$request->all()]);
       $logicaCompartida = new CitasController();
       $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
        $nservicios = DB::table("servicios")->count();
        $nusuarios = DB::table("usuarios")->count();
        $ncitas = DB::table("citas")->count();
      
        return view('dash.inicio',compact("totalCitasEnEspera","nservicios","nusuarios","ncitas"));
    }
}
