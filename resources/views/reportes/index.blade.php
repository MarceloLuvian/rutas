@extends('layouts.app')

@section('content')


<?php ini_set('max_execution_time', 2228000); ?>
<?php ini_set("memory_limit",'256M'); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-success">			
			<div class="panel-heading" align="center"> <a href="#"><strong> REPORTES DE RUTA </strong> </a> </div>
					<div class="panel-body">					
					
					<div align="center">
					
					<form id="formularioLista2" action="{{route('/reporteDistrial')}}" method="post">
					<br>
					@if($usuario->nivel == 53)
					<select name="distritos" id="distritos" class="form-control">
				<option value="0"> SELECCIONE UN DISTRITO</option>
				<option value="1"> PANUCO</option>
				<option value="2"> TANTOYUCA</option>
				<option value="3"> TUXPAN </option>
				<option value="4"> ALAMO</option>
				<option value="5"> POZA RICA</option>
				<option value="6"> PAPANTLA </option>
				<option value="7"> MARTINEZ DE LA TORRE</option>
				<option value="8"> MISANTLA</option>
				<option value="9"> PEROTE </option>
				<option value="10">XALAPA I </option>
				<option value="11"> XALAPA II</option>
				<option value="12"> COATEPEC</option>
				<option value="13">EMILIANO ZAPATA </option>
				<option value="14"> VERACRUZ I </option>
				<option value="15"> VERACRUZ II </option>
				<option value="16"> BOCA DEL RIO</option>
				<option value="17"> MEDELLIN</option>
				<option value="18"> HUATUSCO </option>
				<option value="19">CORDOBA </option>
				<option value="20"> ORIZABA </option>
				<option value="21"> CAMERINO Z. MENDOZA</option>
				<option value="22"> ZONGOLICA</option>
				<option value="23"> COSAMALOAPAN </option>
				<option value="24"> SANTIAGO TUXTLA </option>
				<option value="25"> SAN ANDRES TUXTLA</option>
				<option value="26"> COSOLEACAQUE</option>
				<option value="27"> ACAYUCAN</option>
				<option value="28"> MINATITLAN</option>
				<option value="29"> COATZACOALCOS I </option>
				<option value="30"> COATZACOALCOS II </option>

			</select>
			@endif
					<br>

					<input type="hidden"  name="_token"  value="{{ csrf_token() }}" id="token" >
					<select class="form-control" id="municipio2">
						<option value=0 > SELECCIONE UN MUNICIPIO    </option>
						@foreach ( $municipios as $municipio)
						<option value="{{$municipio->id_municipio}}" > {{$municipio->municipio}}   </option>
					@endforeach
					</select>
					<br>
					

					<select class="form-control" name="seccion2" id="seccion2">
						
						
					</select>
					<br>
					<input type="text" id="ruta2" name="rutaselect2" class="form-control" readonly="readonly">
					<br>
					<table class="table table-hover">
									<thead>
										<tr>
											<th>RUTA</th>
											<th>RESPONSABLE </th>
											<th>SECCIÓN</th>
											<th>SELECCION</th>
										</tr>
									</thead>
									<tbody id="data2">
										<tr >

										</tr>
									</tbody>
								</table>


					<button type="submit" class="btn btn-primary">REPORTE F1</button>	
					</form>
					
						
					</div>
					<!-- </form> -->
			</div>
		</div>
	</div>
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-success">			
			<div class="panel-heading" align="center"> <a href="#"><strong> LISTADO NOMINAL DE LA RUTA </strong> </a> </div>
					<div class="panel-body">
					<div><label ><strong>La descarga dependera de su conexion a internet, puede tardar hasta 2 min.</strong></label></div>
					<form action="{{route('/reporteDistrialnominal')}}" id="formularioLista" method="post">
					<br>
						@if($usuario->nivel == 53)
					<select name="distritos2" id="distritos2" class="form-control">
				<option value="0"> SELECCIONE UN DISTRITO</option>
				<option value="1"> PANUCO</option>
				<option value="2"> TANTOYUCA</option>
				<option value="3"> TUXPAN </option>
				<option value="4"> ALAMO</option>
				<option value="5"> POZA RICA</option>
				<option value="6"> PAPANTLA </option>
				<option value="7"> MARTINEZ DE LA TORRE</option>
				<option value="8"> MISANTLA</option>
				<option value="9"> PEROTE </option>
				<option value="10">XALAPA I </option>
				<option value="11"> XALAPA II</option>
				<option value="12"> COATEPEC</option>
				<option value="13">EMILIANO ZAPATA </option>
				<option value="14"> VERACRUZ I </option>
				<option value="15"> VERACRUZ II </option>
				<option value="16"> BOCA DEL RIO</option>
				<option value="17"> MEDELLIN</option>
				<option value="18"> HUATUSCO </option>
				<option value="19">CORDOBA </option>
				<option value="20"> ORIZABA </option>
				<option value="21"> CAMERINO Z. MENDOZA</option>
				<option value="22"> ZONGOLICA</option>
				<option value="23"> COSAMALOAPAN </option>
				<option value="24"> SANTIAGO TUXTLA </option>
				<option value="25"> SAN ANDRES TUXTLA</option>
				<option value="26"> COSOLEACAQUE</option>
				<option value="27"> ACAYUCAN</option>
				<option value="28"> MINATITLAN</option>
				<option value="29"> COATZACOALCOS I </option>
				<option value="30"> COATZACOALCOS II </option>

			</select>
			@endif
					<br>
				<input type="hidden"  name="_token"  value="{{ csrf_token() }}" id="token" >
					<select class="form-control" id="municipio">
						<option value="0" > SELECCIONE UN MUNICIPIO    </option>
						@foreach ( $municipios as $municipio)
						<option value="{{$municipio->id_municipio}}" > {{$municipio->municipio}}   </option>
					@endforeach
					</select>
					<br>
					

					<select class="form-control" name="seccion" id="seccion">
						
						
					</select>
					<br>
					<input type="text" id="ruta" name="rutaselect" class="form-control" readonly="readonly">
					<br>
					<table class="table table-hover">
									<thead>
										<tr>
											<th>RUTA</th>
											<th>RESPONSABLE </th>
											<th>SECCIÓN</th>
											<th>SELECCION</th>
										</tr>
									</thead>
									<tbody id="data">
										<tr >

										</tr>
									</tbody>
								</table>

					

					<div align="center">				
					
					<button type="submit" class="btn btn-primary">REPORTE F2</button>
					</form>
					</div>
					<!-- </form> -->
			</div>
		</div>
	</div>
		<div  class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="panel panel-success">
			<div class="panel-heading" align="center"><strong>   REPORTE MUNICIPALES </strong>  </div>
					<div class="panel-body">
					<form action="{{route('/reportef3')}}" id="formulario3" method="post">
					<br>
					@if($usuario->nivel == 53)
					<select name="distritos3" id="distritos3" class="form-control">
				<option value="0"> SELECCIONE UN DISTRITO</option>
				<option value="1"> PANUCO</option>
				<option value="2"> TANTOYUCA</option>
				<option value="3"> TUXPAN </option>
				<option value="4"> ALAMO</option>
				<option value="5"> POZA RICA</option>
				<option value="6"> PAPANTLA </option>
				<option value="7"> MARTINEZ DE LA TORRE</option>
				<option value="8"> MISANTLA</option>
				<option value="9"> PEROTE </option>
				<option value="10">XALAPA I </option>
				<option value="11"> XALAPA II</option>
				<option value="12"> COATEPEC</option>
				<option value="13">EMILIANO ZAPATA </option>
				<option value="14"> VERACRUZ I </option>
				<option value="15"> VERACRUZ II </option>
				<option value="16"> BOCA DEL RIO</option>
				<option value="17"> MEDELLIN</option>
				<option value="18"> HUATUSCO </option>
				<option value="19">CORDOBA </option>
				<option value="20"> ORIZABA </option>
				<option value="21"> CAMERINO Z. MENDOZA</option>
				<option value="22"> ZONGOLICA</option>
				<option value="23"> COSAMALOAPAN </option>
				<option value="24"> SANTIAGO TUXTLA </option>
				<option value="25"> SAN ANDRES TUXTLA</option>
				<option value="26"> COSOLEACAQUE</option>
				<option value="27"> ACAYUCAN</option>
				<option value="28"> MINATITLAN</option>
				<option value="29"> COATZACOALCOS I </option>
				<option value="30"> COATZACOALCOS II </option>

			</select>
			@endif
					<br>
					<input type="hidden"  name="_token"  value="{{ csrf_token() }}" id="token" >
					<select class="form-control" name="municipio3" id="municipio3">
						<option value="0" > SELECCIONE UN MUNICIPIO    </option>
						@foreach ( $municipios as $municipio)
						<option value="{{$municipio->id_municipio}}" > {{$municipio->municipio}}   </option>
					@endforeach
					</select>
					

					
					
					<br>
					<div align="center">
					<button  type="submit" class="btn btn-primary">REPORTE F3</button>
					</div>
					</form>

					<br>
					<br>
			@if($usuario->nivel == 54)
					
					@else
			<div class="panel-heading" align="center"><strong>   REPORTE DISTRITAL </strong>  </div>
			<div class="panel-body">
					<form action="{{route('/reportef4')}}" id="formulario4" method="post">
					<br>
					

					@if($usuario->nivel == 53)
					<select name="distritos4" id="distritos4" class="form-control">
				<option value="0"> SELECCIONE UN DISTRITO</option>
				<option value="1"> PANUCO</option>
				<option value="2"> TANTOYUCA</option>
				<option value="3"> TUXPAN </option>
				<option value="4"> ALAMO</option>
				<option value="5"> POZA RICA</option>
				<option value="6"> PAPANTLA </option>
				<option value="7"> MARTINEZ DE LA TORRE</option>
				<option value="8"> MISANTLA</option>
				<option value="9"> PEROTE </option>
				<option value="10">XALAPA I </option>
				<option value="11"> XALAPA II</option>
				<option value="12"> COATEPEC</option>
				<option value="13">EMILIANO ZAPATA </option>
				<option value="14"> VERACRUZ I </option>
				<option value="15"> VERACRUZ II </option>
				<option value="16"> BOCA DEL RIO</option>
				<option value="17"> MEDELLIN</option>
				<option value="18"> HUATUSCO </option>
				<option value="19">CORDOBA </option>
				<option value="20"> ORIZABA </option>
				<option value="21"> CAMERINO Z. MENDOZA</option>
				<option value="22"> ZONGOLICA</option>
				<option value="23"> COSAMALOAPAN </option>
				<option value="24"> SANTIAGO TUXTLA </option>
				<option value="25"> SAN ANDRES TUXTLA</option>
				<option value="26"> COSOLEACAQUE</option>
				<option value="27"> ACAYUCAN</option>
				<option value="28"> MINATITLAN</option>
				<option value="29"> COATZACOALCOS I </option>
				<option value="30"> COATZACOALCOS II </option>

			</select>
			@endif


					<br>
					<input type="hidden"  name="_token"  value="{{ csrf_token() }}" id="token" >
						<div align="center">
						
					<button  type="submit" class="btn btn-primary">REPORTE F4</button>
						@endif
					</div>

					</form>
					</div>
					<br>
			</div>
				</div>
		</div>
		<!-- termina col -->
	</div>
</div>





<script type="text/javascript" src="/rutas/public/assets/js/reportes/reportes.js"></script>
<!-- <script type="text/javascript" src="/rutas/public/assets/js/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="/rutas/public/assets/js/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="/rutas/public/assets/js/jspdf/libs/base64.js"></script>


	<script type="text/javascript" src="/rutas/public/assets/js/tableExport.js"></script>
	<script type="text/javascript" src="/rutas/public/assets/js/jquery.base64.js"></script> -->
@endsection