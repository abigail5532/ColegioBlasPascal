<?php
include('../Includes/Connection.php');

$idbol = isset($_GET['idbol']) ? $_GET['idbol'] : '';
$idalum = isset($_GET['idalum']) ? $_GET['idalum'] : '';
$idaula= isset($_GET['idaula']) ? $_GET['idaula'] : '';

// Inicializar variables
$bimestre = '';
$promedioarea = '';
$comportamiento = '';
$promediogeneral = '';
$promedioalfabetico = '';
$apreciacion = '';

if ($idbol) {
    // Preparar la consulta SQL
    $stmt = $conexion->prepare("SELECT * FROM boletanotas WHERE idbol = ?");
    $stmt->bind_param("i", $idbol);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        $idalum = $data['idalum'];
        $bimestre = $data['bimestre'];
        $promedioarea = $data['promedioarea'];
        $comportamiento = $data['comportamiento'];
        $promediogeneral = $data['promediogeneral'];
        $promedioalfabetico = $data['promedioalfabetico'];
        $apreciacion = $data['apreciacion'];
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hay un error con la consulta',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                });
              </script>";
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['apreciacion']) || empty($_POST['bimestre'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Todos los campos son obligatorios',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                });
              </script>";
    } else {
        $idbol = $_POST['idbol'];
        $idalum = $_POST['idalum'];
        $bimestre = $_POST['bimestre'];
        $promedioarea = $_POST['promedioarea'];
        $comportamiento = $_POST['comportamiento'];
        $promediogeneral = $_POST['promediogeneral'];
        $promedioalfabetico = $_POST['promedioalfabetico'];
        $apreciacion = $_POST['apreciacion'];

        if (empty($idbol)) {
            // Verificar si ya existe
            $stmt = $conexion->prepare("SELECT * FROM boletanotas WHERE alumno = ? AND bimestre = ?");
            $stmt->bind_param("ss", $idalum, $bimestre);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Advertencia',
                                text: 'Ya hay un registro de este alumno',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'tblTutoriaAlumnos.php?idaula=$idaula';
                                }
                            });
                        });
                      </script>";
            } else {
                // Insertar nuevo registro
                $stmt = $conexion->prepare("INSERT INTO boletanotas (alumno, bimestre, promedioarea, comportamiento, promediogeneral, promedioalfabetico, apreciacion) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $idalum, $bimestre, $promedioarea, $comportamiento, $promediogeneral, $promedioalfabetico, $apreciacion);

                if ($stmt->execute()) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Las notas se registraron correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'tblTutoriaAlumnos.php?idaula=$idaula';
                                    }
                                });
                            });
                          </script>";
                } else {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Error al registrar',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                });
                            });
                          </script>";
                }
                $stmt->close();
            }
        } else {
            // Actualizar registro
            $stmt = $conexion->prepare("UPDATE boletanotas SET alumno = ?, bimestre = ?, promedioarea = ?, comportamiento = ?, promediogeneral = ?, promedioalfabetico = ?, apreciacion = ? WHERE idbol = ?");
            $stmt->bind_param("sssssssi", $idalum, $bimestre, $promedioarea, $comportamiento, $promediogeneral, $promedioalfabetico, $apreciacion, $idbol);

            if ($stmt->execute()) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Registro modificado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'tblTutoriaAlumnos.php?idaula=$idaula';
                                }
                            });
                        });
                      </script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'Error al modificar registro',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        });
                      </script>";
            }
            $stmt->close();
        }
    }
    mysqli_close($conexion);
}
?>

























