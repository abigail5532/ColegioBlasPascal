<?php
include('../Includes/Connection.php');

if (!isset($_GET['iddoc']) || empty($_GET['iddoc'])) {
    header("Location: tblDocentes.php");
    exit();
}

$iddoc = $_GET['iddoc'];

$query = mysqli_query($conexion, "SELECT * FROM asignar_grado_asignatura");
$docentes = mysqli_query($conexion, "SELECT * FROM docentes WHERE iddoc = $iddoc");
$consulta = mysqli_query($conexion, "SELECT * FROM asignar_docente_asignatura WHERE docente = $iddoc");
$resultDocente = mysqli_num_rows($docentes);

if(empty($resultDocente)){
    header("Location: tblDocentes.php");
}

$datos = array();
while ($asignado = mysqli_fetch_assoc($consulta)) {
    $datos[$asignado['asignatura']] = true;
}

if(isset($_POST['asignaturas'])){
    $asignaturas = $_POST['asignaturas'];
    
    //Verificar si existe AQUÌ TE QUEDASTE
    $consulta_actuales = mysqli_query($conexion, "SELECT asignatura FROM asignar_docente_asignatura WHERE docente = $iddoc");
    $asignaturas_actuales = array();
    while ($fila = mysqli_fetch_assoc($consulta_actuales)) {
        $asignaturas_actuales[] = $fila['asignatura'];
    }

    //Eliminar si no fue seleccionada
    $asignaturas_a_eliminar = array_diff($asignaturas_actuales, $asignaturas);
    if (!empty($asignaturas_a_eliminar)) {
        $asignaturas_a_eliminar_str = implode(",", $asignaturas_a_eliminar);
        $sql_eliminar = mysqli_query($conexion, "DELETE FROM asignar_docente_asignatura WHERE docente = $iddoc AND asignatura IN ($asignaturas_a_eliminar_str)");
        if (!$sql_eliminar) {
            echo "Error al eliminar: " . mysqli_error($conexion);
        }
    }

    //Agregar si no existe
    $asignaturas_a_insertar = array_diff($asignaturas, $asignaturas_actuales);
    if (!empty($asignaturas_a_insertar)) {
        foreach ($asignaturas_a_insertar as $asignatura) {
            $sql_insertar = mysqli_query($conexion, "INSERT INTO asignar_docente_asignatura (docente, asignatura) VALUES ($iddoc, $asignatura)");
            if (!$sql_insertar) {
                echo "Error al insertar: " . mysqli_error($conexion);
            }
        }
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',                
                text: 'Las asignaturas fueron asignadas',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {                               
                    window.location.href = 'tblDocentes.php';
                }                
            });
        });
        </script>";
}

mysqli_close($conexion);
?>