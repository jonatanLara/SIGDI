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

// fecha_a es la primera fecha
$fecha_a= "2017-01-28";

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

$db->preparar("SELECT CONCAT(nombre,' ',ap) AS nombrecompleto, email, genero, cargo, registro_fecha 
FROM usuario INNER JOIN persona ON usuario.idUsuario = persona.id INNER JOIN nivel ON nivel.id = usuario.idUsuario");
$db->ejecutar();
$db->prep()->bind_result($dbnombrecompleto,$dbemail,$dbgenero,$dbcargo,$dbregistro_fecha);

function dias_transcurridos($fecha_i,$fecha_f)
{
    $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
    $dias 	= abs($dias); $dias = floor($dias);
    return $dias;
}
$fecha_acutal = date("Y-m-d");
// Ejemplo de uso:

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
<div class="der">

    <?php if($_SESSION['rol'] == 'administrador'): ?>
    <?php include 'modals/modalsUsuario.php'?>
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
                            <button type="button" class="btn btn-default btn-filter" id="accionUsuario"><i class="fa fa-user-plus"></i> Agregar</button>
                            <button type="button" class="btn btn-default btn-filter" >Pendiente</button>
                            <button type="button" class="btn btn-default btn-filter" >Cancelado</button>
                            <button type="button" class="btn btn-default btn-filter" >Todos</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="container-fluid">
            <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover table-striped">
                                    <?php
                                    $conteo = 0;
                                    while($db->resultado()){
                                        $r = dias_transcurridos($dbregistro_fecha,$fecha_acutal);
                                    $conteo++;
                                    echo "
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href='#'><i class='-alt fa fa-2x fa-eye fa-fw'></i></a>
                                        </td>
                                        <td>
                                            <h4>
                                                <b>$dbcargo</b>
                                            </h4>
                                            <p>@JonatanLara</p>
                                        </td>
                                        <td>
                                            <img src='$uImagen' class='img-circle' width='60'>
                                        </td>
                                        <td>
                                            <h4>
                                                <b>$dbnombrecompleto</b>
                                            </h4>
                                            <a href='#'>$dbemail</a>
                                        </td>
                                        <td> $r dias</td>
                                        <td>
                                            <div class='btn-group'>
                                                <button class='btn btn-default' value='left' type='button'>
                                                    <i class='fa fa-fw s fa-remove'></i>Eliminar</button>
                                                <button class='btn btn-default' value='right' type='button'>
                                                    <i class='fa fa-share-square'></i> Enviar Datos</button>
                                            </div>
                                        </td>
                                    </tr>
                                         ";
                                    }
                                    ?>
                                  </tbody>
                                </table>
                            </div>
                        </div>

    <?php endif; ?>
</div>

<?php require 'inc/footer.inc'; ?>
