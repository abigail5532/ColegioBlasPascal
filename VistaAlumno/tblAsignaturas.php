<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include('../Includes/HeaderAlum.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <?php
        $query = mysqli_query($conexion, "SELECT a.nombres AS alumno_nombre, a.apellidos AS alumno_apellido, 
        asig.idasig, asig.nombre AS asignatura, au.idaula, au.seccion, 
        d.nombres AS docente_nombre, d.apellidos AS docente_apellido, 
        n.nombre AS nivel, g.nombre AS grado
        FROM alumnos a
        INNER JOIN aulas au ON a.aula = au.idaula
        INNER JOIN grados g ON au.grado = g.idgrado
        INNER JOIN niveles n ON g.nivel = n.idniv
        INNER JOIN asignar_grado_asignatura relgrado ON au.idaula = relgrado.aula
        INNER JOIN asignaturas asig ON relgrado.asignatura = asig.idasig
        INNER JOIN asignar_docente_asignatura reldoc ON relgrado.idrelgrado = reldoc.asignatura
        INNER JOIN docentes d ON reldoc.docente = d.iddoc
        WHERE a.idalum = '$id_user'");
        while($row = mysqli_fetch_assoc($query)) { ?>
        <div class="col-sm-6 col-xl-3 mt-2">
            <div class="card shadow mb-4">
                <div class="card-body d-flex flex-column align-items-center">                                
                    <img class="img-fluid" src="../Imagenes/curso.png" alt="Card image cap"/>
                    <p style="text-align: center; color: black; margin-top: 17px; margin-bottom: 0%; font-weight: 800;">
                        <?php echo $row['asignatura']; ?>
                    </p>
                    <p style="text-align: center; color: black; margin-top: 0%; margin-bottom: 0%;">
                        <?php echo $row['nivel'] . ' - ' . $row['grado'] . ' - ' . $row['seccion'];?>
                    </p>
                    <p style="text-align: center; color: black; margin-top: 0%; margin-bottom: 0%;">
                        <?php echo 'Docente: ' . $row['docente_nombre'] . ' ' . $row['docente_apellido'];?>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="misNotas.php?idasig=<?php echo $row['idasig']; ?>" class="card-link link-success" style="color: #71B600; font-weight: 600;">
                        Mis notas
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
            
<?php
include_once "../Includes/Footer.php";  // Usar el footer apropiado para los estudiantes
?>
