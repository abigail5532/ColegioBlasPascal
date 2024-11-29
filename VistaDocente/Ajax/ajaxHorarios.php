<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Inicializar variables
$iddocen = '';
$reunion = '';
$dia = '';
$horai = '';
$horaf = '';
$estado = '';

if ($id) {
    // Obtener los datos desde la base de datos
    $stmt = $conexion->prepare("SELECT * FROM horario WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    if ($data) {
        $iddocen = $data['iddocen'];
        $reunion = $data['reunion'];
        $dia = $data['dia'];
        $horai = $data['horai'];
        $horaf = $data['horaf'];
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
    if (empty($_POST['fechahor']) || empty($_POST['horainicialhor']) || empty($_POST['horafinalhor'])) {
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
        $id = $_POST['id'];
        $iddocen = $_POST['docentehor'];
        $reunion = $_POST['reunion'];
        $dia = $_POST['fechahor'];
        $horai = $_POST['horainicialhor'];
        $horaf = $_POST['horafinalhor'];
        $estado = $_POST['estadohor'];
        
        if (empty($id)) {
            // Insertar nuevo registro
            $stmt = $conexion->prepare("INSERT INTO horario(iddocen,reunion, dia, horai, horaf, estado) VALUES (?,?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $iddocen, $reunion, $dia, $horai, $horaf, $estado);

            if ($stmt->execute()) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Se registró correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'tblHorarios.php';
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
        }else {
            // Actualizar registro
            $stmt = $conexion->prepare("UPDATE horario SET iddocen = ?, reunion=?, dia = ?, horai = ?, horaf = ?, estado = ? WHERE id = ?");
            $stmt->bind_param("ssssssi", $iddocen, $reunion, $dia, $horai, $horaf, $estado, $id);

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
                                    window.location.href = 'tblHorarios.php';
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