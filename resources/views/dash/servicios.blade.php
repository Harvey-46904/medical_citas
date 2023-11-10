@extends('dash.index')
@section('content')
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
        <div class="col-md-3 align-items-center">  <h6 class="m-0 font-weight-bold text-primary">Lista de servicios </h6></div>
        <div class="col-md-3">  <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#exampleModal"> 
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
                       
                    </tr>
                </thead>
             
                <tbody>
                   

                    @foreach($consultas as $consulta)
                    <tr>
                        <td>{{$consulta->nombre_servicio}}</td>
                        <td class="text-center"> {{$consulta->limite_servico}}</td>
                        <td class="text-center">{{$consulta->rango_minutos}} min</td>
                        <td class="text-center"> 
                            @if($consulta->lunes==1)
                                <a href="#" class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-check"></i>
                                </a>
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
                            @else
                                <a href="#" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
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
      <form method="POST"   action="{{ url('servicios') }}">
            @csrf
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
                <div class="col-md-6">
                     <div class="form-check">
                <input type="checkbox" class="form-check-input" name="lunes" >
                <label class="form-check-label" for="exampleCheck1">Lunes</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="martes">
                <label class="form-check-label" for="exampleCheck1">Martes</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="miercoles">
                <label class="form-check-label" for="exampleCheck1">Miercoles</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="jueves">
                <label class="form-check-label" for="exampleCheck1">Jueves</label>
            </div></div>
                <div class="col-md-6">
                <div class="form-check">
                <input type="checkbox" class="form-check-input" name="viernes">
                <label class="form-check-label" for="exampleCheck1">Viernes</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="sabado">
                <label class="form-check-label" for="exampleCheck1">Sabado</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="domingo">
                <label class="form-check-label" for="exampleCheck1">Domingo</label>
            </div>
                </div>
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
