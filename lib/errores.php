<?php
function miGestorErrores($errno,$errstr,$errfile,$errline){
    if (!(error_reporting()& $errno)){
        return;
    }
    switch ($errno){
        case E_USER_ERROR:
            echo "
                <div class='alert alert-danger alert-white rounded' style='margin-top:20px'>
                    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'>×</button>
                    <div class='icon'>
                        <i class='fa fa-times-circle'></i>
                    </div>
                    <strong>Error :!</strong> 
                    $errstr !
                </div>  
            ";
            break;
            exit(1);
        case E_USER_WARNING:
            echo "
            <div class='alert alerta_warning' style='margin-top:20px'>
                <a href='' class='btn btn-xs btn-warning pull-right' > do an action</a>
                <i class='glyphicon glyphicon-warning-sign'></i><strong>Error : </strong> [$errno] $errstr, este error se presentó en la linea $errline, en el
                   archivo $errfile  
            </div>
            ";
            break;
            exit;
        case E_USER_NOTICE:
            echo "
            <div class='alert alert-success alert-white rounded' style='margin-top:20px'>
                    <button type='button' data-dismiss='alert' aria-hidden='true' class='close'>×</button>
                    <div class='icon'>
                        <i class='fa fa-check'></i>
                    </div>
                    <strong>Error :!</strong> 
                    $errstr !
                </div>  
            ";
            break;
    }
}
set_error_handler('miGestorErrores');
?>