<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include('../Includes/Header.php');
$SqlEventos   = ("SELECT c.idcita, CONCAT(a.nombres, ' ', a.apellidos) AS alumno_nombre, 
c.fecha, c.horai, c.horaf, c.nomfamiliar, c.descripcion, c.estado 
FROM cita AS c JOIN alumnos AS a ON c.alumno = a.idalum 
WHERE c.docente = '$id_user' AND c.estado = 'Reservado'");
$resulEventos = mysqli_query($conexion, $SqlEventos);
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Calendario -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="head-table m-0 font-weight-bold">Horario Escolar</h6>
                </div>
                <div class="card-body" style="color: black;">  
                    <div class="container">
                        <div class="row">
                            <div id="calendar"></div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
        <!-- Formulario-->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row justify-content-between">
                    <h6 class="head-table m-0 font-weight-bold">Aulas</h6>
                </div>
                <?php
                $idaula = isset($_GET['idaula']) ? $_GET['idaula'] : '';
                $aulas = mysqli_query($conexion, "SELECT au.seccion, n.nombre AS nivel, g.nombre AS grado FROM aulas au 
                INNER JOIN grados g ON au.grado = g.idgrado INNER JOIN niveles n ON g.nivel = n.idniv WHERE au.idaula = $idaula");
                $nivel = $grado = $seccion = '';
                if ($aulas && mysqli_num_rows($aulas) > 0) {
                    $row = mysqli_fetch_assoc($aulas);
                    $nivel = $row['nivel'];
                    $grado = $row['grado'];
                    $seccion = $row['seccion'];
                }
                ?>
                <div class="card-body" style="color: black;">
                    <form id="formSecciones" method="post">
                        <div class="form-group">
                            <input type="hidden" name="idaula" id="idaula">
                            <label class="col-form-label">Aula:</label>
                            <input type="text" class="form-control" name="yearacadaula" id="yearacadaula" value="<?php echo htmlspecialchars($nivel); ?> - <?php echo htmlspecialchars($grado); ?> <?php echo htmlspecialchars($seccion); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tutor(a):</label>
                            <select class="form-control" name="tutoraula" id="tutoraula">
                                <option selected disabled> -- Seleccionar docente-- </option>
                                <?php
                                $query = mysqli_query($conexion, "SELECT * FROM docentes");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($row['iddoc'] == $aula) ? 'selected' : '';
                                    echo "<option value='" . $row['iddoc'] . "' $selected>" . $row['apellidos'] . ", " . $row['nombres'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Aforo:</label>
                            <input type="number" class="form-control" name="aforoaula" id="aforoaula" value="<?php echo $aforo; ?>">
                        </div>
                        <div class="modal-footer">
                            <a href="tblGrados.php" class="btn btn-danger">Cancelar </a>
                            <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Begin Modal -->
<div class="modal fade modalcalendar" id="modalinfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="staticBackdropLabel"><strong>Reunión con el alumno</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p class="mb-1"><strong>Fecha:</strong> <span name="fecha" class="text-wrap"></span></p>
          <p class="mb-1"><strong>Hora:</strong> <span name="hora" class="text-wrap"></span></p>
          <p class="mb-1"><strong>Alumno:</strong> <span name="alumno" class="text-wrap"></span></p>
          <p class="mb-3"><strong>Apoderado:</strong> <span name="familiar" class="text-wrap"></span></p>
          <textarea class="form-control" name="detalles" style="color: black;" rows="5" disabled></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" style="background-color: #71B600; color: white;" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->



<script src ="../js/jsCalendar/jquery-3.0.0.min.js"> </script>
<script src="../js/jsCalendar/popper.min.js"></script>
<script src="../js/jsCalendar/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jsCalendar/moment.min.js"></script>	
<script type="text/javascript" src="../js/jsCalendar/fullcalendar.min.js"></script>
<script src='../js/jsCalendar/es.js'></script>

<script type="text/javascript">
 $(document).ready(function() {
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      right: "agendaWeek"
    },

    locale: 'es',

    defaultView: "agendaWeek",
    navLinks: true, 
    editable: true,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,
    allDaySlot: false,
      
    events: [
      <?php
       while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
          {
          _id: '<?php echo $dataEvento['idcita']; ?>',
          title: 'Reunión',
          start: '<?php echo $dataEvento['fecha']; ?>T<?php echo $dataEvento['horai']; ?>',
          end: '<?php echo $dataEvento['fecha']; ?>T<?php echo $dataEvento['horaf']; ?>',
          color: '#DB48FF',
          description: '<?php echo $dataEvento['descripcion']; ?>',
          student: '<?php echo $dataEvento['alumno_nombre']; ?>',
          family: '<?php echo $dataEvento['nomfamiliar']; ?>'
          },
        <?php } ?>
    ],

    //Modal
    eventClick:function(event){
      var idEvento = event._id;
      $('input[name=idEvento').val(idEvento);
      $('span[name=alumno').text(event.student);
      $('span[name=familiar').text(event.family);
      $('span[name=fecha').text(event.start.format('DD-MM-YYYY'));
      $('span[name=hora').text(event.start.format('HH:mm') + ' - ' + event.end.format('HH:mm'));
      $('textarea[name=detalles').text(event.description);
      $("#modalinfo").modal();
    },

  });
 });
</script>

<!-- /.End Page Content -->
<?php
require_once "../Includes/FooterDoc.php";
?>