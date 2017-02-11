/**
 * Created by JonatanLara on 27/01/2017.
 */
$(function () {
    /**
     * Created by JonatanLara on 27/01/2017
     * Seccion de Login
     */
   var $boton = $('#boton'),
       $form = $('#formu'),
       $img = $('.cargador'),
       $alerta = $('.alert'),
       $alertaText = $('.alert-text');
    $boton.on('click', function () {
        var datos = $form.serialize(),
            url = 'login.php';
        $.ajax({
            type: "POST",
            url: url,
            data: datos,
            dataType: 'json',
            beforeSend: function () {
                $img.css({display:'block'});
            },
            complete: function () {
                $img.css({display:'none'});
            },
            success: function (respuesta) {
                if(respuesta.error){
                    $alerta.css({display:'block'});
                    $alertaText.html(respuesta.tipoError);
                    //$form.effect('shake',{times:2},1000);
                }else {
                    $(location).attr('href','inicio.php');
                }
            },
            error: function (e) {
                console.log(e);
            }
        })
    })

    /**
     * Created by JonatanLara on 27/01/2017.
     * seccion de logout
     */
    var $logout = $('#logout');
    $logout.on('click', function () {
        $.ajax({
            type: "POST",
            url: 'logout.php',
            dataType: 'html',
            success: function (e) {
                $(location).attr('href','index.php');
            }
        })
    })
    /**
     * Created by JonatanLara on 27/01/2017.
     * seccion de tooltip (etiquetas de ayuda)
     */
    $('[data-toggle=tooltip]').tooltip();
    /**
     * Created by JonatanLara on 27/01/2017.
     * seccion ventana Modal
     */

    $(document).on('click','#accionEliminar',function (e) {
        e.preventDefault();
        //necesito atraer el id de las filas
        var id = $(this).parent().parent().attr('data-id');
        $('.modal-content #modal-confirmar').attr('data-id',id);
        $('#cajaModal').modal('show');


    })
    /**
     * Created by JonatanLara on 27/01/2017.
     * seccion de Accion Eliminar
     */
    var $eliminar = $('#modal-confirmar');
    $eliminar.on('click', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: 'eliminar.php',
            data: 'eliminar='+id,
            dataType: 'json',
            success: function (respuesta) {
                if(respuesta.estado == 'ok'){
                    $('#cajaModal').modal('hide');
                    $('tr[data-id='+id+']').css({
                        background:'red',
                        color:'white'
                    }).slideUp();
                }else{
                    alert('Hubo un error');
                }
            },
            error : function (s) {
                console.log(s);
            }
        })
    })
    /**
     * Created by JonatanLara on 27/01/2017.
     * seccion de cerrar ventana modal
     */
    var $closeModal = $('#modal-cancelar');
    $closeModal.on('click', function () {
        $('#cajaModal').modal('hide');
    })

    /**
     * Created by JonatanLara on 27/01/2017.
     * seccion ventana Modal Modificar
     */

    $(document).on('click','#accionEditar',function (e) {
        e.preventDefault();
        //necesito atraer el id de las filas
        var id = $('#cajaModal-modificar').attr('data-id');
        //$('.modal-content').html(id);
        $('.modal-content #confirmarModificacion').attr('data-id',id);
        $('#cajaModal-modificar').modal('show');

    })
    /**
     * Created by JonatanLara on 2/02/2017.
     * seccion abrir ventanas modolaes
     */
    var $btnInvestigador =$('#accionInvestidador');
    $btnInvestigador.on('click',function () {
        $('#cajaModal-investigador').modal('show');
    })
    var $btnInventario =$('#accionInventario');
    $btnInventario.on('click',function () {
        $('#cajaModal-inventario').modal('show');
    })
    var $btnRecepcion =$('#accionRecepcionOficio');
    $btnRecepcion.on('click',function () {
        $('#cajaModal-recepcion-oficio').modal('show');
    })
    var $btnCrearOficio =$('#accionCrearOficio');// creación de oficio
    $btnCrearOficio.on('click',function () {
        $('#cajaModal-creacion-oficio').modal('show');
    })
    var $btnInventarioCat =$('#accionCategoriaInventario');
    $btnInventarioCat.on('click',function () {
        $('#cajaModal-Inventario-Cat').modal('show');
    })
    var $btnModoAdquirido =$('#accionModoAdquirido');
    $btnModoAdquirido.on('click',function () {
        $('#cajaModal-Modo-Adquirido').modal('show');
    })
    var $btnInventarioListCat =$('#accionCategorialistcar');
    $btnInventarioListCat.on('click',function () {
        $('#cajaModal-Inventario-ListCat').modal('show');
    })
    var $btnUser =$('#accionUsuario');
    $btnUser.on('click',function () {
        $('#cajaModal-usuario').modal('show');
    })
    var $btnImpresion =$('#accionImpresionAvanzada');
    $btnImpresion.on('click',function () {
        var clave = $('#oculto').attr('value');
        $('.form-horizontal #parametro').attr('value',clave);
        $('.form-horizontal #parametro').attr('name',clave);
        $('#cajaModal-impresion').modal('show');
    })
})