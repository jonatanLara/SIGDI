<!--                        ventana modal recepcion del oficio -->
<div  id="cajaModal-recepcion-oficio" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="caja">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <legend class="text-center header">Recepción de oficio</legend>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-calendar"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="fecha_entrega" type="date" placeholder="Fecha de actual" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-calendar"></i></span>
                                <div class="col-md-6">
                                    <input id="lname" name="fecha_establecida" type="date" placeholder="Fecha establecida" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-file-text-o" ></i></span>
                                <div class="col-md-6">
                                    <input type="text" name="numero_oficio" class="form-control" placeholder="numero de oficio">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <input id="lname" name="nombre_emisor" type="text" placeholder="Nombre del emisor" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-6">
                                    <select id="departamento" name="departamento" class="form-control">
                                        <option value="1">Dirección General</option>
                                        <option value="2">Contable</option>
                                        <option value="3">Soporte Técnico</option>
                                    </select>
                                </div>
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
<!--                        fin de ventana modal recepcion del oficio-->