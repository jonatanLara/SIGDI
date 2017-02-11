<?php
include('MPDF_6_0/mpdf60/mpdf.php');
require 'lib/config.php';
spl_autoload_register(function ($clase){
    require_once "lib/$clase.php";
});
$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$db->preparar("SELECT CONCAT(nombre,' ',ap) AS nombrecompleto, genero, correo, direccion, telefono, campo_d_estudio, ESNI 
FROM persona INNER JOIN invetigadores ON persona.id = invetigadores.persona_id");
$db->ejecutar();
$db->prep()->bind_result($dbnombrecompleto,$dbgenero,$dbcorreo,$dbdireccion,$dbtelefono,$dbcampo_estudio,$dbesni);

$html = ' <header class="clearfix">
          <div id="logo">
            <img src="img/logo_coesicydet.png" width="160px">
          </div>
          <h1>Investigadores del Estado de Campeche</h1>
        </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">#</th>
            <th class="">Nombre</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Campo de estudio</th>
            <th>ESNI</th>
          </tr>
        </thead>
        <tbody>';
            $conteo = 0;
            while($db->resultado()){
                if($dbgenero == 'm'){
                    $nombredr= "Dr ".$dbnombrecompleto;
                }else{
                    $nombredr= "Dra ".$dbnombrecompleto;
                }if($dbesni =='true'){
                    $esni ="SI";
                }else{
                    $esni = "NO";
                }
                $conteo++;
                $html.= '
                <tr>
                    <td>'.$conteo.'</td>
                    <td>'.$nombredr.'</td>
                    <td>'.$dbcorreo.'</td>
                    <td>'.$dbdireccion.'</td>
                    <td>'.$dbtelefono.'</td>
                    <td>'.$dbcampo_estudio.'</td>
                    <td>'.$esni.'</td>
               </tr>
              ';
            }
        $html.='</tbody>
      </table>
    </main>  
';
$css = file_get_contents("MPDF_6_0/style.css");

#$mpdf = new mPDF('utf-8', 'A4')
$mpdf = new mPDF();
#$mpdf->SetFont('');


$mpdf->SetHTMLFooter('
						<table border="0" align="center" >
							  <tr style="color: white">
							   <td><img src="img/gob_logo.png" width="160px"></td>
							   <td>
							   	<div style="font-size: 7pt; font-style:italic;">Consejo Estatal de Investigación Científica y Desarrollo Tecnológico de Campeche</div>
					        	<br>
							    <div style="font-size: 7pt; font-style:italic;">Av. Ruiz Cortinez No. 112 - Departamento 702-B (Torre B - 7° piso) Edificio Torre de</div>
						        <div style="font-size: 7pt; font-style:italic;">Cristal - Col. Nuevo San Román - San Francisco de Campeche, Camp., 24040 México -</div>
						        <div style="font-size: 7pt; font-style:italic;">Tel. (01.981) 8131752  -  <a>Email: consejocienciacampeche@yahoo.com.mx</a></div>
						        </td>
							  </tr>
						</table>
							
		     			  ');
$mpdf->SetDisplayMode('fullpage');
$mpdf->writeHTML($css, 1);
$mpdf->writeHTML($html);
$mpdf->Output();
exit;
?>