<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
$idaula = isset($_GET['idaula']) ? $_GET['idaula'] : '';
$idalum = isset($_GET['idalum']) ? $_GET['idalum'] : '';
include('../Includes/HeaderDoc.php');
include_once "Ajax/ajaxRetroalimentacion.php";

// Inicializar variables
$promedio_comportamiento = 0;
$promedio_general_areas = 0;
$promedio_general = 0;
$calificacion = '';
$bimestre2 = '';

// Verificar si se ha seleccionado un bimestre
if (isset($_POST['bimestre'])) {
    $bimestre2 = $_POST['bimestre'];
}

// Consulta de comportamiento
$querycomportamiento = mysqli_query($conexion, "SELECT c.puntualidad, 
c.respeto, c.responsabilidad, c.aseo, b.nombre AS bimestre, c.alumno,
ROUND((c.puntualidad + c.respeto + c.responsabilidad + c.aseo) / 4, 2) AS promedio_comportamiento
FROM comportamiento c
INNER JOIN bimestres b ON c.bimestre = b.idbime 
WHERE c.alumno = '$idalum' AND c.bimestre = '$bimestre2'");

if ($querycomportamiento && mysqli_num_rows($querycomportamiento) > 0) {
    $dato1 = mysqli_fetch_assoc($querycomportamiento);
    $promedio_comportamiento = $dato1['promedio_comportamiento'];
}

// Consulta de promedio de áreas para el bimestre seleccionado
$querypromedio = mysqli_query($conexion, "SELECT ROUND(SUM(p.promedio) / (SELECT COUNT(*) FROM asignar_grado_asignatura asignar WHERE asignar.aula = a.aula), 2) AS promedio_general_areas
FROM promedios p
INNER JOIN alumnos a ON p.idalumn = a.idalum 
INNER JOIN bimestres b ON p.idbime = b.idbime 
WHERE p.idalumn = '$idalum' AND p.idbime = '$bimestre2'");

if ($querypromedio && mysqli_num_rows($querypromedio) > 0) {
    $dato2 = mysqli_fetch_assoc($querypromedio);
    $promedio_general_areas = $dato2['promedio_general_areas'];
}

// Calcula el promedio general
$promedio_general = round(($promedio_comportamiento * 0.1) + ($promedio_general_areas * 0.9), 2);

// Consulta de promedio de áreas para el bimestre seleccionado
$querypromedio = mysqli_query($conexion, "SELECT ROUND(SUM(p.promedio) / (SELECT COUNT(*) FROM asignar_grado_asignatura asignar WHERE asignar.aula = a.aula), 2) AS promedio_general_areas
FROM promedios p
INNER JOIN alumnos a ON p.idalumn = a.idalum 
INNER JOIN bimestres b ON p.idbime = b.idbime 
WHERE p.idalumn = '$idalum' AND p.idbime = '$bimestre2'");

if ($querypromedio && mysqli_num_rows($querypromedio) > 0) {
    $dato2 = mysqli_fetch_assoc($querypromedio);
    $promedio_general_areas = $dato2['promedio_general_areas'];
}

// Determina la calificación alfabética
if ($promedio_general >= 18 && $promedio_general <= 20) {
    $calificacion = "AD";
} elseif ($promedio_general >= 14 && $promedio_general <= 17) {
    $calificacion = "A";
} elseif ($promedio_general >= 11 && $promedio_general <= 13) {
    $calificacion = "B";
} else {
    $calificacion = "C";
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Alumnos</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="formAlumnos" method="post" action="">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-2 mb-2" style="width: 30rem;"
                                src="../Imagenes/podio.png" alt="...">
                        </div>
                    </div>  
                    <div class="col-xl-8 col-lg-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="idbol" id="idbol" value="<?php echo $idbol; ?>">
                                    <input type="hidden" name="alumno" id="alumno" class="form-control" value="<?php echo $idalum; ?>">
                                    <label class="col-form-label">Bimestre</label>
                                    <select type="hidden" class="form-control" name="bimestre" id="bimestre" style="color: black;" onchange="this.form.submit()">
                                        <option selected disabled> Seleccionar Bimestre </option>
                                        <?php
                                        $querybimestre = mysqli_query($conexion, "SELECT * FROM bimestres");
                                        while ($row = mysqli_fetch_assoc($querybimestre)) {
                                            $selected = ($row['idbime'] == $bimestre2) ? 'selected' : '';
                                            echo "<option value='" . $row['idbime'] . "' $selected>" . $row['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Promedio de Áreas</label>
                                    <input type="text" class="form-control" name="promedioarea" id="promedioarea" value="<?php echo $promedio_general_areas; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Promedio de Conducta</label>
                                    <input type="text" class="form-control" name="comportamiento" id="comportamiento" value="<?php echo $promedio_comportamiento; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Promedio General</label>
                                    <input type="text" class="form-control" name="promediogeneral" id="promediogeneral" value="<?php echo $promedio_general; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Promedio General Alfabético</label>
                                    <input type="text" class="form-control" name="promedioalfabetico" id="promedioalfabetico"value="<?php echo $calificacion; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Apreciacion:</label>
                                    <textarea class="form-control" name="apreciacion" id="apreciacion" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="tblTutoriaAlumnos.php?idaula=<?php echo $idaula; ?>" class="btn" style="background-color: red; color: white;">Cancelar </a>
                    <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../Includes/Footer.php";
?>
