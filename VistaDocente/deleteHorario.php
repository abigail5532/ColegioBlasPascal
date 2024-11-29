<?php
session_start();
$id_user = $_SESSION['idUser'];
require("../Includes/Connection.php");
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM horario WHERE id = $id");
    mysqli_close($conexion);
    header("Location: tblHorarios.php");
}