<?php
include('../Includes/Connection.php');

if (!isset($_GET['idaula']) || empty($_GET['idaula'])) {
    header("Location: tblAulas.php");
    exit();
}

$idaula = $_GET['idaula'];

$query = mysqli_query($conexion, "SELECT * FROM asignaturas");
$aulas = mysqli_query($conexion, "SELECT * FROM aulas WHERE idaula = $idaula");
$consulta = mysqli_query($conexion, "SELECT * FROM asignar_grado_asignatura WHERE aula = $idaula");
$resultAula = mysqli_num_rows($aulas);

if (empty($resultAula)) {
    header("Location: tblAulas.php");
    exit();
}

$datos = array();
while ($asignado = mysqli_fetch_assoc($consulta)) {
    $datos[$asignado['asignatura']] = true;
}

if (isset($_POST['asignaturas'])) {
    $asignaturas = $_POST['asignaturas'];
    
    //Verificar si existe
    $consulta_actuales = mysqli_query($conexion, "SELECT asignatura FROM asignar_grado_asignatura WHERE aula = $idaula");
    $asignaturas_actuales = array();
    while ($fila = mysqli_fetch_assoc($consulta_actuales)) {
        $asignaturas_actuales[] = $fila['asignatura'];
    }

    //Eliminar si no fue seleccionada
    $asignaturas_a_eliminar = array_diff($asignaturas_actuales, $asignaturas);
    if (!empty($asignaturas_a_eliminar)) {
        $asignaturas_a_eliminar_str = implode(",", $asignaturas_a_eliminar);
        $sql_eliminar = mysqli_query($conexion, "DELETE FROM asignar_grado_asignatura WHERE aula = $idaula AND asignatura IN ($asignaturas_a_eliminar_str)");
        if (!$sql_eliminar) {
            echo "Error al eliminar: " . mysqli_error($conexion);
        }
    }

    //Agregar si no existe
    $asignaturas_a_insertar = array_diff($asignaturas, $asignaturas_actuales);
    if (!empty($asignaturas_a_insertar)) {
        foreach ($asignaturas_a_insertar as $asignatura) {
            $sql_insertar = mysqli_query($conexion, "INSERT INTO asignar_grado_asignatura (aula, asignatura) VALUES ($idaula, $asignatura)");
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
                    window.location.href = 'tblAulas.php';
                }                
            });
        });
        </script>";
}

mysqli_close($conexion);
?>

