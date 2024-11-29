<?php
include('../Includes/Connection.php');

if (isset($_GET['bimestre']) && isset($_GET['idasig'])) {
    $bimestre = intval($_GET['bimestre']);
    $idasig = intval($_GET['idasig']);
    $query = mysqli_query($conexion, "SELECT e.ideva, e.evaluacion, b.nombre AS nombre_bime 
                                      FROM evaluaciones e 
                                      INNER JOIN bimestres b ON e.bimestre = b.idbime
                                      WHERE e.bimestre = '$bimestre' AND e.idasig = '$idasig'");

    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $row['ideva'] . "</td>";
        echo "<td>" . $row['nombre_bime'] . "</td>";
        echo "<td>" . $row['evaluacion'] . "</td>";
        echo "<td>
                <a href='deleteEva.php?ideva=" . $row['ideva'] . "' class='btn' style='background-color: red; color: white;'>
                    Eliminar
                </a>
              </td>";
        echo "</tr>";
    }
}
?>
