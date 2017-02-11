<?php
session_start();
require 'lib/config.php';
require 'lib/ayudantes.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
if(!$_SESSION['idUsuario'] && !$_SESSION['nombre'] && !$_SESSION['rol']){
    header("Location: index.php");
    exit;
}
$sId = $_SESSION['idUsuario'];
date_default_timezone_set('America/Monterrey');
$fecha= date('Y-m-d');
$hora = date('H:i:s');

if(isset($_POST['investigador'])){
    $db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $nombre = $_POST['nombres']; $apellido_paterno = $_POST['apellidopaterno']; $apellido_materno = $_POST['apellidomaterno'];
    $genero = $_POST['genderRadios']; $email = $_POST['email']; $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono']; $campo_estudio = $_POST['campo_estudio']; $esni = $_POST['esni'];
    /*consultas*/
    $consulta = "INSERT INTO persona VALUES (NULL,'$nombre','$apellido_paterno','$apellido_materno','$genero','$fecha','$hora')";
    $db->preparar($consulta);
    $db->ejecutar();
    $db->liberar();

    $consulta2 = "SElECT id FROM persona ORDER BY id DESC";
    $db->preparar($consulta2);
    $db->ejecutar();
    $db->prep()->bind_result($bdid);
    $db->resultado();
    $db->liberar();

    $consulta3 = "INSERT INTO invetigadores VALUES (NULL,'$esni','$email','$direccion','$telefono','$campo_estudio','$bdid','1')";
    $db->preparar($consulta3);
    $db->ejecutar();
    $db->liberar();

    $db->preparar("INSERT INTO movimientos VALUES (NULL ,'Investigador','Agrego un investigador','$fecha','$hora','$sId','3')");
    $db->ejecutar();
    $db->liberar();
    $db->cerrar();

    header("Location: investigadores.php");
}else
    if(isset($_POST['listInventario'])){
        $db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $cat = $_POST['categoria'];
        $consulta = "INSERT INTO categoria_inventario VALUE (NULL ,'$cat')";
        $db->preparar($consulta);
        $db->ejecutar();
        $db->liberar();

        $db->preparar("INSERT INTO movimientos VALUES (NULL ,'Inventario','Agrego una nueva categoria','$fecha','$hora','$sId','4')");
        $db->ejecutar();
        $db->cerrar();
        header("Location: inventario.php");
    }
else
    if(isset($_POST['inventario'])){

            $dbnombre = $_POST['nombre'];
            $dbmarca = $_POST['marca'];
            $dbcolor = $_POST['color'];
            $dbmodelo = $_POST['modelo'];
            $dbcaracteristica = $_POST['caracteristica'];
            $dbserie = $_POST['serie'];
            $dbadquisicio = $_POST['adquisicio'];
            $dbcategoria_id = $_POST['departamento'];
            $db = new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            $consulta = "INSERT INTO articulo VALUE (NULL ,'$dbnombre','$dbmarca','$dbcolor','$dbmodelo','$dbcaracteristica','$dbserie','$dbadquisicio','$dbcategoria_id')";
            $db->preparar($consulta);
            $db->ejecutar();
            $db->liberar();

            $db->preparar("INSERT INTO movimientos VALUES (NULL ,'Inventario','Agrego un articulo','$fecha','$hora','$sId','4')");
            $db->ejecutar();
            $db->cerrar();
            header("Location: inventario.php");
           # echo $dbnombre .$dbserie .$dbadquisicio .$dbcategoria_id;
    }else
        if(isset($_POST['regristro'])){
            extract($_POST,EXTR_OVERWRITE);
            if(!file_exists("fotos")){
                mkdir("fotos", 0777);
            }
            $nombre = strtolower($nombre);//Devuelve una string con todos los caracteres alfabéticos convertidos a minúsculas.
        }

?>