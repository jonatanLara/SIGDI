<?php
require 'lib/config.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$db->preparar("SELECT id,campo_d_estudio,ESNI FROM invetigadores ORDER BY invetigadores.campo_d_estudio ASC");
$db->ejecutar();
$db->prep()->bind_result($dbid,$dbcampo,$dbesni);
$conteo = 0;

?>

<!--                        ventana modal inventario -->
    <div  id="cajaModal-impresion" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="caja">
                    <div class="caja-cabecera text-center" >
                        <span>Impresión</span>
                    </div>

                    <form class="form-horizontal" method="post" action="reporteAvanzado.php" target="_blank" >
                        <input type="hidden" id="parametro">
                        <?php if(isset($_POST['investigador'])){
                            echo "esta lleno"+ $HTTP_POST_VARS['investigador'];
                        }else{
                            echo "esta vasio" + $HTTP_POST_VARS['investigador'];
                        }?>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-home"></i></span>
                            <div class="col-md-6">
                                <input type="text" name="localidad" placeholder="Localidad" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-male"></i>/<i class="fa fa-female"></i></span>
                            <div class="col-md-6">
                                <select  name="genero" class="form-control">
                                   <option name='cat' value='m'>DR.</option>
                                   <option name='cat' value='f'>DRA.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-graduation-cap"></i></span>
                            <div class="col-md-6">
                                <select  name="campo" class="form-control">
                                    <?php

                                    while($db->resultado()){
                                        $conteo++;
                                        echo "
                                               <option name='cat' value='$dbcampo'>$dbcampo</option>
                                            ";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-xs-9">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="esni" value="true"> ESNI.
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-print"></i> Imprimir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
