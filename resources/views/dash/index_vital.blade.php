<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Citas Medicas</title>

    <!-- Custom fonts for this template-->
    <link href="{!! asset('dash/vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{!! asset('dash/css/sb-admin-2.css') !!}" rel="stylesheet">
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
            background-color: #aaffaa;
            /* Color de fondo personalizado */
        }

        .fc-day-number {
            color: #fff;
        }
    </style>
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary-beta sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    
                    <i class="fa-solid fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Citas Medicas</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
            Gestión Profesionales
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{route('profesional.index')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Profesionales</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Gestión Servicios
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{route('servicios.index')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Servicios</span></a>
            </li>
            
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestión Pacientes
            </div>

           

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('usuario.index')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pacientes</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestión Citas
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Gestión de citas</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                   
                        <a class="collapse-item" href="{{route('ccitadash')}}">Crear Nueva CITA</a>
                        <a class="collapse-item" href="{{route('citas.espera')}}">Citas en Espera</a>
                        <a class="collapse-item" href="{{route('citas.index')}}">Citas Aprobadas</a>
                        <a class="collapse-item" href="{{route('citas.rechazadas')}}">Citas Rechazadas</a>
                        <a class="collapse-item" href="{{route('citas.canceladas')}}">Citas Canceladas</a>
                        
                    </div>
                </div>
            </li>
            


            
            <div class="sidebar-heading">
            Gestión Plataforma
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{route('users.edit')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Cambio de credenciales</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

           

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{ $parametro->total_citas_espera }}+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                @if($parametro->total_citas_espera < 0 )
                                    Citas Pendientes
                                @else
                                    No Hay Citas Pendientes
                                @endif
                                    
                                </h6>
                                @for ($i = 0; $i <  $parametro->total_citas_espera ; $i++)
                                <a class="dropdown-item d-flex align-items-center" href="{{route('citas.pendientes', ['id' => $parametro[$i]->id])}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{$parametro[$i]->fecha_cita}}</div>
                                        {{$parametro[$i]->nombre_completo}} - {{$parametro[$i]->nombre_servicio}}
                                    </div>
                                </a>
                                @endfor

                                
                               
                            </div>
                            
                        </li>

                      

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$parametro->username}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{!! asset('dash/img/undraw_profile.svg') !!}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between">
                <div class="col-md-3 align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Nueva CITA
                    </h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <!-- Outer Row -->
                <div class="row justify-content-center" id="regis">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="text-gray-900 mb-4">
                                                    Agendamiento <br />de citas
                                                </h1>
                                            </div>
                                            <form
                                                class="user"
                                                id="formularioRegistro"
                                            >
                                                @csrf
                                                <div class="form-group">
                                                    <input
                                                        type="number"
                                                        class="form-control form-control-user"
                                                        id="numero_documento"
                                                        placeholder="Número de documento"
                                                        autocomplete="off"
                                                    />
                                                </div>
                                                <div class="form-group">
                                                    <input
                                                        type="text"
                                                        class="form-control form-control-user"
                                                        id="exampleInputPassword"
                                                        placeholder="Nombres Completos"
                                                        autocomplete="off"
                                                    />
                                                </div>

                                                <div class="form-group">
                                                    <input
                                                        type="text"
                                                        class="form-control form-control-user"
                                                        id="telefono"
                                                        placeholder="Telefono"
                                                        autocomplete="off"
                                                    />
                                                </div>

                                                <a
                                                    class="btn btn-primary btn-user btn-block registro_user"
                                                >
                                                    Registrar Usuario
                                                </a>
                                                <hr />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" id="cita">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div
                                    class="row align-items-center justify-content-center"
                                >
                                    <div class="col-lg-6 d-lg-block">
                                    <h3
                                            id="mensaje_limite"
                                            class="px-3 bg-danger text-light"
                                            style="display: none"
                                        >
                                            El Usuario Alcanzó el límite mensual de citas.
                                        </h3>
                                        <div id="calendario" class="m-3"></div>
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h2
                                                    class="h4 text-gray-900 mb-4 display-4"
                                                >
                                                    Gestión <br />de citas
                                                </h2>
                                                <br />

                                                <h2
                                                    class="h4 text-gray-900 mb-4 nombres"
                                                >
                                                    Nombres
                                                </h2>
                                            </div>
                                            <form class="user">
                                                <div class="form-group">
                                                    <input
                                                        type="number"
                                                        class="form-control form-control-user"
                                                        id="cita_documento"
                                                        placeholder="Número de documento"
                                                        autocomplete="off"
                                                    />
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlSelect1"
                                                        >Seleccione el servicio
                                                        de cita que desea</label
                                                    >
                                                    <select
                                                        class="form-control"
                                                        id="services_select"
                                                    >
                                                        <option
                                                            disabled
                                                            selected
                                                        >
                                                            Seleccione un
                                                            servicio
                                                        </option>
                                                        @foreach($citas as
                                                        $cita)
                                                        <option
                                                            value="{{$cita->id_servi}}"
                                                        >
                                                            {{$cita->nombre_servicio}}-
                                                            DR
                                                            {{$cita->nombre_profesinal}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <hr />
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="row justify-content-center"
                                    id="tabla_de_citas"
                                    style="display: none"
                                >
                                    <div class="col-md-11">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-bordered"
                                                id="dataTable"
                                                width="100%"
                                                cellspacing="0"
                                            >
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            Documento
                                                        </th>
                                                        <th class="text-center">
                                                            Nombre Completo
                                                        </th>
                                                        <th class="text-center">
                                                            Servicio
                                                        </th>
                                                        <th class="text-center">
                                                            Fecha
                                                        </th>
                                                        <th class="text-center">
                                                            Estado
                                                        </th>
                                                        <th class="text-center">
                                                            Acción
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div
                class="modal fade"
                id="exampleModal"
                tabindex="-1"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Agendamiento de cita
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="font-weight-bold">No Documento</h5>
                            <h5 class="cita_documento2">No Documento</h5>
                            <hr />
                            <h5 class="font-weight-bold">Nombres</h5>
                            <h5 class="nombres">Nombres</h5>
                            <hr />
                            <h5 class="font-weight-bold">Servicio</h5>
                            <h5 class="nombre_serviciofil">Servicio</h5>
                            <hr />
                            <h5 class="font-weight-bold">Fecha</h5>
                            <h5 class="fechas_servi">Hora</h5>
                            <hr />

                            <div class="form-group" id="mensaje_con_cita">
                                <label for="exampleFormControlSelect1"
                                    >Seleccione la hora</label
                                >
                                <select
                                    id="horas"
                                    class="form-control"
                                ></select>
                            </div>
                            <div class="form-group" id="mensaje_sin_cita">
                                <label for="exampleFormControlSelect1"
                                    >Lo sentimos la agenda esta completa</label
                                >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                cerrar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary guardar_citas"
                            >
                                Guardar cita
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; dashboard 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nos dejas?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Esta seguro que quiere cerrar sesion</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{route('logina')}}">Salir</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
<script src="{!! asset('dash/vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('dash/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

<!-- Core plugin JavaScript-->
<script src="{!! asset('dash/vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="{!! asset('dash/js/sb-admin-2.min.js') !!}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css"
/>
<script src="{!! asset('dash/js/fullcalendar.min.js') !!}"></script>
<script src="{!! asset('dash/js/es.js') !!}"></script>

<script>
    let nombre_global = "AAA";
    let numero_global = "AA";
    let nombre_servicio = "AAA";
    let id_servioos_apí;
    let user_id;
    let service_id;
    let fecha_seleccionada;
    let horas_seleccionada;

    $("#cita").hide();
    $("#mensaje_sin_cita").hide();
    $(document).ready(function () {
        $('#numero_documento').on('input', function () {
            var query = $(this).val();
            if (query.length >= 5) {
                // Realiza la solicitud AJAX
                $.ajax({
                    url: '{{ route('buscar.documento', ['documento' => 'valor']) }}'.replace('valor', query),
                    method: 'GET',

                    success: function (data) {
                        // Maneja los resultados y actualiza la interfaz de usuario

                        if (data.data != null) {

                            nombre_global = data.data.nombre_completo;
                            numero_global = data.data.cedula;
                            user_id = data.data.id;
                            var limite=data.informacion
                            if(limite>=2){
                               
                                $("#mensaje_limite").show();
                            }


                            if (data.cita.length > 0) {
                                $("#tabla_de_citas").show();
                                crear_tabla(data.cita)
                            }

                            console.log("numero de documento ", data.data);
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

        function crear_tabla(datos) {
            // Obtén una referencia al tbody de la tabla
            var tbody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];

            // Recorre el array y agrega filas a la tabla
            for (var i = 0; i < datos.length; i++) {
                var fila = tbody.insertRow(tbody.rows.length); // Inserta una nueva fila al final

                // Inserta celdas en la fila con la información correspondiente
                var celdaDocumento = fila.insertCell(0);
                var celdaNombre = fila.insertCell(1);
                var celdaservicio = fila.insertCell(2);
                var celdaFecha = fila.insertCell(3);
                var celdaestado = fila.insertCell(4);
                var celdaeliminar = fila.insertCell(5);


                // Asigna los valores del array a las celdas
                celdaDocumento.textContent = datos[i].cedula;
                celdaNombre.textContent = datos[i].nombre_completo;
                celdaservicio.textContent = datos[i].nombre_servicio;
                celdaFecha.textContent = datos[i].fecha_cita;
                celdaestado.textContent = datos[i].estado;
                //celdaeliminar.textContent = datos[i].id;
                var fechaActual = new Date();

                // Formatear la fecha y la hora
                var fechaFormateada = fechaActual.toISOString().split('T')[0];
                var horaFormateada = fechaActual.toLocaleTimeString('en-US', { hour12: true, hour: '2-digit', minute: '2-digit', second: '2-digit' });

                var ffecha = new Date(fechaFormateada);
                var fechaEstado = new Date(datos[i].fecha_cita);



                if(datos[i].estado=="En espera" || datos[i].estado=="Aprobada"){
                        // Comparar las fechas
                    if (ffecha > fechaEstado) {
                        console.log('La fecha actual es posterior a la fecha de estado.');
                    } else {

                    var botonEliminar = document.createElement('button');
                    botonEliminar.textContent = 'Cancelar';
                    botonEliminar.setAttribute('data-id', datos[i].id); // Asigna el ID del dato al botón
                    botonEliminar.classList.add('btn');
                    botonEliminar.classList.add('btn-danger');
                    // Agrega el evento onclick al botón llamando a la función handleEliminarClick
                    botonEliminar.onclick = function () {
                        var id = this.getAttribute('data-id');

                        handleEliminarClick(id);
                    };
                    // Asigna el botón a la celda
                    celdaeliminar.appendChild(botonEliminar);
                    }


                }


            }
        }
        // Función para manejar el clic del botón
        function handleEliminarClick(ids) {
            swal({
                title: "¿Desea cancelar esta cita?",
                text: "Una vez cancelado, no podrá revertir el proceso",
                icon: "warning",
                buttons: {
                    cancel: "No",
                    confirm: "Sí"
                },
                dangerMode: true,

            })
                .then((willDelete) => {
                    if (willDelete) {
                        var query = ids;
                        $.ajax({
                            url: '{{ route('citausuario.eliminar', ['id' => 'ids']) }}'.replace('ids', query),
                            method: 'GET',
                            success: function (data) {
                                if (data.data != null) {
                                    console.log(data.data);
                                    location.reload();
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    } else {

                    }
                });




        }


        $(".guardar_citas").on('click', function () {
            var tokenCSRF = document.getElementById('formularioRegistro').querySelector('[name="_token"]').value;
            console.log($("#horas").val());
            var datos = {
                _token: tokenCSRF,
                usuario_id: user_id,
                servicio_id: service_id,
                fecha_cita: fecha_seleccionada + ' ' + $("#horas").val()
                // Agrega más campos según sea necesario
            };
            $.ajax({
                url: '{{ route('citas.store') }}',
                method: 'POST',
                data: datos,
                success: function (data) {
                    // Maneja los resultados y actualiza la interfaz de usuario
                    console.log(data.data);
                    if (data.data != "") {
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
                        }).then(function () {
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

        $(".registro_user").on('click', function () {
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
                telefono: telefono_form
                // Agrega más campos según sea necesario
            };


            $.ajax({
                url: '{{ route('usuario.store') }}',
                method: 'POST',
                data: datos,
                success: function (data) {
                    // Maneja los resultados y actualiza la interfaz de usuario
                    console.log(data.data);
                    if (data.data != "") {
                        nombre_global = data.data.nombre_completo;
                        numero_global = data.data.cedula;
                        user_id = data.data.id;
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
        });
    });
</script>

<script>
    let datosDesdePHP = @json($citas);

    let rango_de_cita = 0;
    let servicio_seleccionado_todo;
    $(document).ready(function () {
        var blockedDays = [0, 1, 2, 3, 4, 5, 6];
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
            dayClick: function (date, jsEvent, view) {
                var dayOfWeek = date.day();
                var dia = date.format("dddd");
                var today = moment();

                // Verificar si el día está bloqueado
                if (blockedDays.includes(dayOfWeek) || !date.isSame(today.clone().add(1, 'day'), 'day')) {
                    // El día está bloqueado, no realizar ninguna acción

                    console.log("Este día está bloqueado");
                } else {
                    var fecha_actual = date.format()

                    var url = '{{ route('cita.hora_disponible', ['id_servicio' => 'id_servicio', 'fecha_consulta' => 'fecha_actual']) }}';
            url = url.replace('fecha_actual', fecha_actual).replace('id_servicio', id_servioos_apí);
            console.log(url);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    if (data.data != null) {

                        var horas_excluidas = data.data
                        let rango_nuevo = dia_seleccionado_dar_horas(dia);
                        generarHoras(rango_nuevo, rango_de_cita, horas_excluidas);
                        $('#exampleModal').modal('show')
                        $(".fechas_servi").text(date.format());
                        fecha_seleccionada = date.format();

                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });


        }
    },
        dayRender: function (date, cell) {
            /*var dayOfWeek = date.day();

            // Verificar si el día está bloqueado y aplicar el estilo correspondiente
            if (blockedDays.includes(dayOfWeek)) {
                cell.addClass('blocked-day');
            } else {
                cell.addClass('available-day');
            }*/
            var today = moment();
            var dayOfWeek = date.day();
            // Verificar si el día está bloqueado, o no es el día siguiente
            if (blockedDays.includes(dayOfWeek) || !date.isSame(today.clone().add(1, 'day'), 'day')) {
                cell.addClass('blocked-day');
            } else {
                cell.addClass('available-day');
            }

        }
    });


    function dia_seleccionado_dar_horas(dia) {

        let rangos_utiles;
        switch (dia) {
            case "lunes":
                rangos_utiles = servicio_seleccionado_todo.rango_lunes;
                break;
            case "martes":
                rangos_utiles = servicio_seleccionado_todo.rango_martes
                break;
            case "miércoles":
                rangos_utiles = servicio_seleccionado_todo.rango_miercoles
                break;
            case "jueves":
                rangos_utiles = servicio_seleccionado_todo.rango_jueves
                break;
            case "viernes":
                rangos_utiles = servicio_seleccionado_todo.rango_viernes
                break;
            case "sábado":
                rangos_utiles = servicio_seleccionado_todo.rango_sabado
                break;
            case "domingo":
                rangos_utiles = servicio_seleccionado_todo.rango_domingo
                break;
        }
        return rangos_utiles;
    }
    // Manejar cambios en el multiselect
    function filtrarPorId(idSeleccionado) {
        return datosDesdePHP.filter(function (servicio) {
            return servicio.id_servi == idSeleccionado;
        });
    }

    let calendar;


    function generarHoras(rango, tiems, excluidas) {
        var selectHoras = document.getElementById("horas");
        selectHoras.innerHTML = ""; // Limpiar el select antes de llenarlo nuevamente

        // Dividir el rango en mañana y tarde
        var rangos = rango.split("A");
        if (rangos.length !== 2) {
            console.error("Formato de rango incorrecto. Debe ser 'mañana&tarde'.");
            return;
        }

        // Procesar la mañana
        procesarRango(rangos[0], "AM");

        // Procesar la tarde
        procesarRango(rangos[1], "PM");

        // Función para procesar un rango específico y agregar las opciones al select
        function procesarRango(rangoHora, ampm) {
            var [desde, hasta] = rangoHora.split("&");
            var horaInicio = convertirAMinutos(desde);
            var horaFin = convertirAMinutos(hasta);

            for (var i = horaInicio; i < horaFin; i += tiems) {
                var hora = Math.floor(i / 60); // Obtener las horas
                var minutos = i % 60;         // Obtener los minutos

                // Formatear la hora en formato hh:mm AM/PM
                var horaFormateada = formatearHora(hora, minutos, ampm);



                var miArray = excluidas;
                var miVariable = horaFormateada;

                if (miArray.includes(miVariable.toString())) {

                } else {
                    // Crear una opción y agregarla al select
                    var opcion = document.createElement("option");
                    console.log(horaFormateada);
                    opcion.value = horaFormateada;
                    opcion.text = horaFormateada;
                    selectHoras.add(opcion);
                }



            }

        }

        // Función para convertir una hora en formato HH:mm a minutos desde la medianoche
        function convertirAMinutos(hora) {
            var [hh, mm] = hora.split(":");
            return parseInt(hh, 10) * 60 + parseInt(mm, 10);
        }

        // Función para formatear la hora en formato hh:mm AM/PM
        function formatearHora(hora, minutos, ampm) {
            hora = hora % 12 || 12; // Convertir a formato de 12 horas
            return (hora < 10 ? "0" : "") + hora + ":" + (minutos === 0 ? "00" : minutos) + " " + ampm;
        }

        var numeroDeOpciones = selectHoras.options.length;


        if (numeroDeOpciones == 0) {
            $("#mensaje_con_cita").hide();
            $("#mensaje_sin_cita").show();
        } else {
            $("#mensaje_con_cita").show();
            $("#mensaje_sin_cita").hide();
        }
    }

    $("#services_select").on("change", function () {
        // Obtiene el valor seleccionado
        var valorSeleccionado = $(this).val();
        var serviciosFiltrados = filtrarPorId(valorSeleccionado);

        var diasSemana = ["domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado"];
        serviciosFiltrados = serviciosFiltrados[0]
        console.log(serviciosFiltrados);
        servicio_seleccionado_todo = serviciosFiltrados;
        nombre_servicio = serviciosFiltrados.nombre_servicio;
        id_servioos_apí = valorSeleccionado;
        service_id = serviciosFiltrados.id;
        rango_de_cita = serviciosFiltrados.rango_minutos;

        $(".nombre_serviciofil").text(serviciosFiltrados.nombre_servicio)


        // Crear un nuevo array con 0 y 1 basado en los valores del objeto
        var arrayDiasActivos = diasSemana.map(function (dia) {
            return serviciosFiltrados[dia] || 0;
        });

        let dias_bloqueados = [];
        for (let index = 0; index < arrayDiasActivos.length; index++) {

            if (arrayDiasActivos[index] == 0) {
                dias_bloqueados.push(index);
            }

        }
        console.log(dias_bloqueados);
        updateBusinessHours(dias_bloqueados);

    });


    // Función para actualizar los días bloqueados
    function updateBusinessHours(dias_bloqueados) {
        // Obtener el día actual
        var today = moment();

        // Guardar los días bloqueados específicos
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

            // Verificar si el día está bloqueado, o no es el día siguiente
            if (blockedDays.includes(dayOfWeek) || !date.isSame(today.clone().add(1, 'day'), 'day')) {
                cell.addClass('blocked-day');
            } else {
                cell.addClass('available-day');
            }
        });
    }

    });
</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {


    
    });
</script>



</body>

</html>

