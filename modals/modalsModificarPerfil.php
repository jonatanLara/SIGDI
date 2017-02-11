
<!--                        ventana modal modificar Perfil-->
<div  data-id="<?php echo $sId;?>" id="cajaModal-modificar" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="modificar.php" method="post" enctype="multipart/form-data">
                <legend>Actualizar Datos</legend>
                <div class="form-group">
                    <input name="perfil" type="hidden" class="form-control"  placeholder="" >
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <input name="email" type="text" class="form-control"  placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Contraseña actual:</label>
                    <input name="contrasena" type="password" class="form-control"  placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <label for="">Nueva Contraseña</label>
                    <input name="confircontrasena" type="password" class="form-control" id="" placeholder="Confirmar Contraseña">
                </div>
                <div class="form-group">
                    <label for="">Cargo:</label>
                    <input name="telefono" type="text" class="form-control" id="" placeholder="Cargo" value="">
                </div>
                <div class="form-group">
                    <input name="id" type="hidden" class="form-control" value="<?php echo $sId; ?>">
                </div>
                <div class="form-group">
                    <label for="">Eliga su foto de perfil</label>
                    <input name="foto" type="file" class="form-control" id="">
                </div>
                <button id="confirmarModificacion" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</div>
<!--                        fin de ventana modal modificar-->