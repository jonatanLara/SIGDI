<?php
    session_start();
    date_default_timezone_set('America/Monterrey');


            if($_POST) {
                $fecha = date('Y/m/d');
                $hora = date('H:i');
                //arreglo para almacenar los datos y enviar por medio de json
                $ouput = [];
                require 'lib/errores.php';
                require 'lib/config.php';
                spl_autoload_register(function ($clase){
                    require_once "lib/$clase.php";
                });
                //conviertiendo array en variables
                extract($_POST, EXTR_OVERWRITE);

                $nombre = strtolower($nombre);

                /*verifico si los campos estan vacios*/
                if (empty($email) || empty($contrasena)){
                    $ouput = ["error" => true, "tipoError" => "Los campos no pueden estar vacios"];
                }
                /*if (empty($email) and empty($contrasena)){
                    trigger_error("Los campos no pueden estar vacios",E_USER_ERROR);
                    header("Refresh:5; url=index.php");
                }*/
                if ($email && $contrasena){
                    $db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    /*valido si el Email es igual al de la base de datos*/
                    $validarEmail = $db->validarDatos('email','usuario', $email);
                    $expreg = '/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                    if(preg_match($expreg, $email)){
                        if($validarEmail != 0){
                            $db->preparar("SELECT idUsuario, email, contrasena, CONCAT(nombre,' ',ap,' ',am) AS nombrecompleto, rol 
                                            FROM usuario INNER JOIN persona ON usuario.idUsuario = persona.id 
                                            INNER JOIN nivel ON nivel.id = usuario.idUsuario WHERE email = '$email'");
                            $db->ejecutar();
                            $db->prep()->bind_result( $id,$dbemail,$dbcontrasena,$dbnombrecompleto,$dbrol);
                            $db->resultado();

                            if ($email == $dbemail ){
                                $hasher = new PasswordHash(8,FALSE);//objeto instanciado
                                //comprobando contraseña
                                if($hasher->CheckPassword($contrasena,$dbcontrasena)){
                                    //creado la primera session
                                    $_SESSION['idUsuario'] = $id;
                                    $_SESSION['nombre'] = $dbnombrecompleto;
                                    $_SESSION['rol'] = $dbrol;
                                    //el tipo que recordara o durara la cookie
                                    $caduca = time()+365*24*60*60;
                                    if ($_POST['recordar'] == 'activo'){
                                        setcookie('idUsuario',$_SESSION['idUsuario'],$caduca);
                                        setcookie('nombre',$_SESSION['nombre'],$caduca);
                                        setcookie('rol',$_SESSION['rol'],$caduca);
                                    }
                                    //$ok = true;
                                    $db->liberar();
                                    $db->preparar("INSERT INTO movimientos VALUES (NULL ,'login','inicio de sesion','$fecha','$hora','$id','1')");
                                    $db->ejecutar();
                                    $db->cerrar();

                                    //es la redireccion si los datos estan correctos
                                    //header("Location: inicio.php");
                                    /*switch ($dbrol){
                                        case 'administrador':
                                            header("Location: inicio.php");
                                            break;
                                        case 'registrado':
                                            header("Location: registrados.php");
                                            break;
                                    }*/

                                }else{
                                    $ouput = ["error" => true, "tipoError" => "Esta contraseña es incorrecta"];
                                }
                            }
                        }else{
                            $ouput = ["error" => true, "tipoError" => "Este email no existe por favor ingresa otro o registrate"];
                        }
                    }else{
                        $ouput = ["error" => true, "tipoError" => "Email erroneo, por favor ingresa un email valido"];
                    }
                }
                $json = json_encode($ouput);
                echo $json;
            }
?>