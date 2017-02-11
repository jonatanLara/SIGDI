<?php
session_start();
require 'lib/errores.php';
require 'lib/config.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
if(!$_SESSION['idUsuario'] && !$_SESSION['nombre'] && !$_SESSION['rol']){
    header("Location: index.php");
    exit;
}
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
date_default_timezone_set('America/Monterrey');
$fecha = getdate();
$diaN = date('d');
$anio = date('Y');

$meses = ["Enero","Febrero","Marzo","Abril","Mayo","junio","Agosto","Octubre","Septiembre","Noviembre","Diciembre"];
$diaS = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
$dia2 = $diaS[$fecha['wday']];
$mes = $meses[$fecha['mon']-1];

$sId = $_SESSION['idUsuario'];
$db->preparar("SELECT CONCAT(nombre,' ',ap) AS nombrecompleto, imagen 
FROM usuario INNER JOIN persona ON usuario.idUsuario = persona.id INNER JOIN nivel ON nivel.id = usuario.idUsuario WHERE idUsuario  = ?");
$db->prep()->bind_param('i',$sId);
$db->ejecutar();
$db->prep()->bind_result($uNombre,$uImagen);
$db->resultado();
$db->liberar();


?>
<?php require 'inc/cabecera.inc'; ?>
<div class="der">

    <?php if($_SESSION['rol'] == 'administrador'): ?>
        <div class="cabecera-pagina">
            <h1 class="titulo-pagina">
                Administración
                <small>Bienvenido a la sección del administrador</small>
            </h1>
            <div class="fecha pull-right">
                <i class="glyphicon glyphicon-calendar"></i>
                <span><?php echo "$mes $diaN, $anio - $dia2"?></span>
            </div>
        </div>

        <div class="container-fluid">

            <?php include 'modals/modalsInventario.php' ?>
            <?php include 'modals/modalsCategoriaInventario.php' ?>
            <?php include 'modals/modalslistcat.php' ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="caja">
                        <a href="#" id="accionInventario" class="btn btn-primary">
                            <i class="fa fa-clipboard"></i> Nuevo articulo</a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <!--<button type="button" class="btn btn-success btn-filter" data-target="pagado">Pagado</button>-->
                                <button type="button" class="btn btn-default btn-filter" ><i class="fa fa-print"></i> Reporte</button>
                                <button id="accionCategorialistcar" type="button" class="btn btn-default btn-filter"><i class="fa fa-list-alt"></i> Lista de Categorias</button>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-plus-circle"></i> Categorias <i class="fa fa-chevron-down" ></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
<!--                                        <a id="accionCategoriaInventario" class="dropdown-item"> Categoria</a>-->
                                        <a class="dropdown-item" id="accionCategoriaInventario" href="#">Clasificación</a><br>
                                        <a class="dropdown-item" id="accionModoAdquirido" href="#">Modo de aquisición</a><br>
                                        <a class="dropdown-item" href="#">Oficinas responsable</a><br>
                                        <a class="dropdown-item" href="#">Responsable del bien</a><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="caja">
                        <div class="caja-cabecera">
                            <span>Inventario de articulos </span>
                        </div>
                        <div class="caja-cuerpo">
                            <table class="table table-cell">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Serie</th>
                                    <th>Fecha</th>
                                    <th>Categoria</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $db->preparar("SELECT articulo.id, nombre, serie, adquisicio, categoria FROM articulo INNER JOIN categoria_inventario ON articulo.categoria_inventario_id= categoria_inventario.id");
                                $db->ejecutar();
                                $db->prep()->bind_result($dbid,$dbnombre,$dbserie,$dbadquisicio,$dbcategoria);
                                $conteo = 0;
                                while($db->resultado()){
                                    $conteo++;
                                    echo "<tr data-id='$dbid'>
                                                <td>$conteo</td>
                                                <td>$dbnombre</td>
                                                <td>$dbserie</td>
                                                <td>$dbadquisicio</td>
                                                <td>$dbcategoria</td>
                                                <td><a id='accionEditar' class='btn btn-success acciones' href='#'
                                                data-toggle='tooltip' title='Editar'>
                                                <i class='glyphicon glyphicon-edit '></i></a></td>
                                                <td>
                                                <a id='accionEliminar' class='btn btn-danger acciones' href='#' 
                                                data-toggle='tooltip' title='Eliminar'>
                                                <i class='glyphicon glyphicon-remove'></i></a></td>
                                            </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--       ventana modal eliminar                -->
            <div id="cajaModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="row">
                            <div class="col-md-12">
                                ¿Estas seguro que deseas eliminarlo?
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button id="modal-confirmar" class="btn btn-danger pull-right">Si</button>
                            </div>
                            <div class="col-md-6">
                                <button id="modal-cancelar" class="btn btn-info">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--                        fin de ventana modal eliminar-->
        </div>
    <?php endif; ?>
</div>

<?php require 'inc/footer.inc'; ?>
