<?php
include('../Includes/Connection.php');

if (isset($_GET['nivel'])) {
    $nivel = $_GET['nivel'];
    $query = mysqli_query($conexion, "SELECT g.*, n.idniv, n.nombre AS nombre_nivel 
                                      FROM grados g INNER JOIN niveles n ON g.nivel = n.idniv 
                                      WHERE g.nivel = '$nivel'");

    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $row['idgrado'] . "</td>";
        echo "<td>" . $row['nombre_nivel'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>
                <a href='addAulas.php?idgrado=" . $row['idgrado'] . "' class='btn' style='background-color: red; color: white;'>
                    Secciones
                </a>
              </td>";
        echo "</tr>";
    }
}
?>
