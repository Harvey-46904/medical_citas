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
        <div class="col-md-3 align-items-center">  <h6 class="m-0 font-weight-bold text-primary">Lista de citas rechazadas </h6></div>
       
    </div>
      

    </div>
    <div class="card-body">
    <div class="row">
            <div class="col-md-4">
                <label for="exampleFormControlSelect1">Fecha</label>
                <input type="date" id="dateFilter" class="form-control" placeholder="Fecha">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Servicios</label>
                    <select class="form-control" id="serviceFilter">
                        <option value="">Todos los servicios</option>
                        @foreach($servicios as $servi)
                        <option value="{{$servi->nombre_servicio}}">{{$servi->nombre_servicio}}</option>
                        @endforeach
                    </select>
                </div>
               
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Example select</label>
                    <select class="form-control" id="doctorFilter">
                        <option value="">Todos los profesionales</option>
                        @foreach($doctores as $profe)
                        <option value="{{$profe->nombre_profesinal}}">{{$profe->nombre_profesinal}}</option>
                        @endforeach
                    </select>
                </div>
               
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        
                        <th class="text-center">No Documento</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">Edad</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Servicio</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Doctor</th>
                        <th class="text-center">Aprobar</th>
                       
                       
                    </tr>
                </thead>
             
                <tbody>
                   
                @php
                function calcularedad($fechas){
                  // Convertir la fecha proporcionada a objetos DateTime
    $fechaActual = new DateTime(date('Y-m-d'));
    $fechaDada = new DateTime($fechas);

    // Calcular la diferencia entre las fechas
    $diferencia = $fechaActual->diff($fechaDada);

    // Obtener los años y los meses transcurridos
    $aniosTranscurridos = $diferencia->y;
    $mesesTranscurridos = $diferencia->m;
    $diasTranscurridos = $diferencia->d;

    // Verificar si ya se ha cumplido el aniversario en este año
    if ($mesesTranscurridos < 0 || ($mesesTranscurridos == 0 && $diasTranscurridos < 0)) {
        $aniosTranscurridos--;
    }

    return $aniosTranscurridos;
                }
                @endphp
                    @foreach($citas as $cita)
                    <tr>
                            <td>{{$cita->cedula}}</td>
                            <td>{{$cita->nombre_completo}}</td>
                            <td> 
                            {{  calcularedad($cita->fecha_nacimiento)}}
                            </td>
                            <td> {{$cita->telefono}}</td>
                            <td>{{$cita->nombre_servicio}}</td>
                            <td> {{$cita->fecha_cita}}</td>
                            <td> {{$cita->nombre_profesinal}}</td>
                            <td class="text-center"> 
                            @if ($cita->fecha_cita > now())
                            <a href="{{ route('cita.update', ['id' => $cita->id,'valor'=>1]) }}" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    @endif

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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST"   action="{{ route('post_user') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">No Documento</label>
                <input type="text" class="form-control" name="numero_documento" placeholder="">
               
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nombres Completos</label>
                <input type="text" class="form-control" name="nombres_completos" placeholder="">
               
            </div>
   

       
           
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input type="submit"  class="btn btn-primary" value="Guardar">
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
