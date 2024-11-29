<?php
session_start();
$id_user = $_SESSION['idUser'];
require("../Includes/Connection.php");
if (!empty($_GET['idanun'])) {
    $idanun = $_GET['idanun'];
    $query_delete = mysqli_query($conexion, "DELETE FROM anuncios WHERE idanun = $idanun");
    mysqli_close($conexion);
    header("Location: tblAnuncios.php");
}