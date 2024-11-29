<?php
$idaula = isset($_GET['idaula']) ? $_GET['idaula'] : '';
$idgrado = isset($_GET['idgrado']) ? intval($_GET['idgrado']) : '';
$grados = mysqli_query($conexion, "SELECT g.*, n.idniv, n.nombre AS nombre_nivel 
FROM grados g 
INNER JOIN niveles n ON g.nivel = n.idniv 
WHERE g.idgrado = $idgrado" );
$resultGrado = mysqli_num_rows($grados);

if (empty($resultGrado)) {
    header("Location: tblGrados.php");
    exit();
}
$rowGrado = mysqli_fetch_assoc($grados);
$nombre_nivel = $rowGrado['nombre_nivel'];
$nombre_grado = $rowGrado['nombre'];

// Inicializar variables
$yearacad = date('Y');
$seccion = '';
$aforo = '';
$tutor = '';

if ($idaula) {
    // Preparar la consulta SQL
    $stmt = $conexion->prepare("SELECT au.idaula, au.yearacad, au.seccion, au.aforo, au.tutor, g.nombre AS grado 
        FROM aulas au 
        INNER JOIN grados g ON au.grado = g.idgrado 
        WHERE idaula = ?");
    $stmt->bind_param("i", $idaula);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        $yearacad = $data['yearacad'];
        $idgrado = $data['grado'];
        $seccion = $data['seccion'];
        $aforo = $data['aforo'];
        $tutor = $data['tutor'];
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
    if (empty($_POST['yearacadaula']) || empty($_POST['seccionaula']) || empty($_POST['aforoaula']) || empty($_POST['tutoraula'])) {
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
        $idaula = $_POST['idaula'];
        $yearacad = $_POST['yearacadaula'];
        $seccion = $_POST['seccionaula'];
        $aforo = $_POST['aforoaula'];
        $tutor = $_POST['tutoraula'];
        
        if (empty($idaula)) {
            // Verificar si ya existe
            $stmt = $conexion->prepare("SELECT * FROM aulas WHERE yearacad = ? AND grado = ? AND seccion = ?");
            $stmt->bind_param("sss", $yearacad, $idgrado, $seccion);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Advertencia',
                                text: 'La sección ya existe',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                            });
                        });
                      </script>";
            } else {
                // Insertar nuevo registro
                $stmt = $conexion->prepare("INSERT INTO aulas(grado, seccion, aforo, yearacad, tutor) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $idgrado, $seccion, $aforo, $yearacad, $tutor);

                if ($stmt->execute()) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Aula registrada correctamente',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'tblAulas.php';
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
            $stmt = $conexion->prepare("UPDATE aulas SET grado = ?, seccion = ?, aforo = ?, yearacad = ?, tutor = ? WHERE idaula = ?");
            $stmt->bind_param("sssssi", $idgrado, $seccion, $aforo, $yearacad, $tutor, $idaula);

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
                                    window.location.href = 'tblAulas.php';
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
