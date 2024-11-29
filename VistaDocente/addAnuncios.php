<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');

$idanun = isset($_GET['idanun']) ? $_GET['idanun'] : '';

if (!empty($_POST)) {
  // Verificar si los campos están vacíos
  if (empty($_POST['tituloanun'])) {
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      title: 'Error',
                      text: 'Todos los campos son obligatorios',
                      icon: 'error',
                      confirmButtonText: 'Ok'
                  });
              });
            </script>";
  } else {
      $idanun = $_POST['idanun'];
      $docente = $_POST['docenteanun'];
      $titulo = $_POST['tituloanun'];
      $fecpublicacion = $_POST['fecpublicacionanun'];
      $imagen = $_POST['imagenanun'];
      $asignaturaaula = $_POST['asignaturaaulaanun'];
      $descripcion = $_POST['descripcionanun'];
      $result = 0;

      if (empty($idanun)) {
          // Insertar nuevo
          $query_insert = mysqli_query($conexion, "INSERT INTO anuncios(docente, titulo, fecpublicacion, imagen, asignaturaaula, descripcion) 
          VALUES ('$docente', '$titulo', '$fecpublicacion', '$imagen', '$asignaturaaula', '$descripcion')");
          if ($query_insert) {
              echo "<script>
                      document.addEventListener('DOMContentLoaded', function() {
                          Swal.fire({
                              title: 'Éxito',
                              text: 'Anuncio registrado correctamente',
                              icon: 'success',
                              confirmButtonText: 'Ok'
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  window.location.href = 'tblAnuncios.php';
                              }
                          });
                      });
                    </script>";
          }else {
              echo "<script>
                      document.addEventListener('DOMContentLoaded', function() {
                          Swal.fire({
                              title: 'Error',
                              text: 'Error al registrar',
                              icon: 'error',
                              confirmButtonText: 'Ok'
                          });
                      });
                    </script>";
          }
      }
  }
  mysqli_close($conexion);
}

include('../Includes/HeaderDoc.php');
?>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="head-table m-0 font-weight-bold">Registro de Anuncios</h6>
    </div>
    <div class="card-body" style="color: black;">
      <form id="formAnuncios" method="post" class="">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="hidden" name="idanun" id="idanun">
              <input type="hidden" name="docenteanun" id="docenteanun" value="<?php echo $_SESSION["idUser"];?>">
              <label class="col-form-label">Título</label>
              <input type="text" class="form-control" name="tituloanun" id="tituloanun">
              <input type="hidden" name="fecpublicacionanun" id="fecpublicacionanun">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Imagen (Opcional)</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagenanun" name="imagenanun" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                <label class="custom-file-label" for="imagenanun">Seleccionar archivo</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
            <label class="col-form-label">Aula</label>
            <select class="form-control" name="asignaturaaulaanun" id="asignaturaaulaanun">
                <option selected disabled> -- Seleccionar asignatura - aula -- </option>
                <?php
                $query = mysqli_query($conexion, "SELECT reldoc.idreldoc, d.nombres AS docente,
                relgrado.idrelgrado, reldoc.idreldoc, au.idaula, au.seccion, asig.nombre AS asignatura,
                n.nombre AS nivel, 
                g.nombre AS grado
                FROM asignar_docente_asignatura reldoc
                INNER JOIN docentes d ON reldoc.docente = d.iddoc
                INNER JOIN asignar_grado_asignatura relgrado ON reldoc.asignatura = relgrado.idrelgrado
                INNER JOIN asignaturas asig ON relgrado.asignatura = asig.idasig
                INNER JOIN aulas au ON relgrado.aula = au.idaula
                INNER JOIN grados g ON au.grado = g.idgrado 
                INNER JOIN niveles n ON g.nivel = n.idniv WHERE reldoc.docente = '$id_user'");
                while ($row = mysqli_fetch_assoc($query)) {
                    $selected = ($row['idreldoc'] == $reldoc) ? 'selected' : '';
                    echo "<option value='" . $row['idreldoc'] . "' $selected>" . $row['asignatura'] . " || " . $row['nivel'] . " - " . $row['grado'] . " - " . $row['seccion'] . "</option>";
                }
                ?>
            </select>
        </div>


        <div class="form-group">
          <label class="col-form-label">Descripción</label>
          <textarea class="form-control" name="descripcionanun" id="editor1" rows="10" cols="100"></textarea>
          <script>
          CKEDITOR.replace('editor1');
          </script>
        </div>

        <div class="modal-footer">
          <a href="tblAnuncios.php" class="btn" style="background-color: #A833FF; color: white;">Ver Anuncios </a>
          <input type="submit" value="Guardar" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">
        </div>
      </form>
    </div>
  </div>
</div>
<script>
// Función para obtener la fecha y hora actual en formato ISO
function getCurrentDateTimeISO() {
    var now = new Date();
    var year = now.getFullYear();
    var month = ('0' + (now.getMonth() + 1)).slice(-2); // Agrega ceros a la izquierda si es necesario
    var day = ('0' + now.getDate()).slice(-2);
    var hours = ('0' + now.getHours()).slice(-2);
    var minutes = ('0' + now.getMinutes()).slice(-2);
    var datetime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
    return datetime;
}

// Función para establecer la fecha y hora actual en el campo de fecha del formulario
function setDateTimeNow() {
    var datetime = getCurrentDateTimeISO();
    document.getElementById('fecpublicacionanun').value = datetime;
}
document.addEventListener('DOMContentLoaded', function() {
    setDateTimeNow();
});
</script>

<?php
include_once "../Includes/FooterDoc.php";
?>
