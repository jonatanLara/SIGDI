
<div  id="cajaModal-usuario" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend><i class="fa fa-user-o"></i> Nuevo Usuario </legend>
                    <div class="form-group">
                        <input name="registro" type="hidden" class="form-control"  placeholder="" >
                    </div>
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
                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-male"></i>/<i class="fa fa-female"></i></span>
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" name="genderRadios" value="male"> Maculino
                            </label>
                        </div>
                        <div class="col-md-4">
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
                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock"></i></span>
                        <div class="col-md-8">
                            <input id="direccion" name="contrasena" type="password" placeholder="Contraseña" class="form-control"">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock"></i></span>
                        <div class="col-md-8">
                            <input id="direccion" name="contrasena2" type="password" placeholder="confirmar Contraseña" class="form-control"">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-suitcase"></i></span>
                        <div class="col-md-8">
                            <input id="phone" name="cargo" type="text" placeholder="Cargo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                        <div class="col-md-8">
                            <select  name="nivel_usuario" class="form-control">
                                <option name='1' value=''>Administrador</option>
                                <option name='2' value=''>Usuario</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">

                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-picture-o"></i></span>
                        <div class="col-md-8">
                            <input name="foto" type="file" class="form-control" id="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button id="confirmarModificacion" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>

                    </fieldset>
            </form>
        </div>
    </div>
</div>