<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/guardar_cita.php";
include_once "../Includes/HeaderDoc.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de cita</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="forcita" method="post" action=" ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-dark font-weight-bold">Nombre y Apellido</label>
                            <input type="text" name="alumno" id="alumno" class="form-control" required>
                        </div>
                    
                

                <div class="form-group">
                    <input type="hidden" name="docente" id="docente" value="<?php echo $id_user; ?>">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Tipo de Reunión</label>
                    <select name="reunion" id="reunion" class="form-control" required>
                    <option selected > -- Seleccionar una Tipo -- </option>
                        <option value="Presencial">Presencial</option>
                        <option value="Virtual">Virtual</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Fecha:</label>
                    <select class="form-control" name="fecha" id="fecha">
                        <option selected disabled> -- Seleccionar una fecha -- </option>
                    </select>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Hora:</label>
                    <select class="form-control" name="hora" id="hora">
                        <option selected disabled> -- Seleccionar una hora -- </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Nombre del familiar:</label>
                    <input type="text" class="form-control" name="nombrefa" id="nombrefa">
                </div>

                <div class="form-group">
                    <label class="col-form-label">Detalles</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="5"></textarea>
                    <input type="hidden" name="estado" id="estado" value="Reservado">
                </div>
                </div>  
</div>
                <div class="modal-footer">        
                <a href="tblcita.php" class="btn btn-danger">Regresar</a>
                <button class="btn btn-warning-light" style="background-color: #71B600; color: white;" type="submit">Guardar</button>
</div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Autocompletar para el campo de alumno
    $('#alumno').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'buscar_estudiante.php',
                type: 'GET',
                data: { alumno: request.term },
                success: function(data) {
                    var alumnos = JSON.parse(data);
                    response($.map(alumnos, function(alumno) {
                        return {
                            label: alumno.nombre_completo,
                            value: alumno.nombre_completo,
                            idalum: alumno.idalum
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $('#alumno').val(ui.item.value);
            $('#alumno').data('idalum', ui.item.idalum);
        }
    });
    var iddocente = $('#docente').val();

    $('#reunion').on('change', function() {
        var tipoReunion = $(this).val();
        cargarFechas(iddocente, tipoReunion);
    });

    $('#fecha').on('change', function() {
        var fecha = $(this).val();
        cargarHoras(iddocente, fecha);
    });

    function cargarFechas(iddocente, tipoReunion) {
        $.ajax({
            url: 'cargar_fechas.php',
            type: 'GET',
            data: { iddoc: iddocente, tipoReunion: tipoReunion },
            success: function(response) {
                var fechas = JSON.parse(response);
                $('#fecha').empty().append('<option selected disabled> -- Seleccionar una fecha -- </option>');
                $.each(fechas, function(index, fecha) {
                    $('#fecha').append('<option value="' + fecha + '">' + fecha + '</option>');
                });
            }
        });
    }

    function cargarHoras(iddocente, fecha) {
        $.ajax({
            url: 'cargar_horas.php',
            type: 'GET',
            data: { iddoc: iddocente, fecha: fecha },
            success: function(response) {
                var horas = JSON.parse(response);
                $('#hora').empty().append('<option selected disabled> -- Seleccionar una hora -- </option>');
                $.each(horas, function(index, hora) {
                    $('#hora').append('<option value="' + hora.horai + '-' + hora.horaf + '">' + hora.horai + '-' + hora.horaf + '</option>');
                });
            }
        });
    }
});
</script>

<?php
include_once "../Includes/FooterDoc.php";
?>
