<?php
session_start();
if (!empty($_SESSION['active'])) {
    switch ($_SESSION['role']) {
        case 'docente':
            header('location: VistaDocente/index.php');
            break;
        case 'administrador':
            header('location: VistaAdministrador/index.php');
            break;
        case 'alumno':
            header('location: VistaAlumno/index.php');
            break;
    }
    exit();
} else {
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Advertencia',
                    text: 'Ingrese las credenciales correctas',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            });
            </script>";
        } else {
            require_once "Includes/Connection.php";
            $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
            $clave = mysqli_real_escape_string($conexion, $_POST['clave']);

            //Consulta para docentes
            $query_docentes = mysqli_query($conexion, "SELECT * FROM docentes WHERE dni = '$user'");
            $resultado_docentes = mysqli_num_rows($query_docentes);

            //Consulta para administradores
            $query_administradores = mysqli_query($conexion, "SELECT * FROM administradores WHERE dni = '$user'");
            $resultado_administradores = mysqli_num_rows($query_administradores);

            //Consulta para alumnos
            $query_alumnos = mysqli_query($conexion, "SELECT * FROM alumnos WHERE dni = '$user'");
            $resultado_alumnos = mysqli_num_rows($query_alumnos);

            $user_found = false;
            if ($resultado_docentes > 0) {
                $dato = mysqli_fetch_array($query_docentes);
                if (password_verify($clave, $dato['clave'])) {
                    $user_found = true;
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $dato['iddoc'];
                    $_SESSION['nombres'] = $dato['nombres'];
                    $_SESSION['apellidos'] = $dato['apellidos'];
                    $_SESSION['user'] = $dato['dni'];
                    $_SESSION['role'] = 'docente';
                    header('Location: VistaDocente/index.php');
                }
            } elseif ($resultado_administradores > 0) {
                $dato = mysqli_fetch_array($query_administradores);
                if (password_verify($clave, $dato['clave'])) {
                    $user_found = true;
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $dato['idadm'];
                    $_SESSION['nombres'] = $dato['nombres'];
                    $_SESSION['apellidos'] = $dato['apellidos'];
                    $_SESSION['user'] = $dato['dni'];
                    $_SESSION['role'] = 'administrador';
                    header('Location: VistaAdministrador/index.php');
                }
            } elseif ($resultado_alumnos > 0) {
                $dato = mysqli_fetch_array($query_alumnos);
                if (password_verify($clave, $dato['clave'])) {
                    $user_found = true;
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $dato['idalum'];
                    $_SESSION['nombres'] = $dato['nombres'];
                    $_SESSION['apellidos'] = $dato['apellidos'];
                    $_SESSION['user'] = $dato['dni'];
                    $_SESSION['role'] = 'alumno';
                    header('Location: VistaAlumno/index.php');
                }
            }

            if (!$user_found) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Credenciales incorrectas',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    });
                  </script>";
                session_destroy(); // Colocar después del script de error y remover break
            }

            mysqli_close($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Styles/Login.css">
    <link rel="stylesheet" type="text/css" href="Styles/Login2.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <title>Blas Pascal</title>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-4 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-1">
                    <img src="Styles/Img/Portada.jpg" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 630px;">
                </div>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="login-content">
                        <form method="post" action="index.php">
                            <div class="d-flex justify-content-center align-items-center mb-1 pb-1">
                                <img src="Styles/Img/Logo.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 190px; width: 190px;">
                            </div>
                            <h6 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 2px;">Ingresar las credenciales para iniciar sesión</h6>
                            <div class="input-div one">
                           <div class="i">
                              <i class="fas fa-user"></i>
                           </div>

                           <div class="div">
                            <h5>Usuario</h5>
                            <input id="usuario" type="text" class="input" name="usuario">
                           </div>
                        </div>

                        <div class="input-div pass">

                           <div class="i">
                            <i class="fas fa-lock"></i>
                           </div>

                           <div class="div">
                            <h5>Contraseña</h5>
                            <input type="password" id="input" class="input" name="clave">
                           </div>

                        </div>

                        <div class="view">
                          <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                        </div>

                         <br>

                            <br>
                            <input name="btningresar" class="btn" type="submit" value="INICIAR SESIÓN">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="js/main2.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener los campos de entrada
        var usuarioInput = document.getElementById('usuario');
        var passwordInput = document.getElementById('input');

        // Obtener los mensajes de alerta
        var mensajesAlerta = document.querySelectorAll('.alert');

        // Ocultar los mensajes de alerta al comenzar a escribir en los campos de entrada
        usuarioInput.addEventListener('keyup', function() {
            ocultarMensajesAlerta();
        });

        passwordInput.addEventListener('keyup', function() {
            ocultarMensajesAlerta();
        });

        // Función para ocultar los mensajes de alerta
        function ocultarMensajesAlerta() {
            mensajesAlerta.forEach(function(alerta) {
                alerta.style.display = 'none';
            });
        }
    });
</script>
