<?php
session_start();
include('../Includes/Connection.php');
include('../Includes/HeaderDoc.php');

$idalum = $_GET['idalum'];
$idasig = $_GET['idasig'];
$iddoc = $_SESSION['idUser']; // Get the iddoc from the session
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Evaluaciones -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="head-table m-0 font-weight-bold">Evaluaciones</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="color: black;">
                    <div class="form-group">
                        <select class="form-control" name="bimestre" id="bimestre" onchange="filtroEvaluaciones()">
                            <option selected disabled> -- Seleccionar bimestre -- </option>
                            <?php
                            $query = mysqli_query($conexion, "SELECT * FROM bimestres");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option value='". $row['idbime']. "'>". $row['nombre']. "</option>";
                            }
                          ?>
                        </select>
                    </div>
                    <div class="table-responsive" style="color: black;">
                        <table class="table table-bordered" id="tblEvaluaciones" width="100%" cellspacing="0" style="color: black;">
                            <thead>
                                <tr>
                                    <th>Evaluación</th>
                                    <th>Nota</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by AJAX -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Promedio</th>
                                    <th colspan="2">
                                        <span id="promedio">0</span>
                                        
                                        <button class="btn btn-success " onclick="guardarPromedio()">Guardar Promedio</button>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="modal-footer">
                    <a href="tblAsignaturas.php" class="btn btn-danger">Regresar</a>
                 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function filtroEvaluaciones() {
        var bimestre = document.getElementById('bimestre').value;
        var idalum = "<?php echo $idalum;?>";
        var idasig = "<?php echo $idasig;?>";
        var iddoc = "<?php echo $iddoc;?>";
        
        if (bimestre) {
            // AJAX call to get the evaluations for the selected bimestre
            fetch(`getEvaluaciones.php?bimestre=${bimestre}&idalum=${idalum}&idasig=${idasig}&iddoc=${iddoc}`)
              .then(response => response.json())
              .then(data => {
                    let tableBody = document.querySelector('#tblEvaluaciones tbody');
                    tableBody.innerHTML = '';
                    data.forEach(evaluacion => {
                        let row = `<tr>
                                    <td>${evaluacion.nombre}</td>
                                    <td>
                                        <input type="number" class="form-control nota" data-eva="${evaluacion.ideva}" value="${evaluacion.nota || 0}" min="0" max="20" disabled>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" onclick="editarNota(this)">Editar</button>
                                        <button class="btn btn-success" onclick="guardarNota(this, ${evaluacion.ideva})" style="display:none;">Guardar</button>
                                    </td>
                                   </tr>`;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                    calcularPromedio();
                })
              .catch(error => console.error('Error al obtener las evaluaciones:', error));
        }
    }
    
    function calcularPromedio() {
        let notas = document.querySelectorAll('.nota');
        let total = 0;
        notas.forEach(nota => {
            total += parseFloat(nota.value || 0);
        });
        let promedio = notas.length ? (total / notas.length).toFixed(2) : 0;
        document.getElementById('promedio').textContent = promedio;
    }

    function editarNota(button) {
        let row = button.closest('tr');
        let notaInput = row.querySelector('.nota');
        let guardarButton = row.querySelector('.btn-success');
        
        notaInput.disabled = false;
        button.style.display = 'none';
        guardarButton.style.display = 'inline-block';
    }

    function guardarNota(button, ideva) {
        let row = button.closest('tr');
        let notaInput = row.querySelector('.nota');
        let iddoc = "<?php echo $iddoc; ?>";
        let idalum = "<?php echo $idalum; ?>";
        let idasig = "<?php echo $idasig; ?>";
        let bimestre = document.getElementById('bimestre').value;
        let notaValue = notaInput.value;

        fetch('guardarNotas.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                iddoc: iddoc,
                idalum: idalum,
                idasig: idasig,
                bimestre: bimestre,
                ideva: ideva,
                nota: notaValue
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                notaInput.disabled = true;
                button.style.display = 'none';
                row.querySelector('.btn-primary').style.display = 'inline-block';
                calcularPromedio();
                Swal.fire({
                    title: 'Éxito',
                    text: 'Nota guardada correctamente',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al guardar la nota',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        })
        .catch(error => {
            console.error('Error al guardar la nota:', error);
            Swal.fire({
                title: 'Error',
                text: 'Error al guardar la nota',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }

    function guardarPromedio() {
        let promedio = document.getElementById('promedio').textContent;
        let iddoc = "<?php echo $iddoc; ?>";
        let idalum = "<?php echo $idalum; ?>";
        let idasig = "<?php echo $idasig; ?>";
        let bimestre = document.getElementById('bimestre').value;

        fetch('guardarPromedio.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                iddoc: iddoc,
                idalum: idalum,
                idasig: idasig,
                bimestre: bimestre,
                promedio: promedio
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                Swal.fire({
                    title: 'Éxito',
                    text: 'Promedio guardado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al guardar el promedio',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }
        })
        .catch(error => {
            console.error('Error al guardar el promedio:', error);
            Swal.fire({
                title: 'Error',
                text: 'Error al guardar el promedio',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        });
    }
</script>

<?php
include_once "../Includes/Footer.php";
?>
