
<?php

include('../Includes/Connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcita = $_POST['idcita'];
    $link = $_POST['link'];

    $query = $conexion->prepare("UPDATE cita SET link = ? WHERE idcita = ?");
    $query->bind_param('si', $link, $idcita);

    if ($query->execute()) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Cita actualizada correctamente',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then(function() {
                        window.location = 'tblCitas.php';
                    });
                });
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar la cita');
                window.location.href = 'editarCita.php?id=$idcita';
              </script>";
    }
}
?>
