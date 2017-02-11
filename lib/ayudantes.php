<?php

    function validarFoto($nombre, $update = false){
        if($update){
            borrarCarpetas("fotos/$nombre");
            /*$dir = "fotos/$nombre";
            $gestor = opendir($dir);
            while ( false != ($archivo = readdir($gestor)) ){
                if($archivo != '.' && $archivo != '..' && $archivo != 'Thumbs.db'){
                    unlink("$dir/$archivo");
                }
            }
            closedir($gestor);
            sleep(1);*/
        }
        global $dirSubida;
        global  $rutaSubida;
        global $error;
        $dirSubida = "fotos/$nombre/";
        $foto = $_FILES['foto'];

        $nombreFoto = $foto['name'];
        $nombreTmp = $foto['tmp_name'];
        $rutaSubida = "{$dirSubida}profile.jpg";
        $extArchivo = preg_replace('/image\//', '',$foto['type']);
        //validamos si la extencion es igual a jpg o png
        if ($extArchivo == 'jpeg' || $extArchivo == 'png'){
            if(!file_exists($dirSubida)){
                mkdir($dirSubida, 0777);
            }
            if (move_uploaded_file($nombreTmp,$rutaSubida)){
                // echo "<img class='img-responsive' src='$rutaSubida' alt=''>";
                return true;
            }else{
                trigger_error("Error: No se pudo mover el archivo, intente de nuevo",E_USER_ERROR);
            }
        }else{
            trigger_error("Error: No es un archivo de imagen valido",E_USER_ERROR);
            exit;
        }
        return $error;
    }

    function borrarCarpetas($dir){
        $gestor = opendir($dir);
        while ( false != ($archivo = readdir($gestor)) ){
            if($archivo != '.' && $archivo != '..' ){
                if( !unlink("$dir/$archivo") ){
                    borrarCarpetas("$dir/$archivo");
                }

            }
        }
        closedir($gestor);
        rmdir($dir);
        sleep(1);
    }

?>