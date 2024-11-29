<?php
session_start();
$id_user = $_SESSION['idUser'];
require("../Includes/Connection.php");
if (!empty($_GET['idasig'])) {
    $idasig = $_GET['idasig'];
    $query_delete = mysqli_query($conexion, "DELETE FROM asignaturas WHERE idasig = $idasig");
    mysqli_close($conexion);
    header("Location: tblAsignaturas.php");
}