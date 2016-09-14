<?php
require_once("assets/dompdf/dompdf_config.inc.php");
$codigohtml ='
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" href="assets/css/estilos.css">	
	<title></title>
</head>
<body>
	
	
	';
	



$codigohtml.="
<div>
	<strong> DISTRITO:  </strong> <span > $distrito   </span> 
	<strong>CABECERA:  </strong> <span > $cabe    </span>
	
	<strong> SECCION ELECTORAL:   </strong> <span > $seccion    </span>
	
	<br> <br>
	<strong>RUTA:   </strong> <span > $ruta     </span>
	<strong>RESPONSABLE: </strong><span > $respo   </span>
</div>
<br>
<table class='table' border='1'>
		
			<tr>
				<th> NOMBRE (S)  </th>
				<th>  APELLIDO PATERNO </th>
				<th> APELLIDO MATERNO  </th>	
				<th>  DOMICILIO</th>		
				<th>  CLAVE DE ELECTOR </th>
				<th>  TELÉFONO </th>
				
				
			</tr>
		
";
			

foreach ($listado as $lista) {
	$codigohtml.="<tr>
				
				<td class='domicilio'>{$lista->nombre}</td>
				<td class='domicilio'>{$lista->apellidop}</td>
				<td class='domicilio'>{$lista->apellidom}</td>
				<td class='domicilio'>{$lista->domicilio}</td>
				<td class='domicilio'>{$lista->clave_elector} </td>
				<td class='domicilio'>Casa: {$lista->telefono} Cel:  {$lista->telefon2} otro:  {$lista->telefono3} Descripcion:  {$lista->descripcion} </td>
				

			</tr>";
}




			$codigohtml.="
		
	</table>

</body>
</html>";
 // echo $codigohtml;
$dompdf=new DOMPDF();
$dompdf->load_html($codigohtml);
$dompdf->set_Paper('Letter', 'landscape');
$dompdf->render();
$dompdf->stream('Reportedistrital.pdf');




?>