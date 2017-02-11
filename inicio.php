<?php
session_start();
require 'lib/errores.php';
require 'lib/config.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
/* si no existe las sesiones */
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

$db->preparar("SELECT count(*) FROM usuario");
$db->ejecutar();
$db->prep()->bind_result($dbtotalusuarios);
$db->resultado();
$db->liberar();

$db->preparar("SELECT count(*) FROM invetigadores");
$db->ejecutar();
$db->prep()->bind_result($dbtotalinvestigadores);
$db->resultado();
?>
<?php require 'inc/cabecera.inc'; ?>

    <div class="der">
<!--seccion del administrador-->
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
            <div class="row-one" style="margin-bottom: 10px">
                <div class="col-md-4 widget">
                    <div class="stats-left ">
                        <h5>Total</h5>
                        <h4>Usuarios</h4>
                    </div>
                    <div class="stats-right">
                        <label><?php echo $dbtotalusuarios?></label>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-4 widget states-mdl">
                    <div class="stats-left">
                        <h5>Total</h5>
                        <h4>Investigadores</h4>
                    </div>
                    <div class="stats-right">
                        <label><?php echo $dbtotalinvestigadores?></label>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-4 widget states-last">
                    <div class="stats-left">
                        <h5>Total</h5>
                        <h4>Oficios</h4>
                    </div>
                    <div class="stats-right">
                        <label>51</label>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="caja">
                            <div class="caja-cabecera">
                                <span>Ultimos usuarios registrados</span>
                            </div>
                            <div class="caja-cuerpo">
                                <table class="table table-cell">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Genero</th>
                                            <th>Cargo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $db->liberar();

                                        $db->preparar("SELECT CONCAT(nombre,' ',ap) AS nombrecompleto, email, genero, cargo 
    FROM usuario INNER JOIN persona ON usuario.idUsuario = persona.id INNER JOIN nivel ON nivel.id = usuario.idUsuario");
                                        $db->ejecutar();
                                        $db->prep()->bind_result($dbnombrecompleto,$dbemail,$dbgenero,$dbcargo);
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

        <?php else : ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="caja">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-fw -square -circle fa fa-plus"></i> Nuevo Oficio</a>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-filter" data-target="pagado">Pagado</button>
                                    <button type="button" class="btn btn-warning btn-filter" data-target="pendiente">Pendiente</button>
                                    <button type="button" class="btn btn-danger btn-filter" data-target="cancelado">Cancelado</button>
                                    <button type="button" class="btn btn-default btn-filter" data-target="all">Todos</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="caja">
                            <div class="caja-cabecera">
                                <span>Ultimos usuarios registrados</span>
                            </div>
                            <div class="caja-cuerpo">
                                <table class="table table-cell">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Genero</th>
                                        <th>Cargo</th>
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
