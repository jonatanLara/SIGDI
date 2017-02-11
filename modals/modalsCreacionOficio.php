<!--                        ventana modal recepcion del oficio -->
<div  id="cajaModal-creacion-oficio" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row">
                <div class="caja">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <legend class="text-center header">Crear Nuevo oficio</legend>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="fecha_entrega" type="text" placeholder="Nombre aquien va dirigido" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user"></i></span>
                                <div class="col-md-6">
                                    <input id="lname" name="fecha_establecida" type="text" placeholder="Cargo dirigido" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-text-width" ></i></span>
                                <div class="col-md-6">
                                    <textarea name="" id="" cols="53" rows="5" placeholder="Escribe el contenido del Oficio"></textarea>
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
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="fecha_entrega" type="text" placeholder="asunto" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user"></i></span>
                                <div class="col-md-6">
                                    <input id="fname" name="fecha_entrega" type="text" placeholder="area" class="form-control">
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
