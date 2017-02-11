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
<!--<div class="izq">
    <div class="perfil">
        <img class="img-thumbnail" src='<?php /*echo $uImagen; */?>' alt="">
    </div>
    <div class="nombre">
        <h4 class="text-center">
            <i class="glyphicon glyphicon-user"></i>
            <?php /*echo ucwords($uNombre);*/?></h4>
    </div>
    <div class="profile-usermenu">
        <h4 class="text-center">
            <a id="accionEditar" href="#" style="text-decoration: none; color: white">
                <i class="glyphicon glyphicon-cog"></i>
                Configuración </a>
        </h4>
    </div>
</div>-->
<?php include 'modals/modalsImpresion.php' ?>
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

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="caja">
                        <div class="caja-cabecera">
                            <h3>
                                <i class="fa fa-history"></i>
                                Historial de Usuarios
                            </h3>
                        </div>
                        <div class="caja-cuerpo filterable">
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Buscar</button>
                                    <a href="reportInvestigador.php" target="_blank" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
                                    <button id="accionImpresionAvanzada" class="btn btn-default btn-xs"><input
                                            type="hidden" value="historial" id="oculto">
                                        <span class="glyphicon glyphicon-print"></span> Impresión Avanzada
                                    </button>
                                </div>
                            </div>
                            <table class="table table-cell"">
                                <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="#" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Modulo" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Descripción" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Fecha" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Hora" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Nombre" disabled></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $db->preparar("SELECT modulo,descripcion,fecha,hora,CONCAT(nombre,' ',ap) AS nombrecompleto 
FROM usuario INNER JOIN persona ON usuario.idUsuario = persona.id INNER JOIN movimientos ON movimientos.usuario_id = usuario.idUsuario ORDER BY fecha DESC,hora DESC ");
                                $db->ejecutar();
                                $db->prep()->bind_result($dbmodulo,$dbdescripcion,$dbfecha,$dbhora,$dbnombrecompleto);
                                $conteo = 0;
                                while($db->resultado()){
                                    $conteo++;
                                    echo "
                                                <tr>
                                                     <td>$conteo</td>
                                                        <td>$dbmodulo</td>
                                                        <td>$dbdescripcion</td>
                                                        <td>$dbfecha</td>
                                                        <td>$dbhora</td>
                                                        <td>$dbnombrecompleto</td>
                                                </tr>
                                            ";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require 'inc/footer.inc'; ?>
