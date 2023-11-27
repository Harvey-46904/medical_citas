<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use Illuminate\Http\Request;
use DB;
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
        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        return view("dash.pacientes",compact("pacientes","totalCitasEnEspera"));
        return response(["data"=>$pacientes]);
    }
    public function buscarDocumento($documento){
        $paciente=DB::table("usuarios")->select("nombre_completo","id")->where("cedula","=",$documento)->first();
        return response(["data"=>$paciente]);
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
        $crear_usuario->role_id=1;
        $crear_usuario->save();
        return response(["data"=>$crear_usuario]);
       
    }


    public function post_user(Request $request){
        $crear_usuario=new usuarios;
        $crear_usuario->cedula=$request->numero_documento;
        $crear_usuario->nombre_completo=$request->nombres_completos;
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
    public function edit(usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(usuarios $usuarios)
    {
        //
    }

    public function login(Request $request){
       // return response(["data"=>$request->all()]);
        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        $nservicios = DB::table("servicios")->count();
        $nusuarios = DB::table("usuarios")->count();
        $ncitas = DB::table("citas")->count();
        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        return view('dash.inicio',compact("totalCitasEnEspera","nservicios","nusuarios","ncitas"));
    }
}
