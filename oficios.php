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

$db->preparar("SELECT CONCAT(nombre,' ',ap) AS nombrecompleto, email, genero, cargo 
FROM usuario INNER JOIN persona ON usuario.idUsuario = persona.id INNER JOIN nivel ON nivel.id = usuario.idUsuario");
$db->ejecutar();
$db->prep()->bind_result($dbnombrecompleto,$dbemail,$dbgenero,$dbcargo);
?>
<?php require 'inc/cabecera.inc'; ?>

<div class="der">

    <?php if($_SESSION['rol'] == 'administrador'): ?>
        <?php include 'modals/modalsRecibirOficio.php' ?>
        <?php include 'modals/modalsCreacionOficio.php' ?>
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
            <div class="row">
                    <div class="col-md-12">
                        <div class="caja" >
                            <div class="">
                                <div class="btn-group " role="group">
                                        <button type="button" class="btn btn-default btn-filter" id="accionRecepcionOficio"><i class="fa fa-sticky-note-o"></i> Capturar</button>
                                        <button type="button" class="btn btn-default btn-filter" data-target="pendiente">Pendiente</button>
                                        <button type="button" class="btn btn-default btn-filter" data-target="cancelado">Cancelado</button>
                                        <button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="caja">
                        <a class="btn btn-primary" id="accionCrearOficio">
                            <i class="fa fa-fw -square -circle fa fa-plus" id="accionRecepcionOficio"></i> Nuevo Oficio</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="caja">
                        <div class="caja-cabecera">
                            <span>Oficios Capturados</span>
                        </div>
                        <div class="caja-cuerpo">
                            <table class="table table-cell">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Asunto</th>
                                    <th>Aquien Corresponda</th>
                                    <th>dirigido</th>
                                    <th>Mensaje</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conteo = 0;
                                while($db->resultado()){
                                    $conteo++;
                                    echo "
                                                <tr>
                                                     <td>$conteo</td>
                                                        <td>$dbnombrecompleto</td>
                                                        <td>$dbemail</td>
                                                        <td>$dbgenero</td>
                                                        <td>$dbcargo</td>
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
