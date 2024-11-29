<?php
// Incluir la conexión a la base de datos
include('../../Includes/Connection.php');

// Obtener el parámetro id
$idanun = isset($_GET['idanun']) ? $_GET['idanun'] : '';

if ($idanun) {
    // Verificar si la conexión a la base de datos está definida
    if (!isset($conexion)) {
        echo json_encode(["error" => "Error en la conexión a la base de datos."]);
        exit;
    }

    // Obtener los datos desde la base de datos
    $query = mysqli_query($conexion, "SELECT a.idanun, a.titulo, a.fecpublicacion, a.imagen, a.descripcion,
    reldoc.idreldoc, relgrado.idrelgrado, reldoc.idreldoc, au.idaula, au.seccion, asig.nombre AS asignatura,
    d.apellidos AS apellidos_docente, 
    d.nombres AS nombres_docente, 
    n.nombre AS nivel, 
    g.nombre AS grado
    FROM anuncios a
    INNER JOIN asignar_docente_asignatura reldoc ON a.asignaturaaula = reldoc.idreldoc
    INNER JOIN asignar_grado_asignatura relgrado ON reldoc.asignatura = relgrado.idrelgrado
    INNER JOIN docentes d ON reldoc.docente = d.iddoc
    INNER JOIN asignaturas asig ON relgrado.asignatura = asig.idasig
    INNER JOIN aulas au ON relgrado.aula = au.idaula
    INNER JOIN grados g ON au.grado = g.idgrado 
    INNER JOIN niveles n ON g.nivel = n.idniv
                        WHERE a.idanun = '$idanun'");
    if ($query) {
        $data = mysqli_fetch_assoc($query);
        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "No se encontró el anuncio."]);
        }
    } else {
        echo json_encode(["error" => "Error en la consulta."]);
    }
} else {
    echo json_encode(["error" => "No se proporcionó el ID del anuncio."]);
}

?>
