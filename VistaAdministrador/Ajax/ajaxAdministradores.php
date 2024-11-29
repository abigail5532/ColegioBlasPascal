<?php
$idadm = isset($_GET['idadm']) ? $_GET['idadm'] : '';

// Inicializar variables
$nombres = '';
$apellidos = '';
$dni = '';
$telefono = '';
$clave = '';
$rol = '';
$estado = '';

if ($idadm) {
    // Obtener los datos desde la base de datos
    $stmt = $conexion->prepare("SELECT * FROM administradores WHERE idadm = ?");
    $stmt->bind_param("i", $idadm);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    if ($data) {
        $nombres = $data['nombres'];
        $apellidos = $data['apellidos'];
        $dni = $data['dni'];
        $telefono = $data['telefono'];
        $clave = $data['clave'];
        $rol = $data['rol'];
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
    if (empty($_POST['nombresadm']) || empty($_POST['apellidosadm']) || empty($_POST['dniadm']) || empty($_POST['telefonoadm'])|| empty($_POST['roladm']) || empty($_POST['estadoadm'])) {
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
        $idadm = $_POST['idadm'];
        $nombres = $_POST['nombresadm'];
        $apellidos = $_POST['apellidosadm'];
        $dni = $_POST['dniadm'];
        $telefono = $_POST['telefonoadm'];
        $rol = $_POST['roladm'];
        $estado = $_POST['estadoadm'];
        
        if (empty($idadm)) {
            // Verificar si ya existe
            $stmt = $conexion->prepare("SELECT * FROM administradores WHERE dni = ?");
            $stmt->bind_param("s", $dni);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Advertencia',
                                text: 'El administrador ya existe',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        });
                      </script>";
            } else {
                // Cifrar la contraseña
                $clave = password_hash($_POST['claveadm'], PASSWORD_DEFAULT);
                // Insertar nuevo
                $stmt = $conexion->prepare("INSERT INTO administradores (nombres, apellidos, dni, telefono, clave, rol, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $nombres, $apellidos, $dni, $telefono, $clave, $rol, $estado);
                
                if ($stmt->execute()) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Administrador registrado correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'tblAdministradores.php';
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
            $sql_update = "UPDATE administradores SET nombres = ?, apellidos = ?, dni = ?, telefono = ?, rol = ?, estado = ?";
            $params = [$nombres, $apellidos, $dni, $telefono, $rol, $estado];
            $types = "ssssss";
            
            // Solo actualizar la contraseña si se ha ingresado una nueva
            if (!empty($_POST['claveadm'])) {
                $clave = password_hash($_POST['claveadm'], PASSWORD_DEFAULT);
                $sql_update .= ", clave = ?";
                $params[] = $clave;
                $types .= "s";
            }

            $sql_update .= " WHERE idadm = ?";
            $params[] = $idadm;
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
                                    window.location.href = 'tblAdministradores.php';
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