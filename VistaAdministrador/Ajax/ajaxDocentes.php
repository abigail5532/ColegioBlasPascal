<?php
$iddoc = isset($_GET['iddoc']) ? $_GET['iddoc'] : '';

// Inicializar variables
$nombres = '';
$apellidos = '';
$dni = '';
$fecnacimiento = '';
$direccion = '';
$telefono = '';
$estado = '';

if ($iddoc) {
    // Obtener los datos desde la base de datos
    $stmt = $conexion->prepare("SELECT * FROM docentes WHERE iddoc = ?");
    $stmt->bind_param("i", $iddoc);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row) {
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $dni = $row['dni'];
        $fecnacimiento = $row['fecnacimiento'];
        $direccion = $row['direccion'];
        $telefono = $row['telefono'];
        $estado = $row['estado'];
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
    if (empty($_POST['nombresdoc']) || empty($_POST['apellidosdoc']) || empty($_POST['dnidoc']) || empty($_POST['fecnacimientodoc']) || empty($_POST['direcciondoc']) || empty($_POST['telefonodoc']) || empty($_POST['estadodoc'])) {
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
        $iddoc = $_POST['iddoc'];
        $nombres = $_POST['nombresdoc'];
        $apellidos = $_POST['apellidosdoc'];
        $dni = $_POST['dnidoc'];
        $fecnacimiento = $_POST['fecnacimientodoc'];
        $direccion = $_POST['direcciondoc'];
        $telefono = $_POST['telefonodoc'];
        $estado = $_POST['estadodoc'];
        
        if (empty($iddoc)) {
            // Verificar si ya existe
            $stmt = $conexion->prepare("SELECT * FROM docentes WHERE dni = ?");
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Advertencia',
                                text: 'El docente ya existe',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        });
                      </script>";
            } else {
                // Cifrar la contraseña
                $clave = password_hash($_POST['clavedoc'], PASSWORD_DEFAULT);
                // Insertar nuevo
                $stmt = $conexion->prepare("INSERT INTO docentes (nombres, apellidos, dni, fecnacimiento, direccion, telefono, clave, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $nombres, $apellidos, $dni, $fecnacimiento, $direccion, $telefono, $clave, $estado);
                
                if ($stmt->execute()) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Docente registrado correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'tblDocentes.php';
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
            $sql_update = "UPDATE docentes SET nombres = ?, apellidos = ?, dni = ?, fecnacimiento = ?, direccion = ?, telefono = ?, estado = ?";
            $params = [$nombres, $apellidos, $dni, $fecnacimiento, $direccion, $telefono, $estado];
            $types = "sssssss";
            
            // Solo actualizar la contraseña si se ha ingresado una nueva
            if (!empty($_POST['clavedoc'])) {
                $clave = password_hash($_POST['clavedoc'], PASSWORD_DEFAULT);
                $sql_update .= ", clave = ?";
                $params[] = $clave;
                $types .= "s";
            }

            $sql_update .= " WHERE iddoc = ?";
            $params[] = $iddoc;
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
                                    window.location.href = 'tblDocentes.php';
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
