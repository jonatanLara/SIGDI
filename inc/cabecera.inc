<?php
$archivo = $_SERVER['SCRIPT_NAME'];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="scss/font-awesome.min.css" />
    <link rel="stylesheet" href="scss/estilo.css">
    <link rel="stylesheet" href="scss/notificaciones.css">
    <title>Sistema de Oficios</title>

</head>
<body class="<?php if($archivo == '/portal/index.php'){
    echo 'bg';
} ?>">

<?php if( $archivo!= '/portal/index.php' and $archivo != '/portal/registrarse.php'
    and $archivo != '/portal/login.php' and $archivo != '/portal/logout.php'):?>
    <header>
            <a href="inicio.php" class="logo">
                <i class="fa fa-desktop" style="color:#8BD64E;"></i>
                <span>SIGDI</span>
            </a>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php if($_SESSION['rol'] == 'administrador'):?>
<!--                            <li><a href="editar.php" class="mas"> Editar &nbsp;<i class="glyphicon glyphicon-edit"></i></a></li>-->
                            <li><a href="oficios.php" class="mas">Oficios <i class="fa fa-address-book-o"></i></a></li>
                            <li><a href="investigadores.php" class="mas">Investigadores <i class="fa fa-address-book-o"></i></a></li>
                            <li><a href="inventario.php" class="mas">Inventario <i class="fa fa-clipboard"></i></a></li>
                            <li><a href="usuarios.php" class="mas">Usuarios <i class="fa fa-users"></i></a></li>
                            <li><a href="historial.php" class="mas">Historial <i class="fa fa-history"></i></a></li>
                            <li><a href="#" class="mas">Notificación <i class="fa fa-flag"></i></a></li>
                            <li><a href="#" class="mas">Ayuda <i class="fa fa-question"></i></a></li>
                        <?php else: ?><!--si es usuario este sera su menu-->
                            <li><a href="oficios.php" class="mas">Oficios <i class="fa fa-address-book-o"></i></a></li>
                            <li><a href="investigadores.php" class="mas">Investigadores <i class="fa fa-address-book-o"></i></a></li>
                            <li><a href="inventario.php" class="mas">Inventario <i class="fa fa-clipboard"></i></a></li>
                            <li><a href="usuarios.php" class="mas">Usuarios <i class="fa fa-users"></i></a></li>
                            <li><a href="#" class="mas">Notificación <i class="fa fa-flag"></i></a></li>
                            <li><a href="#" class="mas">Ayuda <i class="fa fa-question"></i></a></li>
                        <?php endif; ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li id="logout" ><a href="#">Cerrar Sesión &nbsp; <i class="glyphicon glyphicon-log-out mas"></i></a></li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

    </header>
    <div class="izq">
        <div class="perfil">
            <img class="img-thumbnail" src='<?php echo $uImagen; ?>' alt="">
        </div>
        <div class="nombre">
            <h4 class="text-center">
                <i class="glyphicon glyphicon-user"></i>
                <?php echo ucwords($uNombre);?></h4>
        </div>
        <div class="profile-usermenu">
            <h4 class="text-center">
                <a id="accionEditar" href="#" style="text-decoration: none; color: white">
                    <i class="glyphicon glyphicon-cog"></i>
                    Configuración </a>
            </h4>
        </div>
    </div>
    <?php include 'modals/modalsModificarPerfil.php'?>
<?php endif;?>