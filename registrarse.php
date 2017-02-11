<?php require 'inc/cabecera.inc'; ?>
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-centrar">
<?php
require 'lib/config.php';
require 'lib/errores.php';
require 'lib/ayudantes.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
if ((isset($_SESSION['nombre']) && isset($_SESSION['idUsuario']) && isset($_SESSION['rol'])) || isset($_COOKIE['nombre']) ){
    if (isset($_COOKIE['nombre'])){
        $_SESSION['idUsuario'] = $_COOKIE['id'];
        $_SESSION['nombre'] = $_COOKIE['nombre'];
        $_SESSION['rol'] = $_COOKIE['rol'];
    }
    header("location: inicio.php");
}

if($_POST){
    //conviertiendo array en variables
    extract($_POST,EXTR_OVERWRITE);
    if(!file_exists("fotos")){
        mkdir("fotos", 0777);
    }
    $nombre = strtolower($nombre);//Devuelve una string con todos los caracteres alfabéticos convertidos a minúsculas.


    //validar los campos
    if($nombre && $email && contrasena && $confircontrasena){ //compruebo que estos campos no esten vacios
        $db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);//inicializo mi conexion a base de datos
        $expreg = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; //expresion de correo electronico
        if(preg_match($expreg, $email)){//comparo que sea un correro electronico
            if(strlen($contrasena) > 6 ){//mi contraseña debe de ser mayor a 6 caracteres
                if($contrasena == $confircontrasena){ //compruebo que mis contraseñas coinsidan
                    $validarEmail = $db->validarDatos('email','usuarios',$email);//compruebo de la que email no exista antes en mi base de datos
                    if($validarEmail == 0){ //en caso de que no exista
                        $hasher = new PasswordHash(8, FALSE);//objeto instanciado
                        $hash = $hasher->HashPassword($contrasena);
                        $fecha = time();
                        if(validarFoto($nombre)){
                            if($db->preparar("INSERT INTO usuarios VALUES (NULL, '$nombre', '$apellido','$email',
                                                  '$hash','$cedula','$telefono','$direccion','$edad','$ciudad',
                                                  '$departamento','$codigopostal','$rutaSubida','$fecha','registrado')")){
                                $db->ejecutar();
                                trigger_error("Registro Exitoso",E_USER_NOTICE);
                                $ok = true;
                                $db->cerrar();
                            }
                        }else{
                            echo $error;
                        }
                    }else{
                        trigger_error("Error: Esta email ya está registrado, prueba con otro ",E_USER_ERROR);
                    }
                }else{
                    trigger_error("Error: Las contraseñas no coinciden ",E_USER_ERROR);
                }
            }else{
                trigger_error("Error: La contraseña tiene que ser mayor de 6 caracteres",E_USER_ERROR);
            }
        }else{
            trigger_error(" Error: Email erroneo, por favor ingresa un email valido",E_USER_ERROR);
        }
    }else{
        trigger_error(" Error: los campos no pueden estar vacios",E_USER_ERROR);
    }
}
/*$array = $db->getClientes();
/*ec "<table class='table table-cell'
        <thead>
            <tr>
                <td>id</td>
                <td>nombre</td>
                <td>apellido</td>
                <td>ciudad</td>
                <td>departamento</td>
                <td>cedula</td>
                <td>edad</td>
                <td>telefono</td>
            </tr>
            <tbody>";
foreach ($array as  $v ){
    echo "<tr>";
    foreach ($v as $v2){
        echo "<td>$v2</td>";
    }
    echo "</tr>";
}
echo "</tbody>
     </table>";*/
/*$db->preparar("SELECT nombre, apellido, ciudad From usuarios");
$db->ejecutar();
$db->prep()->bind_result($nombre,$apellido,$ciudad);
echo "<table class='table table-cell'
        <thead>
        <tr>
            <td>nombre</td>
            <td>apellido</td>
            <td>ciudad</td>
        </tr>
        <tbody>";
while($db->resultado()){
    echo "<tr>
            <td>$nombre</td>
            <td>$apellido</td>
            <td>$ciudad</td>
            </tr>";
}
echo "</tbody>
    </table>";
echo $db->validarDatos('ciudad','usuarios','Campeche');*/
?>

        </div>
     </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3>Mi portal web</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 caja col-centrar text-center">

                <?php if ($ok) :?>
                    <h2>Saludos  <?php echo $nombre?> </h2>
                    <img class="img-responsive img-rounded" src=" <?php echo $rutaSubida; ?> " alt="" width="200" height="auto">
                    <p>
                        Te has registrado perfectamente, por favor has click al botón para
                        que te loguees.
                    </p>
                    <a class="btn btn-primary" href="index.php">Ingresar</a>
                 <?php else : ?>
        <form action="" enctype="multipart/form-data" method="POST" role="form">
                    <legend>Registrate</legend>
                    <div class="form-group">
                        <input name="nombre" type="text" class="form-control" id="" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input name="apellido" type="text" class="form-control" id="" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <input name="email" type="text" class="form-control" id="" placeholder="Email">
                    </div>
                    <div class="form-group">
                       <input name="contrasena" type="password" class="form-control" id="" placeholder="Contraseña">
                   </div>
                   <div class="form-group">
                       <input name="confircontrasena" type="password" class="form-control" id="" placeholder="Confirmar Contraseña">
                   </div>
                    <div class="form-group">
                        <input name="cedula" type="text" class="form-control" id="" placeholder="Cedula">
                    </div>
                    <div class="form-group">
                        <input name="telefono" type="text" class="form-control" id="" placeholder="Telefono">
                    </div>
                    <div class="form-group">
                        <input name="direccion" type="text" class="form-control" id="" placeholder="Dirección">
                    </div>
                    <div class="form-group">
                        <input name="edad" type="text" class="form-control" id="" placeholder="Edad">
                    </div>
                    <div class="form-group">
                        <input name="ciudad" type="text" class="form-control" id="" placeholder="Ciudad">
                    </div>
                    <div class="form-group">
                        <input name="departamento" type="text" class="form-control" id="" placeholder="Departamento">
                    </div>
                    <div class="form-group">
                        <input name="codigopostal" type="text" class="form-control" id="" placeholder="Codigo Postal">
                    </div>
                    <div class="form-group">
                        <label for="">Eliga su foto de perfil</label>
                        <input name="foto" type="file" class="form-control" id="">
                    </div>
                    <button type="submit" class="btn btn-primary">Registar</button>
                    <a class="pull-right" href="index.php">Click aqui, si ya tienes una cuenta</a>
                </form>
                <?php endif; ?>
        </div>
        </div>
    </div>
<?php require 'inc/footer.inc'; ?>