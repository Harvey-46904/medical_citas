<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>cItas Medicas</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="dash/css/sb-admin-2.css" rel="stylesheet">
<style>
    .fc-disabled-day {
    background-color: #f2f2f2; /* Cambia el color según tu preferencia */
    color: #999;
    cursor: not-allowed;
}

</style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" id="regis">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="h4 text-gray-900 mb-4 display-4">Gestión <br>de citas</h2>
                                    </div>
                                    <form class="user" id="formularioRegistro">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="numero_documento" 
                                                placeholder="Número de documento" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Nombres Completos" autocomplete="off">
                                        </div>
                                       
                                        <a class="btn btn-primary btn-user btn-block registro_user">
                                            Registrar Usuario
                                        </a>
                                        <hr>
                                        
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row justify-content-center" id="cita" >

<div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block "> <div id="calendario"></div></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                        <h2 class="h4 text-gray-900 mb-4 display-4">Gestión <br>de citas</h2><br>

                            <h2 class="h4 text-gray-900 mb-4 nombres">Nombres</h2>
                        </div>
                        <form class="user">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user"
                                    id="cita_documento" 
                                    placeholder="Número de documento" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Seleccione el servicio de cita que desea</label>
                                <select class="form-control" id="services_select">
                                <option disabled selected > Seleccione un servicio</option>
                                @foreach($citas as $cita)
                                <option value="{{$cita->id_servi}}">{{$cita->nombre_servicio}}</option>
                                @endforeach
                                </select>
                            </div>
                            <a href="index.html" class="btn btn-primary btn-user btn-block">
                                Registrar Cita
                            </a>
                            <hr>
                            
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="dash/vendor/jquery/jquery.min.js"></script>
    <script src="dash/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="dash/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="dash/js/sb-admin-2.min.js"></script>

    <script>
        let nombre_global="";
        let numero_global="";
        $("#cita").hide();
        $(document).ready(function () {
        $('#numero_documento').on('input', function () {
            var query = $(this).val();
            if(query.length>=5){
                 // Realiza la solicitud AJAX
                $.ajax({
                    url: '{{ route('buscar.documento', ['documento' => 'valor']) }}'.replace('valor', query),
                    method: 'GET',
                
                    success: function (data) {
                        // Maneja los resultados y actualiza la interfaz de usuario
                       
                        if(data.data!=null){
                            numero_global=query;
                        nombre_global=data.data.nombre_completo;
                        console.log(nombre_global);
                        alert("Bienvenido Nuevamente")
                        $(".nombres").text(nombre_global);
                        $("#cita_documento").val(numero_global).prop("readonly", true);;
                        $("#regis").hide();
                        $("#cita").show();
                    }
                        // Puedes mostrar los resultados en la interfaz de usuario, actualizar una lista, etc.
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });

        $(".registro_user").on('click',function(){
            var tokenCSRF = document.getElementById('formularioRegistro').querySelector('[name="_token"]').value;
            // Obtén los valores de los campos del formulario
            var numeroDocumento = document.getElementById('numero_documento').value;
            var nombresCompletos = document.getElementById('exampleInputPassword').value;

            // Crea un objeto con los datos a enviar
            var datos = {
                _token: tokenCSRF,
                numero_documento: numeroDocumento,
                nombres_completos: nombresCompletos
                // Agrega más campos según sea necesario
            };
          

            $.ajax({
                url: '{{ route('usuario.store') }}',
                method: 'POST',
                data: datos,
                success: function (data) {
                    // Maneja los resultados y actualiza la interfaz de usuario
                    console.log(data.data);
                    if(data.data!=""){
                        nombre_global=data.data;
                        $(".nombres").text(nombre_global);
                        $("#cita_documento").val(numeroDocumento).prop("readonly", true);;
                        $("#regis").hide();
                        $("#cita").show();
                    }
                    // Puedes mostrar los resultados en la interfaz de usuario, actualizar una lista, etc.
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>
<!-- FullCalendar -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>


<script>
     let datosDesdePHP = @json($citas);


 
    $(document).ready(function() {

        function filtrarPorId(idSeleccionado) {
            return datosDesdePHP.filter(function(servicio) {
                return servicio.id_servi == idSeleccionado;
            });
        }

        let calendar;

        function initCalendario(dia) {
            calendar = $('#calendario').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                dayClick: function(date, jsEvent, view) {
                    console.log('Día clickeado:', date.format());
                },
                dayRender: function(date, cell) {
                    var diaSemana = date.day();
                    if (diaSemana === dia || diaSemana === 5) {
                        $(cell).addClass('fc-disabled-day');
                    }
                }
            });
        }
        initCalendario(4);
        $("#services_select").on("change", function(){
                // Obtiene el valor seleccionado
                var valorSeleccionado = $(this).val();
                var serviciosFiltrados = filtrarPorId(valorSeleccionado);
                calendar.fullCalendar('rerenderEvents');
             
                initCalendario(2);
                calendar.fullCalendar('rerenderEvents');
            });
    });
</script>
</body>

</html>