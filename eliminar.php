<?php
/**
 * Created by PhpStorm.
 * User: JonatanLara
 * Date: 27/01/2017
 * Time: 11:51 AM
 */

$ouput = [];

if (isset($_POST['eliminar'])){
    require 'lib/config.php';
    spl_autoload_register(function ($clase){
        require_once "lib/$clase.php";
    });
    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $eliminar = $_POST['eliminar'];

    $db->preparar("SELECT nombre FROM articulo WHERE id = ?");
    $db->prep()->bind_param('i', $eliminar);
    $db->ejecutar();

    if ($db->filasAfectadas() > 0) {
        $ouput = ["estado" => "ok","msg"=>"Eliminacion Correcta"];

    }else{
        $ouput = ["estado" => "fallido","msg"=>"Hubo un error inesperado, consulta con el administrador"];
    }
    $json = json_encode($ouput);
    echo $json;
    $db->liberar();
}else{

}


?>