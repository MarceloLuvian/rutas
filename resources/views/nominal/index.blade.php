@extends('layouts.app')

@section('content')

<br>

<style>
	input {
		text-transform: uppercase;
	}
</style>








<!-- <form action="guardarnominal" id="formularioLista" method="post"> -->
<div class="container">
	<div class="row">

		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<div class="panel panel-success">
				<div class="panel-heading" align="center"><strong>   RUTAS DISPONIBLES </strong>   </div>
				<div class="panel-body">
					<input type="hidden" id="nombremunicipio" name="nombremunicipio">

					<select name="municipio" class="form-control" required id="municipio">
						<option value=0 > SELECCIONE UN MUNICIPIO    </option>
						@foreach($municipios as $municipio)
						<option value="{{$municipio->id_municipio}}" > {{$municipio->municipio}}    </option>
						@endforeach
					</select>

					<br>
					<select class="form-control" required name="seccion" id="seccion">

					</select>
					<br>

				 <span >CANTIDAD NOMINAL DEL MUNICIPIO SELECCIONADO: </span> <span id="nominalmunicipal" class="label label-danger"></span>
					<br>
					<br>
					<label >Haga clic en el icono <span class="glyphicon glyphicon-hand-up"></span> para seleccionar una ruta</label>
					<br>
					<br>
					<div class="table-responsive">				
					<table class="table table-hover">
						<thead>
							<tr>
								<th> SECCION</th>
								<th>N° RUTA</th>
								<th> RESPONSABLE </th>
								<th> SELECCIONAR</th>
							</tr>
						</thead>
						<tbody id="data">
							<tr >

							</tr>
						</tbody>
					</table>
					</div>
					<br>

				</div>

			</div>
		</div>

		<!-- CODIGO COMENTADO -->
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- <div class="panel panel-success">
				<div class="panel-heading" align="center"><strong>   BUSQUEDA POR CLAVE ELECTORAL </strong>   </div>
				<div class="panel-body">
					
					<div class="row">
						

					</div>
					<br>
					<div align="center">
						<a class="btn btn-primary" id="buscarnominal" >Buscar</a>
					</div>		
					<br>
					<label> <span class="danger"> ATENCIÓN:</span> LA PERSONA QUE VA A REGISTRAR DEBE PERTENECER A LA SECCIÓN INDICADA.</label>
				</div>
			</div> -->
			
		</div>
	</div>
</div>

<div class="container">
	
</div>

<div class="container">
<div class="panel panel-warning">
	  <div class="panel-heading" align="center">
			<h3 class="panel-title">NOMINALES DE LA RUTA SELECCIONADA</h3>
	  </div>
	  <div class="panel-body">
				<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>NOMBRE</th>
					<th>CLAVE ELECTOR</th>
					<th>DIRECCION</th>
					<th>TEL CASA</th>
					<th>TEL CEL</th>
					<th>OTRO</th>
					<th>REFERENCIA</th>
				</tr>
			</thead>
			<tbody id="datanominal">
				
			</tbody>
		</table>
	</div>
	  </div>
</div>

</div>
<div class="container">
	<div class="row">
		<div class="col-xs-6">

			<div id="divregresa" class="btn-group" role="group" aria-label="...">
				<a id="regresar" href="{{route('/inicio')}}"  class="btn btn-success">VOLVER</a>

			</div>
		</div>
		
	</div>
</div>
<!-- </form> -->

<script type="text/javascript" src="/rutas/public/assets/js/listanominal/funciones.js"></script>
@endsection