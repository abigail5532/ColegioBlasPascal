<?php
$idalum = isset($_GET['idalum']) ? $_GET['idalum'] : '';

// Inicializar variables
$nombres = '';
$apellidos = '';
$dni = '';
$genero = '';
$fecnacimiento = '';
$direccion = '';
$clave = '';
$aula = '';
$dnima = '';
$nombresma = '';
$telefonoma = '';
$dnipa = '';
$nombrespa = '';
$telefonopa = '';
$dniapod = '';
$nombresapod = '';
$telefonoapod = '';
$estado = '';

if ($idalum) {
    $stmt = $conexion->prepare("SELECT * FROM alumnos WHERE idalum = ?");
    $stmt->bind_param("i", $idalum);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    if ($data) {
        $nombres = $data['nombres'];
        $apellidos = $data['apellidos'];
        $dni = $data['dni'];
        $genero = $data['genero'];
        $fecnacimiento = $data['fecnacimiento'];
        $direccion = $data['direccion'];
        $aula = $data['aula'];
        $nombresma = $data['nombresma'];
        $dnima = $data['dnima'];
        $telefonoma = $data['telefonoma'];
        $nombrespa = $data['nombrespa'];
        $dnipa = $data['dnipa'];
        $telefonopa = $data['telefonopa'];
        $nombresapod = $data['nombresapod'];
        $dniapod = $data['dniapod'];
        $telefonoapod = $data['telefonoapod'];
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
    if (empty($_POST['nombresalum']) || empty($_POST['apellidosalum']) || empty($_POST['dnialum']) || empty($_POST['generoalum']) || empty($_POST['fecnacimientoalum']) || empty($_POST['direccionalum']) || empty($_POST['aulaalum']) || empty($_POST['estadoalum'])) {
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
        $nombres = $_POST['nombresalum'];
        $apellidos = $_POST['apellidosalum'];
        $dni = $_POST['dnialum'];
        $genero = $_POST['generoalum'];
        $fecnacimiento = $_POST['fecnacimientoalum'];
        $direccion = $_POST['direccionalum'];
        $aula = $_POST['aulaalum'];
        $estado = $_POST['estadoalum'];
        $dnima = isset($_POST['dnima']) ? $_POST['dnima'] : '';
        $nombresma = isset($_POST['nombresma']) ? $_POST['nombresma'] : '';
        $telefonoma = isset($_POST['telefonoma']) ? $_POST['telefonoma'] : '';
        $dnipa = isset($_POST['dnipa']) ? $_POST['dnipa'] : '';
        $nombrespa = isset($_POST['nombrespa']) ? $_POST['nombrespa'] : '';
        $telefonopa = isset($_POST['telefonopa']) ? $_POST['telefonopa'] : '';
        $dniapod = isset($_POST['dniapod']) ? $_POST['dniapod'] : '';
        $nombresapod = isset($_POST['nombresapod']) ? $_POST['nombresapod'] : '';
        $telefonoapod = isset($_POST['telefonoapod']) ? $_POST['telefonoapod'] : '';

        if (empty($idalum)) {
            // Verificar si ya existe
            $stmt = $conexion->prepare("SELECT * FROM alumnos WHERE dni = ?");
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Advertencia',
                                text: 'El alumno ya existe',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        });
                      </script>";
            } else {
                // Cifrar la contraseña
                $clave = password_hash($_POST['clavealum'], PASSWORD_DEFAULT);
                // Insertar nuevo
                $stmt = $conexion->prepare("INSERT INTO alumnos (nombres, apellidos, dni, genero, fecnacimiento, direccion, clave, aula, dnima, nombresma, telefonoma, dnipa, nombrespa, telefonopa, dniapod, nombresapod, telefonoapod, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssssssssssss", $nombres, $apellidos, $dni, $genero, $fecnacimiento, $direccion, $clave, $aula, $dnima, $nombresma, $telefonoma, $dnipa, $nombrespa, $telefonopa, $dniapod, $nombresapod, $telefonoapod, $estado);
                
                if ($stmt->execute()) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Alumno registrado correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'tblAlumnos.php';
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
            $sql_update = "UPDATE alumnos SET nombres = ?, apellidos = ?, dni = ?, genero = ?, fecnacimiento = ?, direccion = ?, aula = ?, dnima = ?, nombresma = ?, telefonoma = ?, dnipa = ?, nombrespa = ?, telefonopa = ?, dniapod = ?, nombresapod = ?, telefonoapod = ?, estado = ?";
            $params = [$nombres, $apellidos, $dni, $genero, $fecnacimiento, $direccion, $aula, $dnima, $nombresma, $telefonoma, $dnipa, $nombrespa, $telefonopa, $dniapod, $nombresapod, $telefonoapod, $estado];
            $types = "sssssssssssssssss";

            // Solo actualizar la contraseña si se ha ingresado una nueva
            if (!empty($_POST['clavealum'])) {
                $clave = password_hash($_POST['clavealum'], PASSWORD_DEFAULT);
                $sql_update .= ", clave = ?";
                $params[] = $clave;
                $types .= "s";
            }

            $sql_update .= " WHERE idalum = ?";
            $params[] = $idalum;
            $types .= "i";

            $stmt = $conexion->prepare($sql_update);
            $stmt->bind_param($types, ...$params);

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
                                    window.location.href = 'tblAlumnos.php';
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
