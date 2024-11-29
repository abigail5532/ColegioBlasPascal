<?php
session_start();
$id_user = $_SESSION['idUser'];
include('../Includes/Connection.php');
include_once "../Includes/HeaderDoc.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <!-- Listado de anuncios -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 custom-scroll" style="margin-bottom: 15px;">
                <!-- Card Body -->
                <div class="card-body">
                    <a href="addAnuncios.php" id="btnNuevo" class="btn btn-light col-auto" type="button" style="background-color: #71B600; color: white; margin-bottom: 10px;">
                        <i class="fa-solid fa-circle-plus"></i> Agregar
                    </a>
                    <?php
                    $query = mysqli_query($conexion, "SELECT a.idanun, a.titulo, a.fecpublicacion, a.imagen, a.descripcion,
                    reldoc.idreldoc, relgrado.idrelgrado, reldoc.idreldoc, au.idaula, au.seccion, asig.nombre AS asignatura,
                    d.apellidos AS apellidos_docente, 
                    d.nombres AS nombres_docente, 
                    n.nombre AS nivel, 
                    g.nombre AS grado
                    FROM anuncios a
                    INNER JOIN asignar_docente_asignatura reldoc ON a.asignaturaaula = reldoc.idreldoc
                    INNER JOIN asignar_grado_asignatura relgrado ON reldoc.asignatura = relgrado.idrelgrado
                    INNER JOIN docentes d ON reldoc.docente = d.iddoc
                    INNER JOIN asignaturas asig ON relgrado.asignatura = asig.idasig
                    INNER JOIN aulas au ON relgrado.aula = au.idaula
                    INNER JOIN grados g ON au.grado = g.idgrado 
                    INNER JOIN niveles n ON g.nivel = n.idniv WHERE a.docente = '$id_user'
                    ORDER BY a.idanun DESC");
                    while($row = mysqli_fetch_assoc($query)) { ?>
                    <a onclick="showContent('<?php echo $row['idanun']; ?>')" class="card shadow mb-2" style="border-left: 0.25rem solid #6f42c1; text-decoration: none;" href="#">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2 text-gray-900">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        <?php echo $row['titulo']; ?>
                                    </div>
                                    <div class="mb-0 text-xs">
                                        <i class="fas fa-solid fa-calendar"></i>
                                        <?php echo $row['fecpublicacion']; ?>
                                        <br>
                                        <?php echo $row['apellidos_docente'] . ", " . $row['nombres_docente']; ?>
                                    </div>
                                </div>
                                <div class="col-auto" style="color: #6f42c1;">
                                    <img class="img-profile rounded-circle" src="../Imagenes/administrador.png" style="width: 35px;">
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Contenido del anuncio -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-body" id="anuncioContent">
                    <p>Debes seleccionar un anuncio, para que puedas ver su contenido</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function showContent(id) {
    console.log('Fetching content for ID:', id);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'Ajax/ajaxAnuncios.php?idanun=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log('Request completed with status:', xhr.status);
            if (xhr.status == 200) {
                var anuncio = JSON.parse(xhr.responseText);
                console.log('Response received:', anuncio);
                if (anuncio.error) {
                    document.getElementById('anuncioContent').innerHTML = anuncio.error;
                } else {
                    var content = `
                        <h3 class="head-table m-0 font-weight-bold">${anuncio.titulo}</h3>
                        <hr>
                        <div style="color: black;">
                            <div style="font-size: 13px; display: grid; grid-template-columns: auto auto; margin-bottom: 0%;">
                                <p><strong>Remitente:</strong> ${anuncio.apellidos_docente}, ${anuncio.nombres_docente}</p>
                                <p><strong>Fecha de Publicación:</strong> ${anuncio.fecpublicacion}</p>
                                <p><strong>Asignatura:</strong> ${anuncio.asignatura}</p>
                                <p><strong>Aula:</strong> ${anuncio.nivel} - ${anuncio.grado} - ${anuncio.seccion}</p>
                            </div>

                            <hr>
                            ${anuncio.descripcion}
                        </div>
                        ${anuncio.imagen ? `<img src="../Imagenes/${anuncio.imagen}" class="img-fluid" alt="..." style="max-height: 500px; width: 100%;">` : ''}
                        <div class="modal-footer">
                            <form action="deleteAnuncios.php?idanun=${anuncio.idanun}" method="post" class="eliminarconfirmar d-inline">
                                <button class="btn" style="background-color: red; color: white;" sstype="submit"><i class='fas fa-trash-alt'></i>  Eliminar anuncio</button>
                            </form>
                        </div>
                    `;
                    document.getElementById('anuncioContent').innerHTML = content;
                }
            } else {
                document.getElementById('anuncioContent').innerHTML = 'Error al cargar el contenido del anuncio.';
            }
        }
    };
    xhr.send();
}

</script>

<!-- /.End Page Content -->
<?php
require_once "../Includes/FooterDoc.php";
?>