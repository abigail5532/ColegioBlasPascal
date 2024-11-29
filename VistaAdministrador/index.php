<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
$asignaturas = mysqli_query($conexion, "SELECT * FROM asignaturas");
$total['asignaturas'] = mysqli_num_rows($asignaturas);
$docentes = mysqli_query($conexion, "SELECT * FROM docentes");
$total['docentes'] = mysqli_num_rows($docentes);
$alumnos = mysqli_query($conexion, "SELECT * FROM alumnos");
$total['alumnos'] = mysqli_num_rows($alumnos);
$aulas = mysqli_query($conexion, "SELECT * FROM aulas");
$total['aulas'] = mysqli_num_rows($aulas);

$maxAulas = 200;

// Calcula el porcentaje
$porcentajeAulas = ($total['aulas'] / $maxAulas) * 100;
include_once "../Includes/Header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Alumnos Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #71B600;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="minicard text-xs font-weight-bold text-uppercase mb-1 text-gray-700">
                                <strong>Alumnos</strong>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-900">
                                <?php echo $total['alumnos']; ?>
                            </div>
                        </div>
                        <div class="col-auto" style="color: #71B600;">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Docentes Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #71B600;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="minicard text-xs font-weight-bold text-uppercase mb-1 text-gray-700">
                                <strong>Docentes</strong>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-900">
                                <?php echo $total['docentes']; ?>
                            </div>
                        </div>
                        <div class="col-auto" style="color: #71B600;">
                            <i class="fas fa-chalkboard-user fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Asignaturas Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #71B600;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="minicard text-xs font-weight-bold text-uppercase mb-1 text-gray-700">
                                <strong>Asignaturas</strong>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-900">
                                <?php echo $total['asignaturas']; ?>
                            </div>
                        </div>
                        <div class="col-auto" style="color: #71B600;">
                            <i class="fas fa-book-bookmark fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Aulas Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #71B600;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="minicard text-xs font-weight-bold text-uppercase mb-1 text-gray-700">
                                <strong>Aulas</strong>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-900">
                                        <?php echo round($porcentajeAulas); ?>%
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar" role="progressbar"
                                            style="background-color: #71B600; width: <?php echo round($porcentajeAulas); ?>%" aria-valuenow="<?php echo round($porcentajeAulas); ?>" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto" style="color: #71B600;">
                            <i class="fas fa-school fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Chart 1 -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header --> 
                    <div class="card-header py-3 d-flex flex-row justify-content-between">
                        <h6 class="head-table m-0 font-weight-bold">Aulas</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="color: black;">
                        <div class="chart-pie pt-1">
			                <canvas id="myPieChart"></canvas>
                        </div>
                        <p>Leyenda:</p>
                        <ul id="legendList" class="legend-list list-unstyled mt-3"></ul>
                    </div>
                </div>
            </div>
        <!-- Chart 2 -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="head-table m-0 font-weight-bold">Cantidad de alumnos por aula</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    </div> 
</div>



<!-- /.End Page Content -->
<?php
require_once "../Includes/Footer.php";
?>