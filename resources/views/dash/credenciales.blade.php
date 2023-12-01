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
        <div class="col-md-3 align-items-center">  <h6 class="m-0 font-weight-bold text-primary">Actualizar servicio </h6></div>
       
    </div>
      

    </div>
    <div class="card-body">
            <form method="POST"   action="{{ route('users.actualizar', ['id' => $user->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="name" placeholder="" value="{{$user->name}}" >
                    
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email"  value="{{$user->email}}">
                    
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" class="form-control" name="password"  placeholder="Contraseña nueva solo si desea cambiar la contraseña actual">
                    
                    </div>
                
                    <input type="submit"  class="btn btn-primary" value="Editar">
            </form>
    </div>
</div>

</div>

@endsection