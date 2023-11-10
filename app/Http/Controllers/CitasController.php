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
        //
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
        //
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
}
