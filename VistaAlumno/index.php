<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderAlum.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <header class="masthead">
        <div class="containerfondo">
            <div class="masthead-subheading"><strong>¡Bienvenido(a) a Blas Pascal!</strong></div>                
            <div class="masthead-heading text-uppercase"><?php echo $_SESSION["nombres"];?></div>
        </div>
    </header>
    </br>
</div>

<?php
require_once "../Includes/Footer.php";
?>
