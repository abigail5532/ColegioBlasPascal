<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include('../Includes/HeaderDoc.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!--Tutoría-->
        <?php
        $current_year = date('Y');
        $queryaula = mysqli_query($conexion, "SELECT au.idaula, n.nombre AS nivel, 
        g.nombre AS grado, au.seccion, CONCAT(d.apellidos, ' ', d.nombres) AS tutor, au.yearacad
        FROM aulas au 
        INNER JOIN docentes d ON au.tutor = d.iddoc 
        INNER JOIN grados g ON au.grado = g.idgrado 
        INNER JOIN niveles n ON g.nivel = n.idniv 
        WHERE au.tutor = '$id_user' AND au.yearacad = '$current_year'");
        while($data = mysqli_fetch_assoc($queryaula)) { ?>
        <div class="col-sm-6 col-xl-3 mt-2">
            <div class="card shadow mb-4">
                <div class="card-body d-flex flex-column align-items-center">
                    <img class="img-fluid" src="../Imagenes/tutoria.jpg" alt="Card image cap"/>
                    <p style="text-align: center; color: black; margin-top: 17px; margin-bottom: 0%; font-weight: 800;">
                        <?php echo $data['nivel'] . ' - ' . $data['grado'] . ' ' . $data['seccion'];?>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="Tutoria.php?idaula=<?php echo $data['idaula'];?>" class="card-link link-success" style="color: #71B600; font-weight: 600;">
                        Ver mi Aula <i class="fa-regular fa-face-laugh-beam"></i> <?php echo $data['yearacad'];?>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
        <!--Asignaturas-->
        <?php
        $query = mysqli_query($conexion, "SELECT reldoc.idreldoc, d.nombres AS docente,
        relgrado.idrelgrado, reldoc.idreldoc, au.idaula, au.seccion, asig.idasig, asig.nombre AS asignatura,
        n.nombre AS nivel, g.nombre AS grado
        FROM asignar_docente_asignatura reldoc
        INNER JOIN docentes d ON reldoc.docente = d.iddoc
        INNER JOIN asignar_grado_asignatura relgrado ON reldoc.asignatura = relgrado.idrelgrado
        INNER JOIN asignaturas asig ON relgrado.asignatura = asig.idasig
        INNER JOIN aulas au ON relgrado.aula = au.idaula
        INNER JOIN grados g ON au.grado = g.idgrado 
        INNER JOIN niveles n ON g.nivel = n.idniv WHERE reldoc.docente = '$id_user'");
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
                </div>
                <div class="card-footer">
                    <a href="tblAlumnos.php?idasig=<?php echo $row['idasig']; ?>&idaula=<?php echo $row['idaula']; ?>" class="card-link link-success" style="color: #71B600; font-weight: 600;">
                        Calificar Alumnos
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php
include_once "../Includes/FooterDoc.php";
?>
