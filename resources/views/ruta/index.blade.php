@extends('layouts.app')

@section('content')

<script>
	
</script>


<style>
	input {
		text-transform: uppercase;
	}
</style>
<br>
@if($estado == 1)
<div class="container">
	<div align="center" class="alert alert-success " role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Éxito!</strong> La ruta se guardo correctamente.
	</div>


	@endif
	<!-- <form action="{{url('guardarRuta')}}" method="post -->
	<div class="container">
		<div class="row">

			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="panel panel-success">
					<div class="panel-heading" align="center"><strong>  AGREGAR RUTAS </strong>   </div>
					<div class="panel-body" align="center">

						<input type="hidden" id="municipiog" name="municipiog">

						<select required class="form-control" id="municipio" name="municipio">
							<option value=0  > SELECCIONE UN MUNICIPIO    </option>
							@foreach ( $municipios as $municipio)
							<option value="{{$municipio->id_municipio}}" > {{$municipio->municipio}}   </option>
							@endforeach
						</select>

						<br>
						<select required class="form-control" id="seccion" name="seccion">
						</select>
						<label for="responsab" class="pull-left">Representante de ruta:</label>
						<hr>
						<label for="responsable">NOMBRE (S)</label>
						<input type="text" class="form-control" name="responsable" id="responsable" pattern="[A-Z ´]+{1,80}" title="Debe poner solo letras" required placeholder="NOMBRE (S)">

						<label for="">APELLIDO PATERNO</label>
						<input type="text" class="form-control" name="appp" id="appp" pattern="[A-Z ´]+{1,80}" title="Debe poner solo letras" required placeholder="APELLIDO PATERNO">

						<label for="apmm">APELLIDO MATERNO</label>
						<input type="text" class="form-control" name="apmm" id="apmm" pattern="[A-Z ´]+{1,80}" title="Debe poner solo letras" required placeholder="APELLIDO MATERNO">
						<br>

						<div  class="btn-group" role="group" aria-label="...">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
							<button type="button" id="guardar" class="btn btn-primary">GUARDAR RUTA</button>

						</div>

						<br>

					</div>

				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="panel panel-success">
					<div class="panel-heading" align="center"><strong>  RUTAS EXISTENTES  </strong>   </div>
					<div class="panel-body" align="center">
						<label > Utilice el boton de <span class="glyphicon glyphicon-road"></span> para agregar la descripción de sus rutas. </label>
						<br>
						<div>
							<div class="table-responsive">

								
								<table class="table table-hover">
									<thead>
										<tr>
											<th> SECCIÓN</th>
											<th>N° RUTA</th>
											<th> RESPONSABLE </th>
											<th> MÁS</th>
										</tr>
									</thead>
									<tbody id="data">


									</tbody>
								</table>
							</div>
						</div>


					</div>


				</div>

			</div>
		</div>
	</div>
	<br>

	<!-- div -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="table-responsive">
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th>LOCALIDAD</th>
								<th>DISTANCIA</th>
								<th>VÍA</th>
								<th>MEDIO</th>
								<th>TIEMPO</th>
								<th>VEHÍCULO</th>
								<th>PLACAS</th>
								<th>VEHÍCULOS</th>
								<th>COSTO</th>
								<th>ELECTORES</th>
								<th>META</th>
								<th>ACCIONES</th>
							</tr>
						</thead>
						<tbody id = "data2">

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
			<div class="col-xs-6" >
				<ul class="nav nav-tabs pull-right" >




				</ul>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					<h4 class="modal-title" id="myModalLabel"> DATOS DE RUTA</h4>		

					<pre><label>RESPONSABLE:</label><span id="rep"></span>   <label>  RUTA:</label> <span id="nru"></span> </pre>  
				</div>

				<div class="modal-body">
					<div id ="contenido">	
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="localidad" >LOCALIDAD Ó COLONIA</label>
								<input type="text" class="form-control" name="localidad" id="localidad" pattern="[A-Za-z ´]+{1,30}" title="Debe poner solo letras" required placeholder="Localidad">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="distancia" >DISTANCIA (KMS)</label>
								<input type="text" class="form-control" name="distancia" id="distancia" pattern="[0-9. ]+{1,8}" title="Debe poner solo numeros" required   placeholder="Ejemplo: 1.5 ">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="via" >VÍA DE COMUNICACIÓN</label>
								<select name="via" id="via" class="form-control" required>
									<option value="0">SELECCIONE UNA VIA</option>
									<option value="TERRACERÍA">  TERRACERÍA</option>
									<option value="PAVIMENTO">PAVIMENTO  </option>
									<option value="VEREDA"> VEREDA </option>
									<option value="FLUVIAL"> FLUVIAL </option>
								</select>
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="medio" >MEDIO DE TRANSPORTE</label>
								<select name="medio" id="medio" class="form-control" required>
									<option value="0">SELECCIONE MEDIO DE TRANSPORTE</option>
									<option value="TAXI">  TAXI</option>
									<option value="AUTOBUS">AUTOBUS  </option>
									<option value="COMBI"> COMBI </option>
									<option value="CAMIONETA"> CAMIONETA </option>
									<option value="COCHE"> COCHE </option>
									<option value="TRANSPORTE FLUVIAL"> TRANSPORTE FLUVIAL </option>
								</select>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="tiempo" >TIEMPO APROXIMADO</label>
								<input type="text" class="form-control" name="tiempo" id="tiempo" required pattern="[A-Z 0-9]+{1,30}" title="Debe poner solo letras y numeros" placeholder="Ejemplo: 1 HORA 20 MIN">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="tipoveiculo" >TIPO VEHÍCULO</label>
								<input type="text" class="form-control" name="tipoveiculo" id="tipoveiculo" pattern="[^A-Z 0-9.-]+{1,30}" title="Debe poner solo letras y numeros" required  placeholder=" Tipo de Vehículo">
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="nplacas" >N° PLACAS separar por (,)</label>
								<input type="text" class="form-control"  name="nplacas" id="nplacas" pattern="[A-Z0-9.- ]+{1,30}" title="Debe poner solo letras y numeros"  required placeholder="N° de placas"> 
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="cantidadve" >CANTIDAD DE VEHÍCULOS</label>
								<input type="number" id="cantidadVe" name="cantidadVe" min="1" class="form-control" placeholder="Cantidad de Vehículos" >
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="costo" >COSTO</label>
								<input type="text" class="form-control"  name="costo" id="costo" required pattern="[0-9. ]+{1,30}" title="Debe poner solo numeros" placeholder="ejemplo: 300">
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="electores" >ELECTORES</label>
								<input type="text" class="form-control" name="electores" id="electores" pattern="[0-9 ]+{1,30}" title="Debe poner solo numeros"  required  placeholder="ejemplo: 150">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="meta" >META</label>
								<input type="text" class="form-control" name="meta" id="meta" pattern="[0-9 ]+{1,30}" title="Debe poner solo numeros"  required  placeholder="ejemplo: 100">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							</div>
						</div>
					</div>
					<!-- FIN -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="limpiar2()" data-dismiss="modal">Cerrar</button>
					<button type="button" id="guardarruta" class="btn btn-primary" >Guardar ruta</button>
				</div>
			</div>
		</div>
	</div>

	<!-- modal de edicion -->
	<div class="modal fade" id="MODALEDIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
					<div class="panel panel-">
						<div class="panel-heading" align="center">
							<h3 class="panel-title">EDITAR</h3>
						</div>							
					</div>						
				</div>
				<div class="modal-body">
					<div id ="contenido">	
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="localidad" >LOCALIDAD Ó COLONIA</label>
								<input type="text" class="form-control" name="localida" id="localida" pattern="[A-Za-z ´]+{1,30}" title="Debe poner solo letras" required placeholder="Localidad">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="distancia" >DISTANCIA (KMS)</label>
								<input type="text" class="form-control" name="distanci" id="distanci" pattern="[0-9. ]+{1,8}" title="Debe poner solo numeros" required   placeholder="Ejemplo: 1.5 ">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="vi" >VÍA DE COMUNICACIÓN</label>
								<select name="vi" id="vi" class="form-control" required>
									<option value="0">SELECCIONE UNA VIA</option>
									<option value="TERRACERÍA">  TERRACERÍA</option>
									<option value="PAVIMENTO">PAVIMENTO  </option>
									<option value="VEREDA"> VEREDA </option>
									<option value="FLUVIAL"> FLUVIAL </option>
								</select>
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="medi" >MEDIO DE TRANSPORTE</label>
								<select name="medio" id="medi" class="form-control" required>
									<option value="0">SELECCIONE MEDIO DE TRANSPORTE</option>
									<option value="TAXI">  TAXI</option>
									<option value="AUTOBUS">AUTOBUS  </option>
									<option value="COMBI"> COMBI </option>
									<option value="CAMIONETA"> CAMIONETA </option>
									<option value="COCHE"> COCHE </option>
									<option value="TRANSPORTE FLUVIAL"> TRANSPORTE FLUVIAL </option>
								</select>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="tiempo" >TIEMPO APROXIMADO</label>
								<input type="text" class="form-control" name="tiemp" id="tiemp" required pattern="[A-Z 0-9]+{1,30}" title="Debe poner solo letras y numeros" placeholder="Ejemplo: 1 HORA 20 MIN">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="tipoveiculo" >TIPO VEHÍCULO</label>
								<input type="text" class="form-control" name="tipoveicul" id="tipoveicul" pattern="[^A-Z 0-9.-]+{1,30}" title="Debe poner solo letras y numeros" required  placeholder=" Tipo de Vehículo">
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="nplacas" >N° PLACAS separar por (,)</label>
								<input type="text" class="form-control"  name="nplaca" id="nplaca" pattern="[A-Z0-9.- ]+{1,30}" title="Debe poner solo letras y numeros"  required placeholder="N° de placas"> 
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="cantidadve" >CANTIDAD DE VEHÍCULOS</label>
								<input type="number" id="cantidadV" name="cantidadV" min="1" class="form-control" placeholder="Cantidad de Vehículos" >
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="costo" >COSTO</label>
								<input type="text" class="form-control"  name="cost" id="cost" required pattern="[0-9. ]+{1,30}" title="Debe poner solo numeros" placeholder="ejemplo: 300">
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="electores" >ELECTORES</label>
								<input type="text" class="form-control" name="electore" id="electore" pattern="[0-9 ]+{1,30}" title="Debe poner solo numeros"  required  placeholder="ejemplo: 150">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<label for="meta" >META</label>
								<input type="text" class="form-control" name="met" id="met" pattern="[0-9 ]+{1,30}" title="Debe poner solo numeros"  required  placeholder="ejemplo: 100">
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<input type="hidden" id="identificador">
							</div>

						</div>



					</div>
					<!-- FIN -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="limpiar4()" data-dismiss="modal">Cerrar</button>
					<button type="button" id="editarRuta" class="btn btn-primary" >GUARDAR CAMBIOS</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editarResponsable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">EDITAR RESPONSABLE</h4>
				</div>
				<div class="modal-body">
					<span for="responsab" class="pull-left">ESTA EDITANDO A: <strong><span id="edresponsable"></span></strong></span>
						<hr>
						<label for="responsable">NOMBRE (S)</label>
						<input type="text" class="form-control" name="re" id="re" pattern="[A-Z ´]+{1,80}" title="Debe poner solo letras" required placeholder="NOMBRE (S)">

						<label for="">APELLIDO PATERNO</label>
						<input type="text" class="form-control" name="ap" id="ap" pattern="[A-Z ´]+{1,80}" title="Debe poner solo letras" required placeholder="APELLIDO PATERNO">

						<label for="apmm">APELLIDO MATERNO</label>
						<input type="text" class="form-control" name="am" id="am" pattern="[A-Z ´]+{1,80}" title="Debe poner solo letras" required placeholder="APELLIDO MATERNO">
						<br>
						<input type="hidden" id="idResponsable">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
					<button type="button" class="btn btn-primary" onclick="editarR()">GUARDAR CAMBIOS</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/rutas/public/assets/js/rutas/funciones.js"></script>
	@endsection