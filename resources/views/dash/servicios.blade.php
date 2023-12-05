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

            @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="row justify-content-between">
                <div class="col-md-3 align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de servicios </h6>
                </div>
                <div class="col-md-3"> <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal"
                        data-target="#exampleModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Crear servicio</span>
                    </a></div>
            </div>


        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">Profesional</th>
                            <th class="text-center">Nombre Servicio</th>
                            <th class="text-center">Citas Diarias</th>
                            <th class="text-center">Tiempo de cita</th>
                            <th class="text-center">Lunes</th>
                            <th class="text-center">Martes</th>
                            <th class="text-center">Miercoles</th>
                            <th class="text-center">Jueves</th>
                            <th class="text-center">Viernes</th>
                            <th class="text-center">Sabado</th>
                            <th class="text-center">Domingo</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>

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

                         return "J Diurna: ". $horaIniciomanana . ' - ' . $horaFinmanana.'<hr>J Tarde: '.$horaIniciotarde . ' - ' . $horaFintarde ;
                        }
                        @endphp
                        @foreach($consultas as $consulta)
                        <tr>
                            <td>{{$consulta->nombre_profesinal}}</td>
                            <td>{{$consulta->nombre_servicio}}</td>
                            <td class="text-center"> {{$consulta->limite_servico}}</td>
                            <td class="text-center">{{$consulta->rango_minutos}} min</td>
                            <td class="text-center">
                                @if($consulta->lunes==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <hr>
                                {!!formatearHoras($consulta->rango_lunes)!!}
                                @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($consulta->martes==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <hr>
                                {!!formatearHoras($consulta->rango_martes)!!}
                                @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($consulta->miercoles==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <hr>
                                {!!formatearHoras($consulta->rango_miercoles)!!}
                                @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($consulta->jueves==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <hr>
                                {!!formatearHoras($consulta->rango_jueves)!!}
                                @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($consulta->viernes==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <hr>
                                {!!formatearHoras($consulta->rango_viernes)!!}
                                @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($consulta->sabado==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <hr>
                                {!!formatearHoras($consulta->rango_sabado)!!}
                                @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($consulta->domingo==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
                                <hr>
                                {!!formatearHoras($consulta->rango_domingo)!!}
                                @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('servicio.editar', ['id' => $consulta->id]) }}"
                                    class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('servicio.eliminar', ['id' => $consulta->id]) }}"
                                    class="btn btn-danger btn-circle btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                        </tr>
                        @endforeach




                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Nuevo Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('servicios') }}">
                    @csrf

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Seleccione el profesional encargado</label>
                        <select class="form-control" id="services_select" name="profesional">
                            <option disabled selected> Seleccione el profesional</option>
                            @foreach($profesionales as $profesional)
                            <option value="{{$profesional->id}}">{{$profesional->nombre_profesinal}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre Servicio</label>
                        <input type="text" class="form-control" name="nombre" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Número de citas diarias</label>
                        <input type="number" class="form-control" name="limite" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">tiempo de cita en minutos</label>
                        <input type="number" class="form-control" name="rango" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Marque los dias de actividad del servicio</label>
                    </div>

                    @php
                        $diasSemana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
                        $totalDias = count($diasSemana);
                    @endphp


                    @for ($i = 0; $i < $totalDias; $i++)
                   


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input dias" type="checkbox" id="d{{$i}}" name=" {{  $diasSemana[$i]}}">
                                <label class="form-check-label" for="defaultCheck{{$i}}">
                               {{  $diasSemana[$i]}}
                                </label>
                            </div>
                            <ul id="jornada{{$i}}" style="display: none;">
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn" type="checkbox" id="m{{$i}}">
                                        <label class="form-check-label" for="defaultCheck{{$i}}">
                                            Mañana
                                        </label>
                                    </div>
                                    <ul id="manana{{$i}}" style="display: none;">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="mananafinaldesde{{$i}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="mananafinalhasta{{$i}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input dn " type="checkbox" id="t{{$i}}">
                                        <label class="form-check-label" for="defaultCheck{{$i}}">
                                            Tarde
                                        </label>
                                    </div>
                                    <ul id="tarde{{$i}}" style="display: none;">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <label for="horaDesdeLunes">Desde:</label>
                                                <input type="time" class="form-control" name="tardefinaldesde{{$i}}">

                                                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                                                <input type="time" class="form-control" name="tardefinalhasta{{$i}}">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                    @endfor
                    



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Guardar">
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Mostrar u ocultar campos "Desde" y "Hasta" según el estado del checkbox
    $(document).ready(function () {
        $('.dias').change(function () {
            var id = this.id;
            var ultimoDigito = id.charAt(id.length - 1);
            if (this.checked) {
                console.log("number", ultimoDigito);
                activar_jornadas(ultimoDigito, 1);
            } else {
                activar_jornadas(ultimoDigito, 0);

            }
        });

        $('.dn').change(function () {
            var id = this.id;
            if (this.checked) {
                diurna_nocturna(id, 1)
            } else {
                diurna_nocturna(id, 0)
            }
        });

        // Repite el patrón para los demás días
    });
    function activar_jornadas(dia, bolean) {
        if (bolean == 1) {
            var clase = "#jornada" + dia
            $(clase).css("display", "block");
        } else {
            var clase = "#jornada" + dia
            $(clase).css("display", "none");
        }
    }

    function diurna_nocturna(dia, bolean) {
        var primerDigito = dia.charAt(0);
        var ultimoDigito = dia.charAt(dia.length - 1);
        console.log(primerDigito);
        if (bolean == 1) {
            if (primerDigito == "m") {
                var clase = "#manana" + ultimoDigito
                console.log(clase);
                $(clase).css("display", "block");
            } else {
                var clase = "#tarde" + ultimoDigito
                console.log(clase);
                $(clase).css("display", "block");
            }

        } else {
            if (primerDigito == "m") {
                var clase = "#manana" + ultimoDigito
                console.log(clase);
                $(clase).css("display", "none");
            } else {
                var clase = "#tarde" + ultimoDigito
                console.log(clase);
                $(clase).css("display", "none");
            }
        }
    }
</script>
@endsection