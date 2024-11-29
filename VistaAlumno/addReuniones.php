<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "Ajax/guardar_cita.php";
include('../Includes/HeaderAlum.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="head-table m-0 font-weight-bold">Registro de Reuniones</h6>
        </div>
        <div class="card-body" style="color: black;">
            <form id="forcita" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="alumno" id="alumno" value="<?php echo $_SESSION["idUser"];?>">
                            <label class="col-form-label">DNI</label>
                            <input type="text" name="dni" id="dni" class="form-control" disabled required value="<?php echo $_SESSION["user"];?>">
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Alumno</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $_SESSION["apellidos"];?>, <?php echo $_SESSION["nombres"];?>" disabled>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Docente</label>
                            <input type="text" name="docente" id="docente" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Tipo de Reunión</label>
                            <select name="reunion" id="reunion" class="form-control" required>
                                <option value="Presencial">Presencial</option>
                                <option value="Virtual">Virtual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fecha</label>
                            <select class="form-control" name="fecha" id="fecha">
                                <option selected disabled> -- Seleccionar una fecha -- </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Hora</label>
                            <select class="form-control" name="hora" id="hora">
                                <option selected disabled> -- Seleccionar una hora -- </option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label">Nombre del familiar</label>
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
                    <a href="tblReuniones.php" class="btn btn-danger">Cancelar </a>
                    <button type="submit" class="btn" id="btnAccion" style="background-color: #71B600; color: white;">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // Autocompletar para el campo de docente
    $('#docente').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'buscar_docente.php',
                type: 'GET',
                data: { docente: request.term },
                success: function(data) {
                    var docentes = JSON.parse(data);
                    response($.map(docentes, function(docente) {
                        return {
                            label: docente.nombre_completo,
                            value: docente.nombre_completo,
                            iddoc: docente.iddoc
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $('#docente').val(ui.item.value);
            $('#docente').data('iddoc', ui.item.iddoc);
            cargarFechas(ui.item.iddoc, $('#reunion').val());
            return false;
        }
    });

    $('#reunion').on('change', function() {
        var iddoc = $('#docente').data('iddoc');
        if (iddoc) {
            cargarFechas(iddoc, $(this).val());
        }
        
        // Manejar el campo de link según el tipo de reunión
        if ($(this).val() === 'Virtual') {
            $('#link').prop('disabled', false);
        } else {
            $('#link').prop('disabled', true).val('');
        }
    });

    $('#fecha').on('change', function() {
        var fecha = $(this).val();
        var iddoc = $('#docente').data('iddoc');
        cargarHoras(iddoc, fecha);
    });

    function cargarFechas(iddoc, tipoReunion) {
        $.ajax({
            url: 'cargar_fechas.php',
            type: 'GET',
            data: { iddoc: iddoc, tipoReunion: tipoReunion },
            success: function(response) {
                var fechas = JSON.parse(response);
                $('#fecha').empty().append('<option selected disabled> -- Seleccionar una fecha -- </option>');
                $.each(fechas, function(index, fecha) {
                    $('#fecha').append('<option value="' + fecha + '">' + fecha + '</option>');
                });
            }
        });
    }

    function cargarHoras(iddoc, fecha) {
        $.ajax({
            url: 'cargar_horas.php',
            type: 'GET',
            data: { iddoc: iddoc, fecha: fecha },
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
include_once "../Includes/Footer.php";
?>
