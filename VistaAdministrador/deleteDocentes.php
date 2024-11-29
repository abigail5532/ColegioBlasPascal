<?php
session_start();
$id_user = $_SESSION['idUser'];
require("../Includes/Connection.php");
if (!empty($_GET['iddoc'])) {
    $iddoc = $_GET['iddoc'];
    $query_delete = mysqli_query($conexion, "DELETE FROM docentes WHERE iddoc = $iddoc");
    mysqli_close($conexion);
    header("Location: tblDocentes.php");
}