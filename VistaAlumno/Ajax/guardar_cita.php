<?php
include('../Includes/Connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $alumno = $_POST['alumno'];
    $docente = $_POST['docente'];
    $reunion = $_POST['reunion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $nombrefa = $_POST['nombrefa'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    // Dividir el campo de hora en horai y horaf
    list($horai, $horaf) = explode('-', $hora);

    // Buscar el ID del docente
    $query_docente = "SELECT iddoc FROM docentes WHERE CONCAT(nombres, ' ', apellidos) = '$docente'";
    $result_docente = mysqli_query($conexion, $query_docente);
    if (!$result_docente) {
        die("Error en la consulta de docente: " . mysqli_error($conexion));
    }
    $row_docente = mysqli_fetch_assoc($result_docente);
    if (!$row_docente) {
        die("Docente no encontrado.");
    }
    $docente_id = $row_docente['iddoc'];

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
    $query_cita = "INSERT INTO cita (alumno, docente, reunion, fecha, horai, horaf, nomfamiliar, descripcion,  estado) VALUES ('$alumno', '$docente_id', '$reunion', '$fecha', '$horai', '$horaf', '$nombrefa', '$descripcion', '$estado')";
    if (mysqli_query($conexion, $query_cita)) {
        // Actualizar el estado del horario
        $query_update_horario = "UPDATE horario SET estado = 'Inactivo' WHERE id = '$horario_id'";
        if (!mysqli_query($conexion, $query_update_horario)) {
            die("Error al actualizar el horario: " . mysqli_error($conexion));
        }
        // Mostrar mensaje de éxito y redireccionar
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Cita registrada exitosamente.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'tblReuniones.php';
                        }
                    });
                });
              </script>";
    } else {
        // Mostrar mensaje de error
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al registrar la cita: " . mysqli_error($conexion) . "',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'addReuniones.php';
                        }
                    });
                });
              </script>";
    }

    mysqli_close($conexion);
}
?>
