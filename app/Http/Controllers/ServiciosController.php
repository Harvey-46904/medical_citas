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
           'rango_lunes'=>self::validar_horarios($request->Lunes,$request->m0,$request->t0,$request->mananafinaldesde0,$request->mananafinalhasta0,$request->tardefinaldesde0,$request->tardefinalhasta0),
           'martes'=>$request->Martes=="on"?1:0,
           'rango_martes'=>self::validar_horarios($request->Martes,$request->m1,$request->t1,$request->mananafinaldesde1,$request->mananafinalhasta1,$request->tardefinaldesde1,$request->tardefinalhasta1),
           'miercoles'=>$request->Miercoles=="on"?1:0,
           'rango_miercoles'=>self::validar_horarios($request->Miercoles,$request->m2,$request->t2,$request->mananafinaldesde2,$request->mananafinalhasta2,$request->tardefinaldesde2,$request->tardefinalhasta2),
           'jueves'=>$request->Jueves=="on"?1:0,
           'rango_jueves'=>self::validar_horarios($request->Jueves,$request->m3,$request->t3,$request->mananafinaldesde3,$request->mananafinalhasta3,$request->tardefinaldesde3,$request->tardefinalhasta3),
           'viernes'=>$request->Viernes=="on"?1:0,
           'rango_viernes'=>self::validar_horarios($request->Viernes,$request->m4,$request->t4,$request->mananafinaldesde4,$request->mananafinalhasta4,$request->tardefinaldesde4,$request->tardefinalhasta4),
           'sabado'=>$request->Sabado=="on"?1:0,
           'rango_sabado'=>self::validar_horarios($request->Sabado,$request->m5,$request->t5,$request->mananafinaldesde5,$request->mananafinalhasta5,$request->tardefinaldesde5,$request->tardefinalhasta5),
           'domingo'=>$request->Domingo=="on"?1:0,
           'rango_domingo'=>self::validar_horarios($request->Domingo,$request->m6,$request->t6,$request->mananafinaldesde6,$request->mananafinalhasta6,$request->tardefinaldesde6,$request->tardefinalhasta6),
           'limite_servico'=>$request->limite,
           'rango_minutos'=>$request->rango,
           'visibilidad'=>TRUE,
        ]);
       

        return redirect('/servicios')->with('success', 'Servicio guardado correctamente');
        return response(["data"=>$request->all()]);
    }

    public function validar_horarios($dia,$jornadam,$jornadat,$manana_inicio,$manana_fin,$tarde_inicio,$tarde_fin){
        $cadena="";
        if($dia=="on"){
            if($jornadam=="on" && $jornadat=="on"){
                $cadena=$manana_inicio."&".$manana_fin."A".$tarde_inicio."&".$tarde_fin;
            }else {
               if($jornadam=="on"){
                $cadena= $manana_inicio."&".$manana_fin."A"."&";
               }if($jornadat=="on"){
                $cadena="&"."A".$tarde_inicio."&".$tarde_fin;
               }
            }

        }else{
            $cadena= "&A&";
        }
        return $cadena;
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
            'lunes'=>$request->Lunes=="on"?1:0,
            'rango_lunes'=>self::validar_horarios($request->Lunes,$request->m0,$request->t0,$request->mananafinaldesde0,$request->mananafinalhasta0,$request->tardefinaldesde0,$request->tardefinalhasta0),
           'martes'=>$request->Martes=="on"?1:0,
           'rango_martes'=>self::validar_horarios($request->Martes,$request->m1,$request->t1,$request->mananafinaldesde1,$request->mananafinalhasta1,$request->tardefinaldesde1,$request->tardefinalhasta1),
           'miercoles'=>$request->Miercoles=="on"?1:0,
           'rango_miercoles'=>self::validar_horarios($request->Miercoles,$request->m2,$request->t2,$request->mananafinaldesde2,$request->mananafinalhasta2,$request->tardefinaldesde2,$request->tardefinalhasta2),
           'jueves'=>$request->Jueves=="on"?1:0,
           'rango_jueves'=>self::validar_horarios($request->Jueves,$request->m3,$request->t3,$request->mananafinaldesde3,$request->mananafinalhasta3,$request->tardefinaldesde3,$request->tardefinalhasta3),
           'viernes'=>$request->Viernes=="on"?1:0,
           'rango_viernes'=>self::validar_horarios($request->Viernes,$request->m4,$request->t4,$request->mananafinaldesde4,$request->mananafinalhasta4,$request->tardefinaldesde4,$request->tardefinalhasta4),
           'sabado'=>$request->Sabado=="on"?1:0,
           'rango_sabado'=>self::validar_horarios($request->Sabado,$request->m5,$request->t5,$request->mananafinaldesde5,$request->mananafinalhasta5,$request->tardefinaldesde5,$request->tardefinalhasta5),
           'domingo'=>$request->Domingo=="on"?1:0,
           'rango_domingo'=>self::validar_horarios($request->Domingo,$request->m6,$request->t6,$request->mananafinaldesde6,$request->mananafinalhasta6,$request->tardefinaldesde6,$request->tardefinalhasta6),
            'limite_servico'=>$request->limite,
            'rango_minutos'=>$request->rango,
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
