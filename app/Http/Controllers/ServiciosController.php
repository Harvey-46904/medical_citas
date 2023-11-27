<?php

namespace App\Http\Controllers;

use App\Models\servicios;
use App\Models\servicios_disponibilidad;
use Illuminate\Http\Request;
use DB;
class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        $consultas=DB::table("servicios")
       
        ->join('servicios_disponibilidads', 'servicios.id', '=', 'servicios_disponibilidads.servicio_id')
        ->select("servicios.nombre_servicio","servicios_disponibilidads.*")
        ->get();
        return view('dash.servicios',compact("consultas","totalCitasEnEspera"));
    }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $new_servicio=new servicios;
        $new_servicio->nombre_servicio=$request->nombre;
        $new_servicio->save();
        
        servicios_disponibilidad::create([
           'servicio_id'=>$new_servicio->id,
           'lunes'=>$request->lunes=="on"?1:0,
           'martes'=>$request->martes=="on"?1:0,
           'miercoles'=>$request->miercoles=="on"?1:0,
           'jueves'=>$request->jueves=="on"?1:0,
           'viernes'=>$request->viernes=="on"?1:0,
           'sabado'=>$request->sabado=="on"?1:0,
           'domingo'=>$request->domingo=="on"?1:0,
           'limite_servico'=>$request->limite,
           'rango_minutos'=>$request->rango,
        ]);

        return redirect('/servicios')->with('success', 'Servicio guardado correctamente');
        return response(["data"=>$request->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function show(servicios $servicios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function edit(servicios $servicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, servicios $servicios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy(servicios $servicios)
    {
        //
    }

    public function datasnuestras(){
        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        $nservicios = DB::table("servicios")->count();
        $nusuarios = DB::table("usuarios")->count();
        $ncitas = DB::table("citas")->count();
       
        return view('dash.inicio',compact("totalCitasEnEspera","nservicios","nusuarios","ncitas"));
    }
}
