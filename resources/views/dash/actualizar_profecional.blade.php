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
            <form method="POST"   action="{{ route('profesional.actualizar', ['id' => $usuario->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">No documento</label>
                        <input type="text" class="form-control" name="documento" placeholder="" value="{{$usuario->documento_profesional}}">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="" value="{{$usuario->nombre_profesinal}}">

                    </div>
                    
                    <input type="submit"  class="btn btn-primary" value="Editar">
            </form>
    </div>
</div>

</div>

@endsection