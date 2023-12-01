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

#calendario .fc-day-grid .fc-day.fc-widget-content.blocked-day {
    background-color: #e31b1b;
    color: green;
    cursor: not-allowed; 
}
#calendario .fc-day-grid .fc-day.fc-widget-content.available-day {
    background-color: #42934c;
    color: #fff;
    cursor: not-allowed; 
}
    
.custom-day {
      background-color: #aaffaa; /* Color de fondo personalizado */
    }
    .fc-day-number{
        color: #fff;
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
                            <div class="col-lg-6  d-flex align-items-center justify-content-center ">

                            <img src="https://citasmedicas.techmhm.com/dash/img/logo.png" alt="..." width="80%" class="img-thumbnail">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="text-gray-900 mb-4 ">Agendamiento <br>de citas</h1>
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

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="telefono" placeholder="Telefono" autocomplete="off">
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
               
                    <div id="calendario" class="m-3">

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
                                <option value="{{$cita->id_servi}}">{{$cita->nombre_servicio}}- DR {{$cita->nombre_profesinal}}</option>
                                @endforeach
                                </select>
                            </div>
                            
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
        let nombre_global="AAA";
        let numero_global="AA";
        let nombre_servicio="AAA";
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
                        /*swal("Cita Agendada Correctamente", 
                        nombre_global+"-"+numero_global+"-"+nombre_servicio,
                         "success");*/

                         swal({
    title: "Cita Agendada Correctamente",
    text:
        "Nombre: " + nombre_global + "\n" +
        "No Documento: " + numero_global + "\n" +
        "Servicio: " + nombre_servicio + "\n\n" +
        "Una vez agendada su cita, se le notificará vía telefónica o por mensaje de texto",
    icon: "success",
    content: {
        element: "span",
        attributes: {
            style: "font-style: italic;"
        },
        text: "Una vez agendada su cita, se le notificará vía telefónica o por mensaje de texto"
    }
}).then(function(){
    location.reload();
});
                         
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
            var telefono_form = document.getElementById('telefono').value;
            
            // Crea un objeto con los datos a enviar
            var datos = {
                _token: tokenCSRF,
                numero_documento: numeroDocumento,
                nombres_completos: nombresCompletos,
                telefono:telefono_form
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>

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
          $(".fechas_servi").text(date.format());
          fecha_seleccionada=date.format();
        }
      },
      dayRender: function (date, cell) {
        var dayOfWeek = date.day();

        // Verificar si el día está bloqueado y aplicar el estilo correspondiente
        if (blockedDays.includes(dayOfWeek)) {
            cell.addClass('blocked-day');
        } else {
            cell.addClass('available-day');
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

        // Excluir horas de 12:00 PM a 2:00 PM
        if (!(hora >= 12 && hora < 14)) {
            // Convertir a formato AM/PM
            var ampm = hora >= 12 ? "PM" : "AM";
            hora = hora % 12 || 12; // Convertir a formato de 12 horas

            // Formatear la hora en formato hh:mm AM/PM
            var horaFormateada = (hora < 10 ? "0" : "") + hora + ":" + (minutos === 0 ? "00" : minutos) + " " + ampm;

            // Crear una opción y agregarla al select
            var opcion = document.createElement("option");
            opcion.value = horaFormateada;
            opcion.text = horaFormateada;
            selectHoras.add(opcion);
        }
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
        blockedDays = dias_bloqueados;

            // Actualizar las horas de trabajo del calendario
            $('#calendario').fullCalendar('option', 'businessHours', {
                dow: [0, 1, 2, 3, 4, 5, 6].filter(day => !blockedDays.includes(day)),
                start: '00:00',
                end: '24:00',
            });

            // Configurar la función dayRender para aplicar estilos
            $('#calendario').fullCalendar('option', 'dayRender', function (date, cell) {
                var dayOfWeek = date.day();

                // Verificar si el día está bloqueado y aplicar el estilo correspondiente
                if (blockedDays.includes(dayOfWeek)) {
                    cell.addClass('blocked-day');
                } else {
                    cell.addClass('available-day');
                }
            });
    }
  });

</script>
</body>

</html>