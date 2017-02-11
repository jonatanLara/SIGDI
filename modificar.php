<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/01/2017
 * Time: 12:56 PM
 */
if($_POST) {
    //conviertiendo array en variables
    extract($_POST, EXTR_OVERWRITE);
    if (isset($_POST['id'])){
        if(validarFoto($nombre)){
            $db->preparar("UPDATE usuarios 
                          set email = ?,
                          contrasena = ?,
                          telefono = ?,
                          edad = ? WHERE idUsuario = ?
                          ");
            $db-prep()->bind_parent('',$email,$telefono,$edad,$id);

        }
    }
    else{
        echo "falso";
    }
}
?>