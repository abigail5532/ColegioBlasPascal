<?php
if (!empty($_POST)) {
    // Verificar si los campos están vacíos
    if (empty($_POST['codmodularinst']) || empty($_POST['ugelinst']) || empty($_POST['dreinst']) || empty($_POST['nombreinst']) || empty($_POST['ubicacioninst']) || empty($_POST['correoinst']) || empty($_POST['telefonoinst']) || empty($_POST['horarioinst'])) {
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
        $idinst = $_POST['idinst'];
        $codmodular = $_POST['codmodularinst'];
        $ugel = $_POST['ugelinst'];
        $dre = $_POST['dreinst'];
        $nombre = $_POST['nombreinst'];
        $ubicacion = $_POST['ubicacioninst'];
        $correo = $_POST['correoinst'];
        $telefono = $_POST['telefonoinst'];
        $horario = $_POST['horarioinst'];
        $result = 0;

        if (!empty($idinst)) {
            // Actualizar registro
            $sql_update = mysqli_query($conexion, "UPDATE institucion SET codmodular = '$codmodular', ugel = '$ugel', dre = '$dre', nombre = '$nombre', ubicacion = '$ubicacion', correo = '$correo', telefono = '$telefono', horario = '$horario' WHERE idinst = $idinst");
            if ($sql_update) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Registro modificado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'settings.php';
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
        }
    }
    mysqli_close($conexion);
}
?>