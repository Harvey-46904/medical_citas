<?php

namespace App\Http\Controllers;

use App\Models\servicios;
use App\Models\servicios_disponibilidad;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\CitasController;
class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logicaCompartida = new CitasController();
        $totalCitasEnEspera =$logicaCompartida->notificacion_cita();



        $profesionales=DB::table("profesionales")->select()->get();
        $consultas=DB::table("servicios")
       
        ->join('servicios_disponibilidads', 'servicios.id', '=', 'servicios_disponibilidads.servicio_id')
        ->join('profesionales','servicios_disponibilidads.profesional_id','=','profesionales.id')
        ->select("servicios.nombre_servicio","servicios_disponibilidads.*","profesionales.nombre_profesinal")
        ->where("servicios_disponibilidads.visibilidad","=",TRUE)
        ->get();
       
        return view('dash.servicios',compact("consultas","totalCitasEnEspera","profesionales"));
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

           'profesional_id'=>$request->profesional,
           'lunes'=>$request->lunes=="on"?1:0,
           'rango_lunes'=>$request->lunes=="on"?$request->horaDesdeLunes."&".$request->horaHastaLunes:NULL,
           'martes'=>$request->martes=="on"?1:0,
           'rango_martes'=>$request->martes=="on"?$request->horaDesdeMartes."&".$request->horaHastaMartes:NULL,
           'miercoles'=>$request->miercoles=="on"?1:0,
           'rango_miercoles'=>$request->miercoles=="on"?$request->horaDesdeMiercoles."&".$request->horaHastaMiercoles:NULL,
           'jueves'=>$request->jueves=="on"?1:0,
           'rango_jueves'=>$request->jueves=="on"?$request->horaDesdeJueves."&".$request->horaHastaJueves:NULL,
           'viernes'=>$request->viernes=="on"?1:0,
           'rango_viernes'=>$request->viernes=="on"?$request->horaDesdeViernes."&".$request->horaHastaViernes:NULL,
           'sabado'=>$request->sabado=="on"?1:0,
           'rango_sabado'=>$request->sabado=="on"?$request->horaDesdeSabado."&".$request->horaHastaSabado:NULL,
           'domingo'=>$request->domingo=="on"?1:0,
           'rango_domingo'=>$request->domingo=="on"?$request->horaDesdeDomingo."&".$request->horaHastaDomingo:NULL,
           'limite_servico'=>$request->limite,
           'rango_minutos'=>$request->rango,
           'visibilidad'=>TRUE,
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
    public function edit($id)
    {
        $logicaCompartida = new CitasController();
        $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
       
        $consulta=DB::table("servicios")
        ->join('servicios_disponibilidads', 'servicios.id', '=', 'servicios_disponibilidads.servicio_id')
        ->select("servicios.id AS id_servi","servicios.nombre_servicio","servicios_disponibilidads.*")
        ->where("servicios_disponibilidads.servicio_id","=",$id)
        ->first();
      
        return view("dash.actualizar_servicio",compact("totalCitasEnEspera","consulta"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('servicios_disponibilidads')
        ->where('servicio_id', $id)
        ->update([
            'lunes' => $request->lunes == "on" ? 1 : 0,
            'martes' => $request->martes == "on" ? 1 : 0,
            'miercoles' => $request->miercoles == "on" ? 1 : 0,
            'jueves' => $request->jueves == "on" ? 1 : 0,
            'viernes' => $request->viernes == "on" ? 1 : 0,
            'sabado' => $request->sabado == "on" ? 1 : 0,
            'domingo' => $request->domingo == "on" ? 1 : 0,
            'limite_servico' => $request->limite,
            'rango_minutos' => $request->rango,
        ]);
        return redirect('/servicios')->with('success', 'servicio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('servicios_disponibilidads')
        ->where('id', $id)
        ->update(['visibilidad' => FALSE]);
        return back()->with('success', 'Servicio Eliminado');
    }

    public function datasnuestras(){
        $logicaCompartida = new CitasController();
        $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
        $nservicios = DB::table("servicios")->join("servicios_disponibilidads","servicios.id","=","servicios_disponibilidads.servicio_id")->where("visibilidad","=",TRUE)->count();
        $nusuarios = DB::table("usuarios")->count();
        $ncitas = DB::table("citas")->count();
       
        return view('dash.inicio',compact("totalCitasEnEspera","nservicios","nusuarios","ncitas"));
    }
}
