<?php
$idasig = isset($_GET['idasig']) ? $_GET['idasig'] : '';

// Inicializar variables
$areacurricular = '';
$nombre = '';
$estado = '';

if ($idasig) {
    // Preparar la consulta SQL
    $stmt = $conexion->prepare("SELECT * FROM asignaturas WHERE idasig = ?");
    $stmt->bind_param("i", $idasig);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        $areacurricular = $data['areacurricular'];
        $nombre = $data['nombre'];
        $estado = $data['estado'];
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
    // Verificar si los campos están vacíos
    if (empty($_POST['areacurricularasig']) || empty($_POST['nombreasig']) || empty($_POST['estadoasig'])) {
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
        $idasig = $_POST['idasig'];
        $areacurricular = $_POST['areacurricularasig'];
        $nombre = $_POST['nombreasig'];
        $estado = $_POST['estadoasig'];
        
        if (empty($idasig)) {
            // Verificar si ya existe
            $stmt = $conexion->prepare("SELECT * FROM asignaturas WHERE nombre = ?");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Advertencia',
                                text: 'La asignatura ya existe',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        });
                      </script>";
            } else {
                // Insertar nuevo registro
                $stmt = $conexion->prepare("INSERT INTO asignaturas(areacurricular, nombre, estado) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $areacurricular, $nombre, $estado);

                if ($stmt->execute()) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Asignatura registrada correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'tblAsignaturas.php';
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
            $stmt = $conexion->prepare("UPDATE asignaturas SET areacurricular = ?, nombre = ?, estado = ? WHERE idasig = ?");
            $stmt->bind_param("sssi", $areacurricular, $nombre, $estado, $idasig);

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
                                    window.location.href = 'tblAsignaturas.php';
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
