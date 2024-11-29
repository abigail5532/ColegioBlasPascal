<?php
session_start();
$id_user = $_SESSION['idUser'];
require("../Includes/Connection.php");
if (!empty($_GET['idadm'])) {
    $idadm = $_GET['idadm'];
    $query_delete = mysqli_query($conexion, "DELETE FROM administradores WHERE idadm = $idadm");
    mysqli_close($conexion);
    header("Location: tblAdministradores.php");
}