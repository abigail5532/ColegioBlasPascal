<?php
session_start();
$id_user = $_SESSION['idUser'];
require("../Includes/Connection.php");
if (!empty($_GET['ideva'])) {
    $ideva = $_GET['ideva'];
    $query_delete = mysqli_query($conexion, "DELETE FROM evaluaciones WHERE ideva = $ideva");
    mysqli_close($conexion);
    header("Location: addEvaluacion.php");
}