@extends('layouts.app')

@section('content')
<br>
<br><br><br><br>

<style>
	a {
		border-color: black;
	}
</style>


<div class="container" align="center">
@if($usuario->tipoUsuario == 'ESTRUCTURA')
<div class="container" align="center">
   <div class="alert alert-success">
       <button type="button" class="close" aria-hidden="true">&times;</button>
       <strong>¡GRACIAS!</strong> SISTEMA CERRADO A CONTINUACION PUEDE IMPRIMIR SUS <strong>REPORTES</strong> ...
   </div>
</div>
	<div class="row">

		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			
				<!-- 	<a  href=" {{route('/ruta')}}">
					<img src="{{asset('assets/img/RUTAS2.png')}}"  width="200px" alt="">
					</a>
					<div >
					<br>
					<strong> Seleccione esta opción para agregar una ruta, recuerde que debe agregar primero la ruta para que esté disponible en el listado nominal.</strong>
						</div> -->
					
			
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			
					<a href=" {{route('/reportes')}}">
					<img src="{{asset('assets/img/REPORTES2.png')}}"  width="200px" alt="">
					</a>
					<div>
					<br>
										<strong>Utilice esta opción para generar los reportes distritales o municipales</strong>.
					</div>

					
			
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			<!-- 
					<a href=" {{route('/listado')}}">
					<img src="{{asset('assets/img/NOMINAL2.png')}}"  width="200px" alt="">
					</a>
					<div>
					<strong>
					<br>
					 Seleccione esta opción para agregar personas al listado nominal.
						</strong>
					</div>
			 -->
		</div>
		
	</div>
	@else
<div class="row">

		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			
					<a  href=" {{route('/ruta')}}">
					<img src="{{asset('assets/img/RUTAS2.png')}}"  width="200px" alt="">
					</a>
					<div >
					<br>
					<strong> Seleccione esta opción para agregar una ruta, recuerde que debe agregar primero la ruta para que esté disponible en el listado nominal.</strong>
						</div>
					
			
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			
					<a href=" {{route('/listado')}}">
					<img src="{{asset('assets/img/NOMINAL2.png')}}"  width="200px" alt="">
					</a>
					<div>
					<strong>
					<br>
					 Seleccione esta opción para agregar personas al listado nominal.
						</strong>
					</div>
			
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			
			
					<a href=" {{route('/reportes')}}">
					<img src="{{asset('assets/img/REPORTES2.png')}}"  width="200px" alt="">
					</a>
					<div>
					<br>
										<strong>Utilice esta opción para generar los reportes distritales o municipales</strong>.
					</div>

					
			
		</div>
		
	</div>

	@endif

</div>

@endsection