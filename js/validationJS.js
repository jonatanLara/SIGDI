/**
 * Created by Jonatan on 25/01/2017.
 */
function verificar(){
    var emailJS = 0;
    var passJS = 0;
    emailJS = validarcion('email_id');
    passJS = validarcion('contrasena_id');
    if (emailJS===false || passJS===false){

    }
    else{
        $("#form1").submit();
        alert("correcto");
    }
}
function validarcion(variable) {
    if (variable === 'email'){
        codigo = document.getElementById(variable).value;
        if(codigo == null || codigo.length == 0 || /^\s+$/.test(codigo) || !(/\S+@\S+\.\S+/.test(codigo))){
            //codigo a mostrar
            $("#glypcn"+variable).remove();
            $('#'+variable).parent().parent().attr("class", "form-group has-error has-feedback");
            $('#'+variable).parent().children('span').text("Este Campo es requerido").show();
            $('#'+variable).parent().append("<span id='glypcn"+variable+"' class='glyphicon glyphicon-remove form-control-feedback'></span>");
            return false;
        }else{
            $("#glypcn"+variable).remove();
            $('#'+variable).parent().parent().attr("class", "form-group has-success has-feedback");
            $('#'+variable).parent().children('span').hide();
            $('#'+variable).parent().append("<span id='glypcn"+variable+"' class='glyphicon glyphicon-ok form-control-feedback'></span>");
            return true;
        }
    }
    if (variable === 'contrasena'){
        codigo = document.getElementById(variable).value;
        if(codigo == null || codigo.length == 0 || /^\s+$/.test(codigo) || !(/\S+@\S+\.\S+/.test(codigo))){
            //codigo a mostrar
            return false;
        }else{

        }
    }
}