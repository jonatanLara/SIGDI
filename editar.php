<?php
session_start();
require 'lib/errores.php';
require 'lib/config.php';
require 'lib/ayudantes.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
if(!$_SESSION['idUsuario'] && !$_SESSION['nombre'] && !$_SESSION['rol']){
    header("Location: index.php");
    exit;
}
if($_SESSION['rol'] == 'registrado'){
    header("Location: inicio.php");
    exit;
}
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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
    <?php if($_SESSION['rol'] == 'administrador'):?>
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
        <?php if(isset($_GET['editar'])):?>
        <div class="row">
            <div class="col-sm-12">
                <?php
                $eID = $_GET['editar'];
                $db->preparar("SELECT 
                nombre, 
                email,
                contrasena,
                telefono, 
                direccion,
                edad FROM usuarios WHERE idUsuario = ?");
                $db->prep()->bind_param('i',$eID);
                $db->ejecutar();
                $db->prep()->bind_result($editnombre,
                    $editemail, $editcontrasena,$edittelefono, $editdireccion,$editedad);
                $db->resultado();
                $db->liberar();
                ?>
                <form action="actualizar.php" enctype="multipart/form-data" method="POST" role="form">
                    <legend>Actualizar Datos</legend>
                    <div class="form-group">
                        <input name="nombre" type="hidden" class="form-control" id="" value="<?php echo $editnombre; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input name="email" type="text" class="form-control" id="" placeholder="<?php echo $editemail; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Contraseña actual:</label>
                        <input name="contrasena" type="password" class="form-control" id="" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                        <label for="">Nueva Contraseña</label>
                        <input name="confircontrasena" type="password" class="form-control" id="" placeholder="Confirmar Contraseña">
                    </div>
                    <div class="form-group">
                        <label for="">Telefono:</label>
                        <input name="telefono" type="text" class="form-control" id="" placeholder="<?php echo $edittelefono; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Edad:</label>
                        <input name="edad" type="text" class="form-control" id="" placeholder="<?php echo $editedad; ?>">
                    </div>
                    <div class="form-group">
                        <input name="id" type="hidden" class="form-control" value="<?php echo $eID; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Eliga su foto de perfil</label>
                        <input name="foto" type="file" class="form-control" id="">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>

        <?php else:  ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="caja">
                    <div class="caja-cabecera">
                        <h3>
                            <i class="glyphicon glyphicon-user"></i>
                            Edita o elimina algún usuario
                        </h3>

                        <div class="col-sm-4 pull-right">
                            <form id="busqueda" action="" method="GET">
                                <div class="input-group">
                                    <input name="busqueda" type="text" class="form-control" placeholder="Ingrese su busqueda">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">Buscar!</button>
                                      </span>
                                </div><!-- /input-group -->
                            </form>
                        </div><!-- /.col-lg-6 -->
                    <div class="caja-cuerpo">
                        <table class="table table-cell">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Cédula</th>
                                <th>Telefono</th>
                                <th>Dirrección</th>
                                <th>Edad</th>
                                <th>Ciudad</th>
                                <th>Departamento</th>
                                <th>Codigo Postal</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($_GET['busqueda']){
                                if(empty($_GET['busqueda'])){
                                    trigger_error("No pudes dejar el campo vacío de la busqueda, escribe",E_USER_ERROR);
                                    exit;
                                }

                                $consulta = "SELECT idUsuario, CONCAT(nombre,' ', apellido) AS nombrecompleto , email, cedula, telefono,
                                 direccion, edad, ciudad, departamento, codigopostal,fecha FROM usuarios WHERE nombre LIKE ";

                                $busqueda = explode(" ",$_GET['busqueda']);
                                #var_dump($busqueda);
                                for($i=0; $i < count($busqueda); $i++){
                                    if($busqueda[$i] !=''){
                                        if($i !=0){
                                            $consulta .=' OR nombre LIKE ';
                                        }
                                        $consulta .=" '%{$busqueda[$i]}%' ";
                                    }
                                }
                                $consulbusqueda = "SELECT COUNT(idUsuario) FROM usuarios WHERE nombre LIKE";
                                for($i=0; $i < count($busqueda); $i++){
                                    if($busqueda[$i] !=''){
                                        if($i !=0){
                                            $consulbusqueda .=' OR nombre LIKE ';
                                        }
                                        $consulbusqueda .=" '%{$busqueda[$i]}%' ";
                                    }
                                }
                                $db->preparar($consulbusqueda);
                                $db->ejecutar();
                                $db->prep()->bind_result($contador);
                                $db->resultado();
                                $db->liberar();
                                    $porPagina = 3; //numero de resultado por pagina
                                    $paginas = ceil($contador/$porPagina);//
                                    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;//casilla del paginador
                                    $iniciar = ($pagina-1)* $porPagina;//limit

                                $consulta .=" ORDER BY fecha LIMIT $iniciar, $porPagina";
                            }else {
                                $db->preparar("SELECT COUNT(idUsuario) FROM usuarios ");
                                $db->ejecutar();
                                $db->prep()->bind_result($contador);
                                $db->resultado();
                                $db->liberar();
                                $porPagina = 5; //numero de resultado por pagina
                                $paginas = ceil($contador/$porPagina);//
                                $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;//casilla del paginador
                                $iniciar = ($pagina-1)* $porPagina;//limit

                                $consulta = "SELECT idUsuario, CONCAT(nombre,' ', apellido) AS nombrecompleto , email, cedula, telefono,
                                 direccion, edad, ciudad, departamento, codigopostal,fecha FROM usuarios ORDER BY fecha LIMIT $iniciar,$porPagina";

                            }
                            $db->preparar($consulta);
                            $db->ejecutar();
                            $db->prep()->bind_result($dbid, $dbnombrecompleto,$dbemail,$dbcedula,$dbtelefono,$dbdireccion,$dbedad,$dbciudad
                                ,$dbdepartamento,$dbcodigopostal,$dbfecha);
                            if(isset($_GET['busqueda'])){
                                if($contador > 1){
                                    echo "<h3>$contador resultados encontrados</h3>";
                                }else{
                                    echo "<h3>$contador resultado encontrado</h3>";
                                }
                            }
                            $conteo = $iniciar;
                            while($db->resultado()){
                                $conteo++;
                                echo "
                                            <tr data-id='$dbid'>
                                                <td>$conteo</td>
                                                <td>$dbnombrecompleto</td>
                                                <td>$dbemail</td>
                                                <td>$dbcedula</td>
                                                <td>$dbtelefono</td>
                                                <td>$dbdireccion</td>
                                                <td>$dbedad</td>
                                                <td>$dbciudad</td>
                                                <td>$dbdepartamento</td>
                                                <td>$dbcodigopostal</td>
                                                <td>".date('d/m/Y',$dbfecha)."</td>
                                                <td><a id='accionEditar' class='btn btn-success acciones' href='#'
                                                data-toggle='tooltip' title='Editar'>
                                                <i class='glyphicon glyphicon-edit '></i></a></td>
                                                <td>
                                                <a id='accionEliminar' class='btn btn-danger acciones' href='#' 
                                                data-toggle='tooltip' title='Eliminar'>
                                                <i class='glyphicon glyphicon-remove'></i></a></td>
                                            </tr>
                                        ";
                            }
                            $db->liberar();
                            ?>

                            </tbody>
                        </table>
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
<!--                        ventana modal modificar -->
                        <div  id="cajaModal-modificar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form action="actualizar.php" enctype="multipart/form-data" method="POST" role="form">
                                        <legend>Actualizar Datos</legend>
                                        <div class="form-group">
                                            <input name="nombre" type="hidden" class="form-control" id="" value="<?php echo $editnombre; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email:</label>
                                            <input name="email" type="text" class="form-control" id="" placeholder="<?php echo $editemail; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña actual:</label>
                                            <input name="contrasena" type="password" class="form-control" id="" placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nueva Contraseña</label>
                                            <input name="confircontrasena" type="password" class="form-control" id="" placeholder="Confirmar Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Telefono:</label>
                                            <input name="telefono" type="text" class="form-control" id="" placeholder="<?php echo $edittelefono; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Edad:</label>
                                            <input name="edad" type="text" class="form-control" id="" placeholder="<?php echo $editedad; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input name="id" type="hidden" class="form-control" value="<?php echo $eID; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Eliga su foto de perfil</label>
                                            <input name="foto" type="file" class="form-control" id="">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </div>
<!--                        fin de ventana modal modificar-->
                        <?php
                            $anterior = ($pagina-1);
                            $siguiente = ($pagina + 1);
                            if(isset($_GET['busqueda'])){
                                $pagAnterior ="?pagina=$anterior&busqueda={$_GET['busqueda']}";
                                $pagSiguiente ="?pagina=$siguiente&busqueda={$_GET['busqueda']}";
                            }else {
                                $pagAnterior ="?pagina=$anterior";
                                $pagSiguiente ="?pagina=$siguiente";
                            }
                        ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <?php if(!($pagina<=1)) : ?>
                                <li>
                                    <a href='<?php echo "$pagAnterior" ?>' aria-label="Anterior">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php endif;?>
                                <?php
                                    if(isset($_GET['busqueda'])){
                                        if($paginas >=1){
                                            for ($x =1; $x<=$paginas; $x++){
                                                echo ($x == $pagina) ? "<li class='active'>
                                                <a href='?pagina=$x&busqueda={$_GET['busqueda']}'>$x</a>
                                                </li>":"<li>
                                                <a href='?pagina=$x&busqueda={$_GET['busqueda']}'>$x</a></li>";
                                            }
                                        }
                                    }else{
                                        if($paginas >=1){
                                            for ($x =1; $x<=$paginas; $x++){
                                                echo ($x == $pagina) ? "<li class='active'><a href='?pagina=$x'>$x</a></li>":"<li><a href='?pagina=$x'>$x</a></li>";
                                            }
                                        }
                                    }

                                ?>
                                <?php if(!($pagina>=$paginas)) : ?>
                                <li>
                                    <a href='<?php echo "$pagSiguiente" ?>' aria-label="Siguiente">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                <?php endif;?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
                <?php endif;?>
        </div>
            <?php endif; ?>
    </div>
</div>

<?php require 'inc/footer.inc'; ?>
