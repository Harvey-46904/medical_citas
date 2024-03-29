<?php

namespace App\Http\Controllers;

use App\Models\citas;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
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
        ->join('servicios_disponibilidads',"servicios_disponibilidads.servicio_id","=","servicios.id")
        ->join("profesionales","servicios_disponibilidads.profesional_id","=","profesionales.id")

        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","usuarios.telefono","usuarios.fecha_nacimiento","citas.fecha_cita","servicios.nombre_servicio","profesionales.nombre_profesinal")
        ->get();

        $servicios=DB::table("servicios")->select()->get();
        $doctores=DB::table("profesionales")->select()->get();


        $totalCitasEnEspera=self::notificacion_cita();
        return view('dash.lista_aprobadas',compact("citas","totalCitasEnEspera","servicios","doctores"));
        
    }
    public function citas_rechazadas(){
        $citas = DB::table("citas")->where('estado', 'Rechazada')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->join('servicios_disponibilidads',"servicios_disponibilidads.servicio_id","=","servicios.id")
        ->join("profesionales","servicios_disponibilidads.profesional_id","=","profesionales.id")

        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","usuarios.telefono","usuarios.fecha_nacimiento","citas.fecha_cita","servicios.nombre_servicio","profesionales.nombre_profesinal")
        ->get();

        $servicios=DB::table("servicios")->select()->get();
        $doctores=DB::table("profesionales")->select()->get();
        $totalCitasEnEspera=self::notificacion_cita();
      
        return view('dash.lista_rechazadas',compact("citas","totalCitasEnEspera","servicios","doctores"));
    }
    public function citas_canceladas(){
        $citas = DB::table("citas")->where('estado', 'Cita Cancelada')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->join('servicios_disponibilidads',"servicios_disponibilidads.servicio_id","=","servicios.id")
        ->join("profesionales","servicios_disponibilidads.profesional_id","=","profesionales.id")

        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","usuarios.telefono","usuarios.fecha_nacimiento","citas.fecha_cita","servicios.nombre_servicio","profesionales.nombre_profesinal")
        ->get();

        $servicios=DB::table("servicios")->select()->get();
        $doctores=DB::table("profesionales")->select()->get();
        $totalCitasEnEspera=self::notificacion_cita();
        return view('dash.lista_canceladas',compact("citas","totalCitasEnEspera","servicios","doctores"));
       
    }
    public function citas_espera(){
       
        $citas = DB::table("citas")->where('estado', 'En Espera')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->join('servicios_disponibilidads',"servicios_disponibilidads.servicio_id","=","servicios.id")
        ->join("profesionales","servicios_disponibilidads.profesional_id","=","profesionales.id")

        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","usuarios.telefono","usuarios.fecha_nacimiento","citas.fecha_cita","servicios.nombre_servicio","profesionales.nombre_profesinal")
        ->get();
        /*
        ->join('servicios_disponibilidads',"servicios_disponibilidads.servicio_id","=","servicios.id")
        ->join("profesionales","servicios_disponibilidads.profesional_id","=","profesionales.id")

        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","usuarios.telefono","usuarios.fecha_nacimiento","citas.fecha_cita","servicios.nombre_servicio")
        ->get();*/
        $servicios=DB::table("servicios")->select()->get();
        $doctores=DB::table("profesionales")->select()->get();
        $totalCitasEnEspera=self::notificacion_cita();
        return view('dash.lista_espera',compact("citas","totalCitasEnEspera","servicios","doctores"));
   
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
       

        $fechaCita = $request->fecha_cita;

        // Utiliza STR_TO_DATE para convertir la cadena de fecha al formato de MySQL
        $fechaCitaFormateada = DB::raw("STR_TO_DATE('$fechaCita', '%Y-%m-%d %h:%i %p')");


        $crear_cita=new citas;
        $crear_cita->usuario_id=$request->usuario_id;
        $crear_cita->servicio_id=$citas_id_unico->servicio_id;
        $crear_cita->fecha_cita= $fechaCitaFormateada;
        $crear_cita->visibilidad= TRUE;
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
    public function destroy($id)
    {
       

        $cita = citas::find($id);
        if ($cita) {
            // Actualiza los campos según tus necesidades
            $cita->estado="Cancelada";
            $cita->save();
            return response(["data"=>"cita eliminada"]);
        }
    }

    public function crear_cita(){
        $citas=DB::table("servicios")
        ->join('servicios_disponibilidads', 'servicios.id', '=', 'servicios_disponibilidads.servicio_id')
        ->join('profesionales', 'profesionales.id', '=', 'servicios_disponibilidads.profesional_id')
        ->select("servicios.id AS id_servi","servicios.nombre_servicio","servicios_disponibilidads.*","profesionales.nombre_profesinal")
        ->where("servicios_disponibilidads.visibilidad","=",TRUE)
        ->get();
       
        return view('dash.citas',compact("citas"));
    }

    public function crear_cita_dash(){
        $citas=DB::table("servicios")
        ->join('servicios_disponibilidads', 'servicios.id', '=', 'servicios_disponibilidads.servicio_id')
        ->join('profesionales', 'profesionales.id', '=', 'servicios_disponibilidads.profesional_id')
        ->select("servicios.id AS id_servi","servicios.nombre_servicio","servicios_disponibilidads.*","profesionales.nombre_profesinal")
        ->where("servicios_disponibilidads.visibilidad","=",TRUE)
        ->get();
        $parametro=self::notificacion_cita();
        return view('dash.index_vital',compact("citas","parametro"));



    }

    public function citas_pendientes($id){
        $citas = DB::table("citas")->where('estado', 'En espera')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","citas.fecha_cita","servicios.nombre_servicio")
        ->where("citas.id","=",$id)
        ->get();
        $totalCitasEnEspera=self::notificacion_cita();
        return view('dash.citas_pendientes',compact("citas","totalCitasEnEspera"));    
    }
    public function citas_pendientes_cancelar($id){
        $citas = DB::table("citas")->where('estado', 'Cancelada')
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","citas.fecha_cita","servicios.nombre_servicio")
        ->where("citas.id","=",$id)
        ->get();
        $totalCitasEnEspera=self::notificacion_cita();
        return view('dash.citas_acancelar',compact("citas","totalCitasEnEspera"));
    }
    

    public function cambio_estado($id,$valor){
        $estado_nuevo="";
        switch ($valor) {
            case 1:
                $estado_nuevo="Aprobada";
                DB::table('citas')
                ->where('id', $id)
                ->update(['estado' => $estado_nuevo]);
                return redirect('/citas')->with('success', 'cita aprobada correctamente');
                break;
            case 0:
                $estado_nuevo= "Rechazada"  ;
                DB::table('citas')
                ->where('id', $id)
                ->update(['estado' => $estado_nuevo]);
                return redirect('/citas-rechazadas')->with('success', 'cita rechazada correctamente');
            break;
            
            case 3:
                $estado_nuevo=  "Cita Cancelada"    ;
                DB::table('citas')
                ->where('id', $id)
                ->update(['estado' => $estado_nuevo]);
                return redirect('/citas')->with('success', 'cita confirmada en cancelacion  correctamente');
            break;
                    
            default:
                # code...
                break;
        }
       
       /*
        if($estado_nuevo=="Aprobada"){
            $datos = ['success' => 'Cita Confirmada'];
            return redirect('/citas')->with('success', 'cita aprobada correctamente');
            // Redireccionar a la página anterior con datos flash
            return back()->with($datos);
        }else{
            $datos = ['success' => 'Cita Rechazada'];
            return redirect('/citas-rechazadas')->with('success', 'cita rechazada correctamente');
            // Redireccionar a la página anterior con datos flash
            return back()->with($datos);
        }
       */
    }


    public function notificacion_cita(){
        $citas = DB::table("citas")
        ->where('estado', 'En espera')
        ->orWhere('estado','Cancelada' )
        ->join('usuarios', 'citas.usuario_id', '=', 'usuarios.id')
        ->join('servicios','citas.servicio_id','=',"servicios.id")
        ->select("citas.id","usuarios.nombre_completo","usuarios.cedula","citas.fecha_cita","servicios.nombre_servicio","estado")
        ->get();

        $user=DB::table("users")->select("name")->where("id","=",1)->first();


        $totalCitasEnEspera = count($citas);
        $citas->total_citas_espera= $totalCitasEnEspera;
        $citas->username=$user->name;
        return $citas;
    }
    public function horas_disponibles($id_servicio,$fecha_consulta){
        //return response(["data"=>$id_servicio,"fecha"=>$fecha_consulta]);   
        $fechaParametro = $fecha_consulta;

        // Consulta para obtener los registros de la fecha proporcionada
        $registros = DB::table('citas')
            ->where("servicio_id","=",$id_servicio)
           
            ->whereDate('fecha_cita', $fechaParametro)
            ->where("estado","=","Aprobada")
            ->orWhere("estado","=","En Espera")
            ->get();
           
        // Obtener solo la hora de los registros
        $horas = $registros->map(function ($registro) {
            return Carbon::parse($registro->fecha_cita)->format('h:i A');
        });
        return response(["data"=>$horas]);   
    }
}
