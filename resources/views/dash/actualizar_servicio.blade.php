@extends('dash.index')
@section('content')

    @php
       
        View::share('parametro', $totalCitasEnEspera);
    @endphp
<div class="container-fluid">

<!-- Page Heading -->



<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <div class="row justify-content-between">
        <div class="col-md-3 align-items-center">  <h6 class="m-0 font-weight-bold text-primary">Actualizar servicio </h6></div>
       
    </div>
      

    </div>
    <div class="card-body">
            <form method="POST"   action="{{ route('servicio.actualizar', ['id' => $consulta->id_servi]) }}">
                    @csrf
                   
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre Servicio</label>
                    <input type="text" class="form-control" name="nombre" value="{{$consulta->nombre_servicio}}">
                
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Número de citas diarias</label>
                    <input type="number" class="form-control" name="limite"  value="{{$consulta->limite_servico}}">
                
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">tiempo de cita en minutos</label>
                    <input type="number" class="form-control" name="rango" value="{{$consulta->rango_minutos}}">
                
                </div>
                @php
                        function formatearHoras($cadenaHoras) {
                        $jornada = explode('A', $cadenaHoras);
                        $manana=$jornada[0];
                        $tarde=$jornada[1];
                        $divicionmanana=explode('&', $manana);
                        $diviciontarde=explode('&', $tarde);
                        $horaIniciomanana="";
                        $horaFinmanana="";
                        $horaIniciotarde="";
                        $horaFintarde="";
                        if($divicionmanana[0] != "" AND $divicionmanana[1] != "" ){
                            $horaIniciomanana = date("g:i A", strtotime($divicionmanana[0]));
                            $horaFinmanana = date("g:i A", strtotime($divicionmanana[1]));
                        }
                        if($diviciontarde[0] != "" AND  $diviciontarde[1] != "" ){
                            $horaIniciotarde = date("g:i A", strtotime($diviciontarde[0]));
                            $horaFintarde = date("g:i A", strtotime($diviciontarde[1]));
                        }

                         return obtenerHorasComoArray($horaIniciomanana,$horaFinmanana,$horaIniciotarde,$horaFintarde);
                        }

                        function obtenerHorasComoArray($horaIniciomanana, $horaFinmanana, $horaIniciotarde, $horaFintarde) {
                            $resultados = array(
                                'J Diurna' => array(
                                    'inicio' => !empty($horaIniciomanana)?date('H:i', strtotime($horaIniciomanana)):'',
                                    'fin' =>!empty($horaFinmanana)?date('H:i', strtotime($horaFinmanana)):''
                                ),
                                'J Tarde' => array(
                                    'inicio' => !empty($horaIniciotarde)?date('H:i', strtotime($horaIniciotarde)):'',
                                    'fin' =>!empty($horaFintarde)?date('H:i', strtotime($horaFintarde)):''
                                )
                            );

                            return $resultados;
                        }
                        @endphp
                    <div class="row">
                        @php
                        $lunes_formatera=formatearHoras($consulta->rango_lunes);
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="" name="Lunes" {{$consulta->lunes == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="">
                              Lunes
                                </label>
                            </div>
                            <ul id="jornadalunes" >
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="" {{ $lunes_formatera['J Diurna']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Mañana
                                        </label>
                                    </div>
                                    <ul id="mananalunes">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde0" value="{{ $lunes_formatera['J Diurna']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta0" value="{{ $lunes_formatera['J Diurna']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id="" {{ $lunes_formatera['J Tarde']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tardelunes" >
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde0" value="{{ $lunes_formatera['J Tarde']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta0" value="{{ $lunes_formatera['J Tarde']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        @php
                        $martes_formatera=formatearHoras($consulta->rango_martes);
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="" name="Martes" {{$consulta->martes == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="">
                              Martes
                                </label>
                            </div>
                            <ul id="jornadalunes" >
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="" {{ $martes_formatera['J Diurna']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Mañana
                                        </label>
                                    </div>
                                    <ul id="mananalunes">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde1" value="{{ $martes_formatera['J Diurna']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta1" value="{{ $martes_formatera['J Diurna']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id="" {{ $martes_formatera['J Tarde']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tardelunes" >
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde1" value="{{ $martes_formatera['J Tarde']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta1" value="{{ $martes_formatera['J Tarde']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        @php
                        $miercoles_formatera=formatearHoras($consulta->rango_miercoles);
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="" name="Miercoles" {{$consulta->miercoles == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="">
                              Miercoles
                                </label>
                            </div>
                            <ul id="jornadalunes" >
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="" {{ $miercoles_formatera['J Diurna']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Mañana
                                        </label>
                                    </div>
                                    <ul id="mananalunes">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde2" value="{{ $miercoles_formatera['J Diurna']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta2" value="{{ $miercoles_formatera['J Diurna']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id="" {{ $miercoles_formatera['J Tarde']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tardelunes" >
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde2" value="{{ $miercoles_formatera['J Tarde']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta2" value="{{ $miercoles_formatera['J Tarde']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        @php
                        $jueves_formatera=formatearHoras($consulta->rango_jueves);
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="" name="Jueves" {{$consulta->jueves == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="">
                              Jueves
                                </label>
                            </div>
                            <ul id="jornadalunes" >
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="" {{ $jueves_formatera['J Diurna']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Mañana
                                        </label>
                                    </div>
                                    <ul id="mananalunes">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde3" value="{{ $jueves_formatera['J Diurna']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta3" value="{{ $jueves_formatera['J Diurna']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id="" {{ $jueves_formatera['J Tarde']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tardelunes" >
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde3" value="{{ $jueves_formatera['J Tarde']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta3" value="{{ $jueves_formatera['J Tarde']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        @php
                        $viernes_formatera=formatearHoras($consulta->rango_viernes);
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="" name="Viernes" {{$consulta->viernes == 1 ? 'checked' : ''}} >
                                <label class="form-check-label" for="">
                              Viernes
                                </label>
                            </div>
                            <ul id="jornadalunes" >
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="" {{ $viernes_formatera['J Diurna']["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Mañana
                                        </label>
                                    </div>
                                    <ul id="mananalunes">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde4" value="{{ $viernes_formatera['J Diurna']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta4" value="{{ $viernes_formatera['J Diurna']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id="" {{ $viernes_formatera["J Tarde"]["inicio"] !="" ? 'checked' : ''}}>
                                        <label class="form-check-label" for="">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tardelunes" >
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde4" value="{{ $viernes_formatera['J Tarde']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta4" value="{{ $viernes_formatera['J Tarde']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        @php
                        $sabado_formatera=formatearHoras($consulta->rango_sabado);
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="" name="Sabado" {{$consulta->sabado == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="">
                              Sabado
                                </label>
                            </div>
                            <ul id="jornadalunes" >
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="" {{ $sabado_formatera["J Diurna"]["inicio"] !="" ? 'checked' : ''}} >
                                        <label class="form-check-label" for="">
                                            Mañana
                                        </label>
                                    </div>
                                    <ul id="mananalunes">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde5" value="{{ $sabado_formatera['J Diurna']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta5" value="{{ $sabado_formatera['J Diurna']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id="" {{ $sabado_formatera["J Tarde"]["inicio"] !="" ? 'checked' : ''}} >
                                        <label class="form-check-label" for="">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tardelunes" >
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde5" value="{{ $sabado_formatera['J Tarde']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta5" value="{{ $sabado_formatera['J Tarde']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="row">
                        @php
                        $domingo_formatera=formatearHoras($consulta->rango_domingo);
                        @endphp
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="" name="Domingo" {{$consulta->domingo == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="">
                              Domingo
                             
                                </label>
                            </div>
                            <ul id="jornadalunes" >
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="">
                                        <label class="form-check-label" for="">
                                            Mañana 
                                        </label>
                                    </div>
                                    <ul id="mananalunes">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde6" value="{{ $domingo_formatera['J Diurna']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta6" value="{{ $domingo_formatera['J Diurna']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id=""   >
                                        <label class="form-check-label" for="">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tardelunes" >
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde6" value="{{ $domingo_formatera['J Tarde']['inicio']}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta6" value="{{ $domingo_formatera['J Tarde']['fin']}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>


                    <input type="submit"  class="btn btn-primary" value="Editar">
            </form>
    </div>
</div>

</div>

@endsection