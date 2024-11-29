<?php
include('../Includes/Connection.php');

$idcomp = isset($_GET['idcomp']) ? $_GET['idcomp'] : '';
$idalum = isset($_GET['idalum']) ? $_GET['idalum'] : '';
$idaula= isset($_GET['idaula']) ? $_GET['idaula'] : '';

// Inicializar variables
$bimestre = '';
$inasistenciajust = '';
$inasistenciainjust = '';
$tardanzajust = '';
$tardanzainjust = '';
$puntualidad = '';
$respeto = '';
$responsabilidad = '';
$aseo = '';
$yearacad = date('Y');

if ($idcomp) {
    // Preparar la consulta SQL
    $stmt = $conexion->prepare("SELECT * FROM comportamiento WHERE idcomp = ?");
    $stmt->bind_param("i", $idcomp);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        $idalum = $data['idalum'];
        $bimestre = $data['bimestre'];
        $inasistenciajust = $data['inasistenciajust'];
        $inasistenciainjust = $data['inasistenciainjust'];
        $tardanzajust = $data['tardanzajust'];
        $tardanzainjust = $data['tardanzainjust'];
        $puntualidad = $data['puntualidad'];
        $respeto = $data['respeto'];
        $responsabilidad = $data['responsabilidad'];
        $aseo = $data['aseo'];
        $yearacad = $data['yearacad'];
    } else {
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
    if (empty($_POST['idalum']) || empty($_POST['bimestre'])) {
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
        $idcomp = $_POST['idcomp'];
        $idalum = $_POST['idalum'];
        $bimestre = $_POST['bimestre'];
        $inasistenciajust = $_POST['inasistenciajust'];
        $inasistenciainjust = $_POST['inasistenciainjust'];
        $tardanzajust = $_POST['tardanzajust'];
        $tardanzainjust = $_POST['tardanzainjust'];
        $puntualidad = $_POST['puntualidad'];
        $respeto = $_POST['respeto'];
        $responsabilidad = $_POST['responsabilidad'];
        $aseo = $_POST['aseo'];
        $yearacad = $_POST['yearacad'];

        if (empty($idcomp)) {
            // Verificar si ya existe
            $stmt = $conexion->prepare("SELECT * FROM comportamiento WHERE alumno = ? AND bimestre = ?");
            $stmt->bind_param("ss", $idalum, $bimestre);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Advertencia',
                                text: 'Ya hay un registro de este alumno',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        });
                      </script>";
            } else {
                // Insertar nuevo registro
                $stmt = $conexion->prepare("INSERT INTO comportamiento(alumno, bimestre, inasistenciajust, inasistenciainjust, tardanzajust, tardanzainjust, puntualidad, respeto, responsabilidad, aseo, yearacad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $idalum, $bimestre, $inasistenciajust, $inasistenciainjust, $tardanzajust, $tardanzainjust, $puntualidad, $respeto, $responsabilidad, $aseo, $yearacad);

                if ($stmt->execute()) {
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
            $stmt = $conexion->prepare("UPDATE comportamiento SET alumno = ?, bimestre = ?, inasistenciajust = ?, inasistenciainjust = ?, tardanzajust = ?, tardanzainjust = ?, puntualidad = ?, respeto = ?, responsabilidad = ?, aseo = ?, yearacad = ? WHERE idcomp = ?");
            $stmt->bind_param("sssssssssssi", $idalum, $bimestre, $inasistenciajust, $inasistenciainjust, $tardanzajust, $tardanzainjust, $puntualidad, $respeto, $responsabilidad, $aseo, $yearacad, $idcomp);

            if ($stmt->execute()) {
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
