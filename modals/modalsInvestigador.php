<!--                        ventana modal investigador -->
<div  id="cajaModal-investigador" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="caja">
                    <form class="form-horizontal" method="post" action="push.php">
                        <fieldset>
                            <legend class="text-center header">Investigador</legend>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="fname" name="nombres" type="text" placeholder="Nombres" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-4">
                                    <input id="lname" name="apellidopaterno" type="text" placeholder="Apellido Paterno" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <input id="lname" name="apellidomaterno" type="text" placeholder="Apellido Materno" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Genero:</label>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="genderRadios" value="male"> Maculino
                                    </label>
                                </div>
                                <div class="col-xs-2">
                                    <label class="radio-inline">
                                        <input type="radio" name="genderRadios" value="female"> Femenino
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="text" placeholder="Email " class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-home"></i></span>
                                <div class="col-md-8">
                                    <input id="direccion" name="direccion" type="text" placeholder="Dirección" class="form-control"">
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="phone" name="telefono" type="text" placeholder="Telefono" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-graduation-cap"></i></span>
                                <div class="col-md-8">
                                    <input id="campodeestudio" name="campo_estudio" type="text" placeholder="Campo de estudio" class="form-control">
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
                                <div class="col-md-8">
                                    <input id="direccion" name="investigador" type="hidden" placeholder="" class="form-control"">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--                       fin de ventana modal investigador -->
