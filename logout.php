<?php
session_start();
date_default_timezone_set('America/Monterrey');
$fecha = date('Y/m/d');
$hora = date('H:i');
require 'lib/config.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});

$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$caduca = time()-95365;
if (isset($_COOKIE['nombre'])){
    setcookie('id',$_SESSION['idUsuario'],$caduca);
    setcookie('nombre',$_SESSION['nombre'],$caduca);
    setcookie('rol',$_SESSION['rol'],$caduca);
}
$id = $_SESSION['idUsuario'];
echo $id;
    $db->preparar("INSERT INTO movimientos VALUES (NULL ,'logout','cierre de sesion','$fecha','$hora','$id','2')");
    $db->ejecutar();
    $db->liberar();
    $db->cerrar();

session_unset();
session_destroy();

/**/
header("Refresh:4; url=index.php");
?>
