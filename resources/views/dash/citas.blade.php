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
    .blocked-day {
       
    background-color: #f2f2f2;
    color: "red"; /* Puedes ajustar el color de texto según tu preferencia */
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
                <div class="col-lg-6  d-lg-block "> 
               
                    <div id="calendario">

                    </div></div>
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


    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agendamiento de cita</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h5 class="font-weight-bold">No Documento</h5>
      <h5 class="cita_documento2">No Documento</h5>
      <hr>
      <h5 class="font-weight-bold">Nombres</h5>
       <h5 class="nombres">Nombres</h5>
       <hr>
       <h5 class="font-weight-bold">Servicio</h5>
       <h5 class="nombre_serviciofil">Servicio</h5>
       <hr>
       <h5 class="font-weight-bold">Fecha</h5>
       <h5 class="fechas_servi">Hora</h5>
       <hr>
      

       <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccione la hora</label>
            <select id="horas" class="form-control"></select>
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
        <button type="button" class="btn btn-primary guardar_citas">Guardar cita</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        let nombre_global="";
        let numero_global="";
        let nombre_servicio="";
        let user_id;
        let service_id;
        let fecha_seleccionada;
        let horas_seleccionada;
        
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
                        user_id=data.data.id;
                        
                        
                        $(".nombres").text(nombre_global);
                        $("#cita_documento").val(numero_global).prop("readonly", true);
                        $(".cita_documento2").text(numero_global);
                        
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

        $(".guardar_citas").on('click',function(){
            var tokenCSRF = document.getElementById('formularioRegistro').querySelector('[name="_token"]').value;
            console.log($("#horas").val());
            var datos = {
                _token: tokenCSRF,
                usuario_id: user_id,
                servicio_id: service_id,
                fecha_cita:fecha_seleccionada + ' ' +$("#horas").val()
                // Agrega más campos según sea necesario
            };
            $.ajax({
                url: '{{ route('citas.store') }}',
                method: 'POST',
                data: datos,
                success: function (data) {
                    // Maneja los resultados y actualiza la interfaz de usuario
                    console.log(data.data);
                    if(data.data!=""){
                        swal("Cita Agendada Correctamente", 
                        nombre_global+"-"+numero_global+"-"+nombre_servicio,
                         "success");
                        console.log("consultado");
                    }
                    // Puedes mostrar los resultados en la interfaz de usuario, actualizar una lista, etc.
                },
                error: function (error) {
                    console.log(error);
                }
            });
           

        })

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
                        nombre_global=data.data.nombre_completo;
                        user_id=data.data.id;
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

       
    });
</script>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    var blockedDays = [0, 1, 2,3,4,5,6];
    $('#calendario').fullCalendar({
      header: {
      },
      events: [],
      businessHours: {
        dow: [], // Lunes a Viernes por defecto
        start: '00:00',
        end: '24:00',
      },
      eventRender: function (event, element) {
        // Puedes personalizar la apariencia de los eventos aquí si es necesario
      },
      dayClick: function(date, jsEvent, view) {
        var dayOfWeek = date.day();

        // Verificar si el día está bloqueado
        if (blockedDays.includes(dayOfWeek)) {
          // El día está bloqueado, no realizar ninguna acción
         
          console.log("Este día está bloqueado");
        } else {
            $('#exampleModal').modal('show')
          // El día no está bloqueado, realizar la acción deseada
         
          
          $(".fechas_servi").text(date.format());
          fecha_seleccionada=date.format();
        }
      },
      dayRender: function (date, cell) {
        var dayOfWeek = date.day();

        // Verificar si el día está bloqueado y aplicar el estilo correspondiente
        if (blockedDays.includes(dayOfWeek)) {
          cell.addClass('blocked-day');
        }
      }
    });

    // Manejar cambios en el multiselect
        function filtrarPorId(idSeleccionado) {
            return datosDesdePHP.filter(function(servicio) {
                return servicio.id_servi == idSeleccionado;
            });
        }

        let calendar;
       

        function generarHoras(rango) {
            var selectHoras = document.getElementById("horas");
            selectHoras.innerHTML = ""; // Limpiar el select antes de llenarlo nuevamente

            var horaInicio = 8 * 60; // Convertir 8:00 AM a minutos
            var horaFin = 18 * 60;   // Convertir 6:00 PM a minutos

            for (var i = horaInicio; i < horaFin; i += rango) {
            var hora = Math.floor(i / 60); // Obtener las horas
            var minutos = i % 60;         // Obtener los minutos

            // Formatear la hora en formato HH:mm
            var horaFormateada = (hora < 10 ? "0" : "") + hora + ":" + (minutos === 0 ? "00" : minutos);

            // Crear una opción y agregarla al select
            var opcion = document.createElement("option");
            opcion.value = horaFormateada;
            opcion.text = horaFormateada;
            selectHoras.add(opcion);
            }
        }
    

        $("#services_select").on("change", function(){
                // Obtiene el valor seleccionado
                var valorSeleccionado = $(this).val();
                var serviciosFiltrados = filtrarPorId(valorSeleccionado);
               
                var diasSemana = ["domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado"];
                serviciosFiltrados=serviciosFiltrados[0]
                console.log(serviciosFiltrados);
                nombre_servicio=serviciosFiltrados.nombre_servicio;
                service_id=serviciosFiltrados.id;
                generarHoras(serviciosFiltrados.rango_minutos);
                $(".nombre_serviciofil").text(serviciosFiltrados.nombre_servicio)
                
                
                // Crear un nuevo array con 0 y 1 basado en los valores del objeto
                var arrayDiasActivos = diasSemana.map(function(dia) {
                return serviciosFiltrados[dia] || 0;
                });
               
                let dias_bloqueados=[];
                for (let index = 0; index < arrayDiasActivos.length; index++) {
                  
                    if(arrayDiasActivos[index]==0){
                        dias_bloqueados.push(index);
                    }
                    
                }
                console.log(dias_bloqueados);
                updateBusinessHours(dias_bloqueados);
              
            });
  

    // Función para actualizar los días bloqueados
    function updateBusinessHours(dias_bloqueados) {
     
      blockedDays=dias_bloqueados
      $('#calendario').fullCalendar('option', 'businessHours', {
        dow: [0, 1, 2, 3, 4, 5, 6].filter(day => !blockedDays.includes(day)),
        start: '00:00',
        end: '24:00',
      });
    }
  });

</script>
</body>

</html>