<?php
session_start();
if ((isset($_SESSION['nombre']) && isset($_SESSION['idUsuario']) && isset($_SESSION['rol'])) || isset($_COOKIE['nombre']) ){
    if (isset($_COOKIE['nombre'])){
        $_SESSION['idUsuario'] = $_COOKIE['id'];
        $_SESSION['nombre'] = $_COOKIE['nombre'];
        $_SESSION['rol'] = $_COOKIE['rol'];
    }
    header("location: inicio.php"); // si existen nos redirecciona al admin
}

 require 'inc/cabecera.inc'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">

            </div>
        </div>
        <div class="row">
            <div class='alert alert-danger alert-white rounded' style='margin-top:20px; display: none'>
                <button type='button' data-dismiss='alert' aria-hidden='true' class='close'>×</button>
                <div class='icon'>
                    <i class='fa fa-times-circle'></i>
                </div>
                <strong class="alert-text"></strong>
            </div>
            <div class="col-sm-6 caja col-centrar caja-login" style="top:60px">
                <h3 style="text-align: center"> Bienvenido a mi sitio web</h3>
                <!--<form action="login.php" method="POST" role="form" > -->
                <form  id="formu" >
                    <legend style="color:#8BD64E;"><span  class="fa fa-desktop"> </span> SIGDI</legend>
                    <div class="input-group input-group-sm" >
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input name="email" type="text" class="form-control"  placeholder="Email..">
                        <span class="help-block"></span>
                    </div>
                    <br>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">
                            <i class="fa fa-unlock-alt"></i>
                        </span>
                        <input input name="contrasena" type="password" class="form-control"  placeholder="Contraseña" >
                        <span class="help-block"></span>
                    </div>
                    <br>
                    <button id="boton" type="button" class=" btn btn-primary submit-btn" >Ingresar
                        <span class="glyphicon glyphicon-log-in"> </span></button>
                    <img src="http://www.moscaoffice.com.uy/imagenes/sitio/cargador.gif" alt="" class="cargador">&nbsp;&nbsp;
                    <a class="pull-right" href="registrarse.php">Registrarse</a>
                    <label for="" class="checkbox-inline">
                        <input name="recordar" type="checkbox" value="activo"> Mantener sesión iniciada
                    </label>
                </form>
            </div>
        </div>
    </div>
<?php require 'inc/footer.inc'; ?>