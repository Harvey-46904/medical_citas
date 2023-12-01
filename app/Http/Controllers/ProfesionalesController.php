<?php

namespace App\Http\Controllers;

use App\Models\profesionales;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\CitasController;
class ProfesionalesController extends Controller
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
        $consultas=DB::table("profesionales")->get();
        return view("dash.profesionales",compact("consultas","totalCitasEnEspera"));
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
        $crear_profesional=new profesionales;
        $crear_profesional->documento_profesional=$request->documento;
        $crear_profesional->nombre_profesinal=$request->nombre;
        $crear_profesional->save();
        
        return redirect('/profesionales')->with('success', 'Profesional guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profesionales  $profesionales
     * @return \Illuminate\Http\Response
     */
    public function show(profesionales $profesionales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profesionales  $profesionales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logicaCompartida = new CitasController();
        $totalCitasEnEspera =$logicaCompartida->notificacion_cita();
        $usuario = profesionales::find($id);
        return view("dash.actualizar_profecional",compact("totalCitasEnEspera","usuario"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profesionales  $profesionales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $usuario = profesionales::find($id);
        if ($usuario) {
            // Actualiza los campos según tus necesidades
            $usuario->documento_profesional=$request->documento;
            $usuario->nombre_profesinal=$request->nombre;
            // Guarda los cambios
            $usuario->save();
            return redirect('/profesionales')->with('success', 'Profesional actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profesionales  $profesionales
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('profesionales')
        ->where('id', $id)
        ->delete();
        return back()->with('success', 'Profesional Eliminado');
    }
}
