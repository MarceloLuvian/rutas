<?php
require_once("assets/dompdf/dompdf_config.inc.php");
ini_set('max_execution_time', 228000); 
ini_set("memory_limit",'256M');
$codigohtml ='
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" href="assets/css/estilos3.css">	
	<title></title>
</head>
<body>	
	';
	



	$codigohtml.="
	<div>
		<pre>M-16                                                                                               F2</pre>
		<div align='center'>
			<h3>LISTADO NOMINAL</h3>
		</div>
		<strong> DISTRITO:  </strong> <span > $distrito   </span> 
		<strong>CABECERA:  </strong> <span > $cabe    </span>
		<strong> MUNICIPIO:   </strong> <span > $municipio    </span>
		<strong> SECCION ELECTORAL:   </strong> <span > $seccion    </span>
		<strong>RUTA:   </strong> <span > $ruta     </span>
		<br>

		<strong>RESPONSABLE: </strong><span > $respo   </span>
	</div>
	<br>
	<table class='table' border='1'>
		
		<tr>
			<th> N/C </th> 
			<th> NOMBRE (S)  </th>
			<th>  APELLIDO PATERNO </th>
			<th> APELLIDO MATERNO  </th>	
			<th>  DOMICILIO</th>		
			<th>  CLAVE DE ELECTOR </th>
			<th>  TELÉFONO </th>


		</tr>

		
		";

		$contador=1;
		$nombre = $municipio."_".$seccion."-RUTA-".$ruta.".pdf";

		foreach ($listado as $lista) {
			$telefonocel = "";
			$telefonocasa = "";
			$otro = "";

			if ($lista->telefono != "-") {
				$telefonocel = "Cel: " .$lista->telefono;
			}
			if ($lista->telefono2 != "-") {
				$telefonocasa = "Casa: " .$lista->telefono2;
			}
			if ($lista->telefono3 != "-") {
				$otro = "Otro: ".$lista->telefono3." "."Descripción: ".$lista->descripcion;
			}

			$codigohtml.="<tr>
			<td class='do'>$contador </td>
			<td class='domi'>{$lista->nombre}</td>
			<td class='domi'>{$lista->apellidop}</td>
			<td class='domi'>{$lista->apellidom}</td>
			<td class='domicil'>{$lista->domicilio}</td>
			<td class='domicili'>{$lista->clave_elector} </td>
			<td class='dom'>  $telefonocel  $telefonocasa   $otro </td>


		</tr>";
		$contador++;
	}




	$codigohtml.="

</table>

</body>
</html>";
 // echo $codigohtml;


if ($numero > 0) {
	$dompdf=new DOMPDF();
	$dompdf->load_html($codigohtml);
	$dompdf->set_Paper('Letter', 'landscape');
	$dompdf->render();
	$dompdf->stream($nombre);
}else{
	$nombre = "SIN-DATOS-".$municipio."-RUTA-".$ruta.".pdf";
	$dompdf=new DOMPDF();
	$codigohtml = " ";
	$dompdf->load_html($codigohtml);
	$dompdf->set_Paper('Letter', 'landscape');
	
	$dompdf->render();
	$dompdf->stream($nombre);
}





?>