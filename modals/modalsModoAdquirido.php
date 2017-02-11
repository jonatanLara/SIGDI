
<!--                        ventana modal inventario -->
<div  id="cajaModal-Modo-Adquirido" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="caja">
                    <form class="form-horizontal" method="post" action="push.php">
                        <fieldset>
                            <legend class="text-center header">Modo de Adquisición</legend>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="modo_aquirido" type="text" placeholder="Modo de Adquisición" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input  name="listInventario" type="hidden">
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