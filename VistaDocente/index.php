<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderDoc.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <header class="masthead">
        <div class="containerfondo">
            <div class="masthead-subheading"><strong>¡Bienvenido(a) a Blas Pascal!</strong></div>                
            <div class="masthead-heading text-uppercase"><?php echo $_SESSION["nombres"];?></div>
            <a class="btn btn-xl text-uppercase"  style="background-color: #71B600; color: white;" href="tblAnuncios.php">Comenzar a explorar</a>
        </div>
    </header>
    </br>
</div>

<?php
require_once "../Includes/FooterDoc.php";
?>