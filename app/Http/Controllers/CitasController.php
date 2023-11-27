<?php

namespace App\Http\Controllers;

use App\Models\citas;
use Illuminate\Http\Request;
use DB;
class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = DB::table("citas")->where('estado', 'Aprobada')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","citas.fecha_cita","servicios.nombre_servicio")
        ->get();


        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        return view('dash.lista_citas',compact("citas","totalCitasEnEspera"));
        
    }
    public function citas_rechazadas(){
        $citas = DB::table("citas")->where('estado', 'Rechazada')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","citas.fecha_cita","servicios.nombre_servicio")
        ->get();
        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        return view('dash.lista_citas',compact("citas","totalCitasEnEspera"));
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
        $citas_id_unico=DB::table("servicios_disponibilidads")
        ->select("servicios_disponibilidads.servicio_id")
        ->where("servicios_disponibilidads.id","=",$request->servicio_id)
        ->first();
       
        $crear_cita=new citas;
        $crear_cita->usuario_id=$request->usuario_id;
        $crear_cita->servicio_id=$citas_id_unico->servicio_id;
        $crear_cita->fecha_cita=$request->fecha_cita;
        $crear_cita->estado="En espera";
        
        $crear_cita->save();
        return response(["data"=>"ciita guardada"]);
    }

    public function limite_citas(){
        $resultados = DB::table('citas')
        ->join('servicios', 'citas.servicio_id', '=', 'servicios.id')
        ->join('servicios_disponibilidads', 'servicios_disponibilidads.servicio_id', '=', 'servicios.id')
        ->select('citas.servicio_id', 'servicios_disponibilidads.limite_servico', DB::raw('DATE(fecha_cita) as fecha'), DB::raw('COUNT(*) as total'))
        ->groupBy('citas.servicio_id', 'fecha', 'servicios_disponibilidads.limite_servico')
        ->where('estado', '=', 'Aprobada')
        ->havingRaw('COUNT(*) >= servicios_disponibilidads.limite_servico')
        ->get();

        return response(["data"=>$resultados]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function show(citas $citas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function edit(citas $citas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, citas $citas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function destroy(citas $citas)
    {
        //
    }

    public function crear_cita(){
        $citas=DB::table("servicios")
        ->join('servicios_disponibilidads', 'servicios.id', '=', 'servicios_disponibilidads.servicio_id')
        ->select("servicios.id AS id_servi","servicios.nombre_servicio","servicios_disponibilidads.*")
        ->get();
       
        return view('dash.citas',compact("citas"));
    }

    public function citas_pendientes(){
        $citas = DB::table("citas")->where('estado', 'En espera')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","citas.fecha_cita","servicios.nombre_servicio")
        ->get();


        $totalCitasEnEspera = DB::table("citas")->where('estado', 'En espera')->count();
        return view('dash.citas_pendientes',compact("citas","totalCitasEnEspera"));
        
    }

    public function cambio_estado($id,$valor){
       

        $estado_nuevo=$valor==1?"Aprobada":"Rechazada";
        
        DB::table('citas')
        ->where('id', $id)
        ->update(['estado' => $estado_nuevo]);
       
        if($estado_nuevo=="Aprobada"){
            $datos = ['success' => 'Cita Confirmada'];

            // Redireccionar a la página anterior con datos flash
            return back()->with($datos);
        }else{
            $datos = ['success' => 'Cita Rechazada'];
            // Redireccionar a la página anterior con datos flash
            return back()->with($datos);
        }
       
    }
}
