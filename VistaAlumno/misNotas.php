<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include('../Includes/HeaderAlum.php');

$idasig = $_GET['idasig'];
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
                    <h6 class="head-table m-0 font-weight-bold">Mis Notas</h6>
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
                                    <th>Porcentaje</th>
                                    <th>Nota</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by AJAX -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Promedio</th>
                                    <th colspan="2"><span id="promedio">0</span></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filtroEvaluaciones() {
        var bimestre = document.getElementById('bimestre').value;
        var idalum = "<?php echo $id_user;?>";
        var idasig = "<?php echo $idasig;?>";
        
        if (bimestre) {
            // AJAX call to get the evaluations for the selected bimestre
            fetch(`getEvaluaciones.php?bimestre=${bimestre}&idalum=${idalum}&idasig=${idasig}`)
              .then(response => response.json())
              .then(data => {
                    let tableBody = document.querySelector('#tblEvaluaciones tbody');
                    tableBody.innerHTML = '';
                    data.forEach(evaluacion => {
                        let row = `<tr>
                                    <td>${evaluacion.nombre}</td>
                                    <td>${evaluacion.porcentaje}%</td>
                                    <td>${evaluacion.nota !== null ? evaluacion.nota : 'N/A'}</td>
                                    
                                   </tr>`;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                })
              .catch(error => console.error('Error al obtener las evaluaciones:', error));
            
            // AJAX call to get the average for the selected bimestre
            fetch(`getPromedio.php?bimestre=${bimestre}&idalum=${idalum}&idasig=${idasig}`)
              .then(response => response.json())
              .then(data => {
                  document.getElementById('promedio').textContent = data.promedio !== null ? data.promedio : '0';
              })
              .catch(error => console.error('Error al obtener el promedio:', error));
        }
    }
</script>

<?php
include_once "../Includes/Footer.php";
?>