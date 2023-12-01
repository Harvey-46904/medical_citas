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

                <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="lunes" {{$consulta->lunes == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck1">Lunes</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="martes" {{$consulta->martes == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck1">Martes</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="miercoles" {{$consulta->miercoles == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck1">Miercoles</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="jueves" {{$consulta->jueves == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck1">Jueves</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="viernes"{{$consulta->viernes == 1 ? 'checked' : ''}} >
                                <label class="form-check-label" for="exampleCheck1">Viernes</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="sabado" {{$consulta->sabado == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck1">Sabado</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="domingo" {{$consulta->domingo == 1 ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck1">Domingo</label>
                            </div>
                        </div>
                    </div>
                    <input type="submit"  class="btn btn-primary" value="Editar">
            </form>
    </div>
</div>

</div>

@endsection