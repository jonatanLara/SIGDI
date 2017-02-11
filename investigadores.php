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

$nombredr = "";
$esni ="";

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
            <!--   ventana modal investigador   -->
            <?php include 'modals/modalsInvestigador.php' ?>
            <!--   fin de ventana modal investigador   -->
            <?php include 'modalsImpresion.php' ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="caja">
                        <a href="#" id="accionInvestidador" class="btn btn-primary" >
                            <i class="fa fa-user-plus"></i> Nuevo Investigador</a>
                        <div class="pull-right">
                            <div class="btn-group">
                                <!--<button type="button" class="btn btn-success btn-filter" data-target="pagado">Pagado</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Pendiente</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Cancelado</button>-->
                                <button type="button" class="btn btn-default btn-filter" data-target="all"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="caja">
                        <div class="caja-cabecera">
                            <span>Investigadores</span>
                        </div>
                        <div class="caja-cuerpo filterable">
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Buscar</button>
                                    <a href="reportInvestigador.php" target="_blank" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
                                    <button id="accionImpresionAvanzada" class="btn btn-default btn-xs" ><input
                                            type="hidden" value="investigador" id="oculto">
                                        <span class="glyphicon glyphicon-print"></span> Impresión Avanzada</button>
                                </div>
                            </div>
                            <table class="table table-cell">
                                <thead>
                                <tr class="filters">
                                    <th><input type="text" class="form-control" placeholder="#" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Nombre" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Dirección" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Telefono" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="Campo de estudio" disabled></th>
                                    <th><input type="text" class="form-control" placeholder="ESNI" disabled></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $db->preparar("SELECT CONCAT(nombre,' ',ap) AS nombrecompleto, genero, correo, direccion, telefono, campo_d_estudio, ESNI 
FROM persona INNER JOIN invetigadores ON persona.id = invetigadores.persona_id");
                                $db->ejecutar();
                                $db->prep()->bind_result($dbnombrecompleto,$dbgenero,$dbcorreo,$dbdireccion,$dbtelefono,$dbcampo_estudio,$dbesni);
                                $conteo = 0;
                                while($db->resultado()){
                                    if($dbgenero == 'm'){
                                        $nombredr= "Dr ".$dbnombrecompleto;
                                    }else{
                                        $nombredr= "Dra ".$dbnombrecompleto;
                                    }if($dbesni =='true'){
                                        $esni ="fa fa-check";
                                    }else{
                                        $esni = "fa fa-times";
                                    }
                                    $conteo++;
                                    echo "
                                                <tr>
                                                     <td>$conteo</td>
                                                        <td>$nombredr</td>
                                                        <td>$dbcorreo</td>
                                                        <td>$dbdireccion</td>
                                                        <td>$dbtelefono</td>
                                                        <td>$dbcampo_estudio</td>
                                                        <td><i class='$esni'></i></td>
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
