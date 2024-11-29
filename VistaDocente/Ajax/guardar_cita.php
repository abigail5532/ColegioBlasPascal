
<?php
include('../Includes/Connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $alumno = $_POST['alumno'];
    $docente_id = $_POST['docente'];
    $reunion = $_POST['reunion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $nombrefa = $_POST['nombrefa'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    // Dividir el campo de hora en horai y horaf
    list($horai, $horaf) = explode('-', $hora);

    // Buscar el ID del alumno
    $query_alumno = "SELECT idalum FROM alumnos WHERE CONCAT(nombres, ' ', apellidos) = '$alumno'";
    $result_alumno = mysqli_query($conexion, $query_alumno);
    if (!$result_alumno) {
        die("Error en la consulta de alumno: " . mysqli_error($conexion));
    }
    $row_alumno = mysqli_fetch_assoc($result_alumno);
    if (!$row_alumno) {
        die("Alumno no encontrado.");
    }
    $alumno_id = $row_alumno['idalum'];

    // Verificar si el horario existe y está activo
    $query_horario = "SELECT id FROM horario WHERE iddocen = '$docente_id' AND dia = '$fecha' AND horai = '$horai' AND horaf = '$horaf' AND estado = 'Activo'";
    $result_horario = mysqli_query($conexion, $query_horario);
    if (!$result_horario) {
        die("Error en la consulta de horario: " . mysqli_error($conexion));
    }
    $row_horario = mysqli_fetch_assoc($result_horario);
    if (!$row_horario) {
        die("Horario no encontrado o no activo.");
    }
    $horario_id = $row_horario['id'];

    // Insertar los datos en la tabla de citas
    $query_cita = "INSERT INTO cita (alumno, docente, reunion, fecha, horai, horaf, nomfamiliar, descripcion, estado) VALUES ('$alumno_id', '$docente_id', '$reunion', '$fecha', '$horai', '$horaf', '$nombrefa', '$descripcion', '$estado')";
    if (mysqli_query($conexion, $query_cita)) {
        // Actualizar el estado del horario
        $query_update_horario = "UPDATE horario SET estado = 'Inactivo' WHERE id = '$horario_id'";
        if (!mysqli_query($conexion, $query_update_horario)) {
            die("Error al actualizar el horario: " . mysqli_error($conexion));
        }

        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Cita registrada correctamente',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then(function() {
                        window.location = 'tblCitas.php';
                    });
                });
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al registrar la cita. Inténtalo nuevamente.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                });
              </script>";
    }

    mysqli_close($conexion);
    
}
?>
