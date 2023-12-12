<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agendamiento de citas</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="dash/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-lg-6  d-flex align-items-center justify-content-center ">

<img src="https://citasmedicas.techmhm.com/dash/img/logo.png" alt="..." width="80%" class="">

                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                    @if(session('success'))
                                    <div class="alert alert-danger" role="alert">
                                     El  Email o contraseña digitados son incorrectos
                                    </div>
                                    @endif
                                    <h2 class="h4 text-gray-900 mb-4 display-4">Bienvenido</h2>
                                    </div>
                                    <form class="user" method="POST" action="{{route('loginfin')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                aria-describedby="emailHelp"
                                                placeholder="Digite Email" autocomplete="off" name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                               placeholder="Password" autocomplete="off" name="password">
                                        </div>
                                       
                                          <input class="btn btn-primary btn-user btn-block registro_user"type="submit" value="  Iniciar Sesion">
                                       
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

</body>

</html>