<?php
require 'lib/config.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$db->preparar("SELECT id, categoria FROM categoria_inventario");
$db->ejecutar();
$db->prep()->bind_result($dbid, $dbcategoria);
?>
<!--                        ventana modal inventario -->
<div  id="cajaModal-inventario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="caja">
                    <form class="form-horizontal" method="post" action="push.php">
                        <fieldset>
                            <legend class="text-center header">Articulo</legend>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="nombre" type="text" placeholder="Nombre del articulo" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="marca" type="text" placeholder="Marca" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="color" type="text" placeholder="Color" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="modelo" type="text" placeholder="Modelo" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="caracteristica" type="text" placeholder="Caracteristicas" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="lname" name="serie" type="text" placeholder="Numero de serie" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input type="date" name="adquisicio"class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <select  name="departamento" class="form-control">
                                        <?php
                                        $conteo = 0;
                                        while($db->resultado()){
                                            $conteo++;
                                            echo "
                                               <option name='cat' value='$dbid'>$dbcategoria</option>
                                            ";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input name="inventario" type="hidden">
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary ">Registrar</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--                        fin de ventana modal modificar-->