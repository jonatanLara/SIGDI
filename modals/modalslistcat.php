<?php
require 'lib/config.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$db->preparar("SELECT categoria FROM categoria_inventario");
$db->ejecutar();
$db->prep()->bind_result($dbcategoria);
?>
<!--                        ventana modal inventario -->
<div  id="cajaModal-Inventario-ListCat" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="caja">
                    <div class="caja-cabecera text-center" >
                        <span>Lista de Categorias</span>
                    </div>
                    <div class="caja-cuerpo col-md-6 col-centrar">
                        <table class="table table-cell">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Categoria</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conteo = 0;
                            while($db->resultado()){
                                $conteo++;
                                echo "
                                                <tr>
                                                     <td>$conteo</td>
                                                        <td>$dbcategoria</td>
                                                </tr>
                                            ";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--                        fin de ventana modal modificar-->