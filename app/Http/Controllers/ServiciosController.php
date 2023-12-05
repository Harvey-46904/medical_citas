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
       
        //return response(["data"=>$request->all()]);
        $new_servicio=new servicios;
        $new_servicio->nombre_servicio=$request->nombre;
        $new_servicio->save();
        
        servicios_disponibilidad::create([
           'servicio_id'=>$new_servicio->id,

           'profesional_id'=>$request->profesional,
           'lunes'=>$request->Lunes=="on"?1:0,
           'rango_lunes'=>$request->Lunes=="on"?$request->mananafinaldesde0."&".$request->mananafinalhasta0."A".$request->tardefinaldesde0."&".$request->tardefinalhasta0:NULL,
           'martes'=>$request->Martes=="on"?1:0,
           'rango_martes'=>$request->Martes=="on"?$request->mananafinaldesde1."&".$request->mananafinalhasta1."A".$request->tardefinaldesde1."&".$request->tardefinalhasta1:NULL,
           'miercoles'=>$request->Miercoles=="on"?1:0,
           'rango_miercoles'=>$request->Miercoles=="on"?$request->mananafinaldesde2."&".$request->mananafinalhasta2."A".$request->tardefinaldesde2."&".$request->tardefinalhasta2:NULL,
           'jueves'=>$request->Jueves=="on"?1:0,
           'rango_jueves'=>$request->Jueves=="on"?$request->mananafinaldesde3."&".$request->mananafinalhasta3."A".$request->tardefinaldesde3."&".$request->tardefinalhasta3:NULL,
           'viernes'=>$request->Viernes=="on"?1:0,
           'rango_viernes'=>$request->Viernes=="on"?$request->mananafinaldesde4."&".$request->mananafinalhasta4."A".$request->tardefinaldesde4."&".$request->tardefinalhasta4:NULL,
           'sabado'=>$request->Sabado=="on"?1:0,
           'rango_sabado'=>$request->Sabado=="on"?$request->mananafinaldesde5."&".$request->mananafinalhasta5."A".$request->tardefinaldesde5."&".$request->tardefinalhasta5:NULL,
           'domingo'=>$request->Domingo=="on"?1:0,
           'rango_domingo'=>$request->Domingo=="on"?$request->mananafinaldesde6."&".$request->mananafinalhasta6."A".$request->tardefinaldesde6."&".$request->tardefinalhasta6:NULL,
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
