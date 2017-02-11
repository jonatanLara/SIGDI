<?php
    require 'lib/PasswordHash.php';
    $contra = 'daniel123';//generado en has inciptacion
    $hasher = new PasswordHash(8,FALSE);//objeto instanciado
    $has = $hasher->HashPassword($contra);

    echo $has;
    //comprobando contraseña
    if($hasher->CheckPassword($contra,$has)){
        echo "<br>Clave correcta";
    }else{
        echo "<br>incorrecta";
    }