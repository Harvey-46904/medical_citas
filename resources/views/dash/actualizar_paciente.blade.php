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
        <div class="col-md-3 align-items-center">  <h6 class="m-0 font-weight-bold text-primary">Actualizar Paciente </h6></div>
       
    </div>
      

    </div>
    <div class="card-body">
            <form method="POST"   action="{{ route('usuario.actualizar', ['id' => $usuario->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Documento</label>
                        <input type="text" class="form-control" name="numero_documento" placeholder="" value="{{$usuario->cedula}}" readonly>
                    
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombres Completos</label>
                        <input type="text" class="form-control" name="nombres_completos"  value="{{$usuario->nombre_completo}}">
                    
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telefono</label>
                        <input type="text" class="form-control" name="telefono"  value="{{$usuario->telefono}}">
                    
                    </div>

                    <div class="form-group">
                            <input type="date" class="form-control form-control-user" id="fecha_nacimiento"
                             placeholder="fecha_nacimiento" autocomplete="off" name="fecha_nacimiento" value="{{$usuario->fecha_nacimiento}}">
                    </div>
                    <input type="submit"  class="btn btn-primary" value="Editar">
            </form>
    </div>
</div>

</div>

@endsection