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
                            $horas = explode('&', $cadenaHoras);
                            $horaInicio = date("g:i A", strtotime($horas[0]));
                            $horaFin = date("g:i A", strtotime($horas[1]));

                            return $horaInicio . ' - ' . $horaFin;
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
                                </a><hr>
                               {{formatearHoras($consulta->rango_lunes)}} 
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
                                </a><hr>
                                {{formatearHoras($consulta->rango_martes)}} 
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
                                </a><hr>
                                {{formatearHoras($consulta->rango_miercoles)}} 
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
                                </a><hr>
                                {{formatearHoras($consulta->rango_jueves)}} 
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
                                </a><hr>
                                {{formatearHoras($consulta->rango_viernes)}} 
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
                                </a><hr>
                                {{formatearHoras($consulta->rango_sabado)}} 
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
                                </a><hr>
                                {{formatearHoras($consulta->rango_domingo)}} 
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
                                <option disabled selected > Seleccione el profesional</option>
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
                    <div class="row">
    <div class="col-md-12">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="lunes" id="lunesCheckbox">
            <label class="form-check-label" for="lunesCheckbox">Lunes</label>
            <div class="d-flex align-items-center">
                <label for="horaDesdeLunes">Desde:</label>
                <input type="time" class="form-control" id="horaDesdeLunes" name="horaDesdeLunes" style="display: none;">

                <label for="horaHastaLunes" class="ml-2">Hasta:</label>
                <input type="time" class="form-control" id="horaHastaLunes" name="horaHastaLunes" style="display: none;">
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="martes" id="martesCheckbox">
            <label class="form-check-label" for="martesCheckbox">Martes</label>
            <div class="d-flex align-items-center">
                <label for="horaDesdeMartes">Desde:</label>
                <input type="time" class="form-control" id="horaDesdeMartes" name="horaDesdeMartes" style="display: none;">

                <label for="horaHastaMartes" class="ml-2">Hasta:</label>
                <input type="time" class="form-control" id="horaHastaMartes" name="horaHastaMartes" style="display: none;">
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="miercoles" id="miercolesCheckbox">
            <label class="form-check-label" for="miercolesCheckbox">Miércoles</label>
            <div class="d-flex align-items-center">
                <label for="horaDesdeMiercoles">Desde:</label>
                <input type="time" class="form-control" id="horaDesdeMiercoles" name="horaDesdeMiercoles" style="display: none;">

                <label for="horaHastaMiercoles" class="ml-2">Hasta:</label>
                <input type="time" class="form-control" id="horaHastaMiercoles" name="horaHastaMiercoles" style="display: none;">
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="jueves" id="juevesCheckbox">
            <label class="form-check-label" for="juevesCheckbox">Jueves</label>
            <div class="d-flex align-items-center">
                <label for="horaDesdeJueves">Desde:</label>
                <input type="time" class="form-control" id="horaDesdeJueves" name="horaDesdeJueves" style="display: none;">

                <label for="horaHastaJueves" class="ml-2">Hasta:</label>
                <input type="time" class="form-control" id="horaHastaJueves" name="horaHastaJueves" style="display: none;">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="viernes" id="viernesCheckbox" >
            <label class="form-check-label" for="viernesCheckbox">Viernes</label>
            <div class="d-flex align-items-center">
                <label for="horaDesdeViernes">Desde:</label>
                <input type="time" class="form-control" id="horaDesdeViernes" name="horaDesdeViernes" style="display: none;">

                <label for="horaHastaViernes" class="ml-2">Hasta:</label>
                <input type="time" class="form-control" id="horaHastaViernes" name="horaHastaViernes" style="display: none;">
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="sabado" id="sabadoCheckbox">
            <label class="form-check-label" for="sabadoCheckbox">Sábado</label>
            <div class="d-flex align-items-center">
                <label for="horaDesdeSabado">Desde:</label>
                <input type="time" class="form-control" id="horaDesdeSabado" name="horaDesdeSabado" style="display: none;">

                <label for="horaHastaSabado" class="ml-2">Hasta:</label>
                <input type="time" class="form-control" id="horaHastaSabado" name="horaHastaSabado" style="display: none;">
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="domingo" id="domingoCheckbox">
            <label class="form-check-label" for="domingoCheckbox">Domingo</label>
            <div class="d-flex align-items-center">
                <label for="horaDesdeDomingo">Desde:</label>
                <input type="time" class="form-control" id="horaDesdeDomingo" name="horaDesdeDomingo" style="display: none;">

                <label for="horaHastaDomingo" class="ml-2">Hasta:</label>
                <input type="time" class="form-control" id="horaHastaDomingo" name="horaHastaDomingo" style="display: none;">
            </div>
        </div>
    </div>
</div>



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
    $(document).ready(function() {
        $('#lunesCheckbox').change(function() {
            $('#horaDesdeLunes, #horaHastaLunes').toggle(this.checked);
        });

        $('#martesCheckbox').change(function() {
            $('#horaDesdeMartes, #horaHastaMartes').toggle(this.checked);
        });

        $('#miercolesCheckbox').change(function() {
            $('#horaDesdeMiercoles, #horaHastaMiercoles').toggle(this.checked);
        });

        $('#juevesCheckbox').change(function() {
            $('#horaDesdeJueves, #horaHastaJueves').toggle(this.checked);
        });

        $('#viernesCheckbox').change(function() {
            $('#horaDesdeViernes, #horaHastaViernes').toggle(this.checked);
        });

        $('#sabadoCheckbox').change(function() {
            $('#horaDesdeSabado, #horaHastaSabado').toggle(this.checked);
        });

        $('#domingoCheckbox').change(function() {
            $('#horaDesdeDomingo, #horaHastaDomingo').toggle(this.checked);
        });

        // Repite el patrón para los demás días
    });
</script>
@endsection