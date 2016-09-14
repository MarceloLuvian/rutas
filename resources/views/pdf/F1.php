<?php
require_once("assets/dompdf/dompdf_config.inc.php");
$codigohtml ='
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" href="assets/css/estilos2.css">	
	<title></title>
</head>
<body>
	
	
	';
	

	$dis= $distrito;


$codigohtml.="
<div>
<pre>M-16                                                                                           F1</pre>
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
				<th>LOCALIDAD</th>
				<th>DISTANCIA (KMS)</th>
				<th>VIA DE COMUNICACIÓN</th>
				<th>MEDIO DE TRANSPORTE</th>
				<th>TIEMPO APROXIMADO</th>
				<th> VEHÍCULO</th>
				<th>PLACAS</th>
				<th> COSTO ($) </th>
				<th>ELECTORES</th>
				<th>META</th>
			</tr>

		";
$codigohtml.="";
$contador= 1;
 $totalcosto = 0;
$totalelectores = 0;
$totalmeta = 0;
$nombre = $municipio."_".$seccion."-RUTA-".$ruta.".pdf";
foreach ($rutas as $ruta) {

	$costo = number_format($ruta->costo);
	$electores = number_format($ruta->electores);
	$meta = number_format($ruta->meta);
	$totalcosto = $totalcosto + $ruta->costo;
	$totalelectores = $totalelectores + $ruta->electores;
	$totalmeta = $totalmeta + $ruta->meta;
	$codigohtml.="<tr>
				<td>{$ruta->localidad}</td>
				<td>{$ruta->distancia}</td>
				<td>{$ruta->via}</td>
				<td>{$ruta->medio_transporte}</td>
				<td>{$ruta->tiempo_aprox}</td>
					<td> {$ruta->vehiculo} </td>
				<td> {$ruta->placas} </td>
				<td>$ $costo</td>
				<td>{$ruta->electores}</td>
				<td>{$ruta->meta}</td>

			</tr>";

			$costo = "";
$electores = "";
$meta = "";
	$contador++;			
}

$totalcost = number_format($totalcosto);
$totalelectore = number_format($totalelectores);
$totalmet = number_format($totalmeta);

	$codigohtml.="
			<tr>
				<td> <strong> TOTAL </strong> < /td>
				<td> < /td>
				<td> < /td>
				<td> < /td>
				<td> < /td>
				<td> < /td>
				<td> < /td>
				<td> <strong>$</strong>  <strong>$totalcost </strong> < /td>
				<td> <strong>  $totalelectore </strong>< /td>
				<td> <strong>  $totalmet </strong>< /td>
			</tr>
		
	</table>
</div>


</body>
</html>";
 // echo $codigohtml;

$dompdf=new DOMPDF();
$dompdf->load_html($codigohtml);
$dompdf->set_Paper('Letter', 'landscape');
$dompdf->render();
$dompdf->stream($nombre);




?>