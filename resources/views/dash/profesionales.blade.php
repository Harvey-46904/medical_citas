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
            @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <div class="row justify-content-between">
                <div class="col-md-3 align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de profesionales </h6>
                </div>
                <div class="col-md-3"> <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal"
                        data-target="#exampleModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Crear profesional</span>
                    </a></div>
            </div>


        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th class="text-center">Documento</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Actualizar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach($consultas as $consulta)
                        <tr>
                           
                            <td class="text-center"> {{$consulta->documento_profesional}}</td>
                            <td class="text-center">{{$consulta->nombre_profesinal}}</td>
                            <td class="text-center">
                                <a href="{{ route('profesional.editar', ['id' => $consulta->id]) }}"
                                    class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('profesional.eliminar', ['id' => $consulta->id]) }}"
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

                <h5 class="modal-title" id="exampleModalLabel">Nuevo profesional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profesional.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">No documento</label>
                        <input type="number" class="form-control" name="documento" placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="">

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

@endsection