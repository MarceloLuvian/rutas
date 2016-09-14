<?php

namespace RUTAS\Http\Controllers;

use Illuminate\Http\Request;

use RUTAS\Http\Requests;
use RUTAS\microregiones;
use RUTAS\Ruta;
use RUTAS\Nominal;
use RUTAS\User;
use RUTAS\responsable;
use RUTAS\municipio;

class estatalController extends Controller
{
 public function __construct()
 {
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return $this->reportef4();


   }

   public function municipios($distrito){
      $municipios = microregiones::where('distrito','=',$distrito)->groupby('municipio')->get();
      return $municipios;
  }

  function candidatos(){
   return $this->reportef4candidato();
  }

//Funcion para la vista de reportes -> usuarios municipales.
  public function municipalusuarios(){
    $usuarios  = User::where('nivel','=','54')->get();
    $usuarios2 = array();
    $usuario = \Auth::user();
    $cantidadVehiculos = 0;
    $costo = 0;
    $electores = 0;
    $meta = 0;
    
    foreach ($usuarios as $usuario) {
      $municipio = municipio::where('numeromunicipio',$usuario->municipio)->first();
      $distrito  = microregiones::where('distrito', $usuario->distrito)->first();
      $secciones = responsable::where('usuario', $usuario->id)->groupby('seccion')->get();
      $localidades = Ruta::where('usuario', $usuario->id)->get();
      $rutas = responsable::where('usuario', $usuario->id)->get();     
      $nominal  = Nominal::where('usuario', $usuario->id)->get();

      foreach ($localidades as $localidad) {
       
       $cantidadVehiculos = $localidad->cantVehiculo + $cantidadVehiculos;
       $costo  = $localidad->costo + $costo;
       $electores = $localidad->electores + $electores;
       $meta = $localidad->meta + $meta;
        }

      $arreglo = array( 'NOMBRE' => $usuario->name, 
         'MUNICIPIO' => $municipio->nombre,
          'DISTRITO' => $distrito->cabecera,
          'SECCIONES' => $secciones->count(),
          'LOCALIDADES' => $localidades->count(),
          'RUTAS' => $rutas->count(),
          'VEHICULOS' => $cantidadVehiculos,
          'COSTO' => $costo,
          'ELECTORES' => $electores,
          'META' => $meta,
          'NOMINAL' => $nominal->count(),
      );
        array_push($usuarios2, $arreglo);
    }
    


    $view = \View::make('estatal.index4');
    $view->usuarios = $usuarios2;
    return $view;
  }

  public function vistaseleccion(){
    $view = \View::make('estatal.index3');
    return $view;
  }

  public function reportef4(){
      $view = \View::make('estatal.index');
      $sumacosto = 0;
      $sumaelectores = 0;
      $sumameta = 0;
      $sumanominal = 0;
      $porcentajenominal = 0;
      $totalrutas = 0;
      $totalmunicipios = 0;
      $totalsecciones = 0;
      $totalvehiculos = 0;
      $totalLocalidades = 0;
      $rutasnodescritas = 0;
      $totalrutasnodescritas = 0;



      $distritos = array();

      for ($i=1; $i < 31; $i++) { 
        $rutasnodescritas = 0;
       $municipios = microregiones::where('distrito','=',$i)->groupby('id_municipio')->lists('id_municipio')->all();
// 
       $usuariosDistritales = User::where('distrito',$i)->where('tipoUsuario','=','ESTRUCTURA')->lists('id')->all();
       $nominal = Nominal::wherein('usuario',$usuariosDistritales)->where('tipoUsuario','ESTRUCTURA')->count();

// 

       $usuarios = User::where('distrito',$i)->where('tipoUsuario','ESTRUCTURA')->lists('id')->all();
       // foreach ($usuarios as $key ) {
       //    echo "Dato: ".$key." <br>";
       // }
       // echo "_________________ <br>";

       $responsables = responsable::wherein('usuario',$usuarios)->where('tipoUsuario','ESTRUCTURA')->get();

       $cantidadmunicipios = responsable::wherein('usuario',$usuarios)->where('tipoUsuario','ESTRUCTURA')->groupby('municipio')->get();

       $seccioness = responsable::wherein('usuario',$usuarios)->where('tipoUsuario','ESTRUCTURA')->groupby('seccion')->get();

     // usuarios

       $cabecera = microregiones::where('distrito',$i)->groupby('cabecera')->first();
       $secciones = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','ESTRUCTURA')->groupby('seccion')->get();

       $municipio = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','ESTRUCTURA')->groupby('municipio_id')->get();
       $localidades = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','ESTRUCTURA')->groupby('localidad')->get();     
       $vehiculos = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','ESTRUCTURA')->sum('cantVehiculo');
       $costo = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','ESTRUCTURA')->sum('costo');
       $electores = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','ESTRUCTURA')->sum('electores');
       $meta = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','ESTRUCTURA')->sum('meta');
       $responsables2 = responsable::wherein('usuario',$usuarios)->get();

       $rmunicipios = microregiones::where('distrito','=',$i)->groupby('id_municipio')->lists('id_municipio')->all();

       foreach ($responsables2 as $r) {
        // echo "Dato: ".$r." <br>";
          $rut = Ruta::where('responsable',$r->nombre)->where('seccion',$r->seccion)->where('municipio',$r->municipio)->count();
          if ($rut == 0) {
            $rutasnodescritas++;
                     // echo "<<<<<<<<<<<<<<<<<<<<<<<<< ";
            // echo "PENDIENTE : ".$r." ";
                     // echo ">>>>>>>>>>>>>>>>>>> <br>";
          }
          // $rutasnodescritas = $rutasnodescritas + $rutas->count();
       }
       
      $totalrutasnodescritas  = $totalrutasnodescritas + $rutasnodescritas;

       $totalrutas = $totalrutas + $responsables->count();
       $totalsecciones = $totalsecciones + $seccioness->count();
       $totalmunicipios = $totalmunicipios + $cantidadmunicipios->count();
       $totalvehiculos = $totalvehiculos + $vehiculos;
       $totalLocalidades = $totalLocalidades + $localidades->count();

       $distritos2 = array( 'DISTRITO' => $cabecera["cabecera"], 
         'MUNICIPIOS' => $cantidadmunicipios->count(),
         'SECCIONES' => $seccioness->count(),
         'RUTA' => $responsables->count(),
          'RUTAN' => $rutasnodescritas,
         'LOCALIDADES' => $localidades->count(),
         'VEHICULOS' => $vehiculos,
         'COSTO' => $costo,
         'ELECTORES' => $electores,
         'META' => $meta,
         'AVANCE_NOMINAL' => $nominal,
         );

       $sumacosto = $sumacosto + $costo;
       $sumaelectores = $sumaelectores + $electores;
       $sumameta = $sumameta + $meta;
       $sumanominal = $sumanominal + $nominal;


       array_push($distritos, $distritos2);
     // echo $distritos2["DISTRITO"];
   } 

   $view->totalrutasnodescritas = $totalrutasnodescritas;
   $view->totalLocalidades = $totalLocalidades;
   $view->totalvehiculos = $totalvehiculos;
   $view->totalsecciones = $totalsecciones;
   $view->totalmunicipios = $totalmunicipios;
   $view->totalrutas = $totalrutas;
   $view->distritos = $distritos;
   $view->sumacosto = $sumacosto;
   $view->sumameta = $sumameta;
   $view->sumanominal = $sumanominal;
   if ($sumanominal > 0 && $sumameta > 0) {
     $view->porcentajenominal = round((($sumanominal / $sumameta) * 100),2)  ;
 }else{
    $view->porcentajenominal = 0  ;
}

$view->sumaelectores = $sumaelectores;
return $view;
}

//Regresa el reporte de los usuarios distritales
function reportef4get2($distrito){
     // $usuario = \Auth::user();

 $cabecera = microregiones::where('distrito','=',$distrito)->get();
 $rmunicipios = microregiones::where('distrito','=',$distrito)->groupby('id_municipio')->lists('id_municipio')->all();

 $cabecera = microregiones::where('distrito',$distrito)->groupby('cabecera')->first();
 $municipiosTotales = array();

 $countaux = 0;
 $csecciones = 0;
 $cmunicipio = 0;
 $clocalidades = 0;
 $crutas = 0;
 $cvehiculos = 0;
 $ccosto = 0;
 $celectores = 0;
 $cmeta  = 0;
 $cnominal  = 0;


 foreach ($rmunicipios as $mun) { 
   $rutas = Ruta::where('municipio_id',$mun)->where('tipoUsuario','=','CANDIDATO')->get();
   $nominal =0;

   if($rutas->count()>0){

    $countaux++;
    $secciones = Ruta::where('municipio_id',$mun)->where('tipoUsuario','CANDIDATO')->groupby('seccion')->get();
    $localidades = Ruta::where('municipio_id',$mun)->where('tipoUsuario','CANDIDATO')->groupby('localidad')->get();     

    $vehiculos = Ruta::where('municipio_id',$mun)->where('tipoUsuario','CANDIDATO')->sum('cantVehiculo');
    $costo = Ruta::where('municipio_id',$mun)->where('tipoUsuario','CANDIDATO')->sum('costo');
    $electores = Ruta::where('municipio_id',$mun)->where('tipoUsuario','CANDIDATO')->sum('electores');
    $meta = Ruta::where('municipio_id',$mun)->where('tipoUsuario','CANDIDATO')->sum('meta');

    $seccionesAux = Ruta::where('municipio_id',$mun)->where('tipoUsuario','CANDIDATO')->groupby('seccion')->lists('seccion')->all();
    $nominal = Nominal::wherein('seccion',$seccionesAux)->where('tipoUsuario','CANDIDATO')->get();


    $municipios2 = array( 'DISTRITO' => $cabecera["cabecera"], 
     'MUNICIPIOS' => $rutas[0]->municipio, 
     'SECCIONES' => $secciones->count(),
     'RUTA' => $rutas->count(),
     'LOCALIDADES' => $localidades->count(),
     'VEHICULOS' => $vehiculos,
     'COSTO' => $costo,
     'ELECTORES' => $electores,
     'META' => $meta,
     'AVANCE_NOMINAL' => $nominal->count()
     );



    $csecciones =  $csecciones +  $secciones->count();
    $clocalidades = $clocalidades + $localidades->count();
    $crutas = $crutas + $rutas->count();
    $cvehiculos = $cvehiculos +  $vehiculos;
    $ccosto = $ccosto +  $costo;
    $celectores = $celectores +  $electores;
    $cmeta  =$cmeta +  $meta;
    $cnominal = $cnominal + $nominal->count();

    array_push($municipiosTotales, $municipios2);

}

}   

// $usuarios = User::where('distrito',$distrito)->where('tipoUsuario','CANDIDATO')->lists('id')->all(); 
//  $seccioness = responsable::wherein('usuario',$usuarios)->groupby('seccion')->lists('seccion')->all();
//  $nominal = Nominal::wherein('seccion',$seccioness)->where('tipoUsuario','CANDIDATO')->get();
//  $cnominal = $nominal->count();

// $responsables = responsable::wherein('usuario',$usuarios)->get();

// $cantidadmunicipios = responsable::wherein('usuario',$usuarios)->groupby('municipio')->get();

// $seccioness = responsable::wherein('usuario',$usuarios)->groupby('seccion')->get();



$municipios2 = array(  'DISTRITO' => '<strong> TOTAL 
</strong>', 
'MUNICIPIOS' => '<strong></strong>', 
'SECCIONES' => '<strong>'.$csecciones.'</strong>',
'RUTA' => '<strong>'.$crutas.'</strong>',
'LOCALIDADES' => '<strong>'.$clocalidades.'</strong>',
'VEHICULOS' => '<strong>'.$cvehiculos.'</strong>',
'COSTO' => $ccosto,
'ELECTORES' => '<strong>'.$celectores.'</strong>',
'META' => $cmeta,
'AVANCE_NOMINAL' => $cnominal,
);
array_push($municipiosTotales, $municipios2);

return $municipiosTotales;

}

function reportef4get($distrito){
     //$usuario = \Auth::user();

 $cabecera = microregiones::where('distrito','=',$distrito)->get();
 $rmunicipios = microregiones::where('distrito','=',$distrito)->groupby('id_municipio')->lists('id_municipio')->all();
 $usuarios = User::lists('id')->all();
 $cabecera = microregiones::where('distrito',$distrito)->groupby('cabecera')->first();
 $municipiosTotales = array();

 $countaux = 0;
 $csecciones = 0;
 $cmunicipio = 0;
 $clocalidades = 0;
 $crutas = 0;
 $cvehiculos = 0;
 $ccosto = 0;
 $celectores = 0;
 $cmeta  = 0;
 $cnominal  = 0;

 foreach ($rmunicipios as $mun) { 
   $rutas = Ruta::where('municipio_id',$mun)->where('tipoUsuario','=','ESTRUCTURA')->get();
   $nominal =0;

   if($rutas->count()>0){

    $countaux++;
    $secciones = Ruta::where('municipio_id',$mun)->where('tipoUsuario','ESTRUCTURA')->groupby('seccion')->get();
    $localidades = Ruta::where('municipio_id',$mun)->where('tipoUsuario','ESTRUCTURA')->groupby('localidad')->get();     

    $vehiculos = Ruta::where('municipio_id',$mun)->where('tipoUsuario','ESTRUCTURA')->sum('cantVehiculo');
    $costo = Ruta::where('municipio_id',$mun)->where('tipoUsuario','ESTRUCTURA')->sum('costo');
    $electores = Ruta::where('municipio_id',$mun)->where('tipoUsuario','ESTRUCTURA')->sum('electores');
    $meta = Ruta::where('municipio_id',$mun)->where('tipoUsuario','ESTRUCTURA')->sum('meta');

    $seccionesAux = Ruta::where('municipio_id',$mun)->where('tipoUsuario','ESTRUCTURA')->groupby('seccion')->lists('seccion')->all();
    $nominal = Nominal::wherein('seccion',$seccionesAux)->where('tipoUsuario','ESTRUCTURA')->get();
    $cmunicipio++;

    $municipios2 = array( 'DISTRITO' => $cabecera["cabecera"], 
     'MUNICIPIOS' => $rutas[0]->municipio, 
     'SECCIONES' => $secciones->count(),
     'RUTA' => $rutas->count(),
     'LOCALIDADES' => $localidades->count(),
     'VEHICULOS' => $vehiculos,
     'COSTO' => $costo,
     'ELECTORES' => $electores,
     'META' => $meta,
     'AVANCE_NOMINAL' => $nominal->count()
     );

    $csecciones =  $csecciones +  $secciones->count();
    $clocalidades = $clocalidades + $localidades->count();
    $crutas = $crutas + $rutas->count();
    $cvehiculos = $cvehiculos +  $vehiculos;
    $ccosto = $ccosto +  $costo;
    $celectores = $celectores +  $electores;
    $cmeta  =$cmeta +  $meta;
    $cnominal = $cnominal + $nominal->count();

    array_push($municipiosTotales, $municipios2);

}

}   

$municipios2 = array(  'DISTRITO' => '<strong> TOTAL
</strong>', 
'MUNICIPIOS' => '<strong>'.$cmunicipio.'</strong>', 
'SECCIONES' => '<strong>'.$csecciones.'</strong>',
'RUTA' => '<strong>'.$crutas.'</strong>',
'LOCALIDADES' => '<strong>'.$clocalidades.'</strong>',
'VEHICULOS' => '<strong>'.$cvehiculos.'</strong>',
'COSTO' => $ccosto,
'ELECTORES' => '<strong>'.$celectores.'</strong>',
'META' => $cmeta,
'AVANCE_NOMINAL' => $cnominal,
);
array_push($municipiosTotales, $municipios2);

return $municipiosTotales;

}

public function reportef4candidato(){
      $view = \View::make('estatal.index2');
      $sumacosto = 0;
      $sumaelectores = 0;
      $sumameta = 0;
      $sumanominal = 0;
      $porcentajenominal = 0;
      $totalrutas = 0;
      $totalmunicipios = 0;
      $totalsecciones = 0;
      $totalvehiculos = 0;
      $totalLocalidades = 0;

      $distritos = array();

      for ($i=1; $i < 31; $i++) { 
       $municipios = microregiones::where('distrito','=',$i)->groupby('id_municipio')->lists('id_municipio')->all();
// 
       $usuariosDistritales = User::where('distrito',$i)->where('tipoUsuario','=','CANDIDATO')->lists('id')->all();
       $nominal = Nominal::wherein('usuario',$usuariosDistritales)->count();

// 

       $usuarios = User::where('distrito',$i)->where('tipoUsuario','CANDIDATO')->lists('id')->all();
       $responsables = responsable::wherein('usuario',$usuarios)->get();





       $cantidadmunicipios = responsable::wherein('usuario',$usuarios)->groupby('municipio')->get();

       $seccioness = responsable::wherein('usuario',$usuarios)->groupby('seccion')->get();

     // usuarios

       $cabecera = microregiones::where('distrito',$i)->groupby('cabecera')->first();
       $secciones = Ruta::wherein('municipio_id',$municipios)->groupby('seccion')->get();

       $municipio = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','CANDIDATO')->groupby('municipio_id')->get();
       $localidades = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','CANDIDATO')->groupby('localidad')->get();     
       $vehiculos = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','CANDIDATO')->sum('cantVehiculo');
       $costo = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','CANDIDATO')->sum('costo');
       $electores = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','CANDIDATO')->sum('electores');
       $meta = Ruta::wherein('municipio_id',$municipios)->where('tipoUsuario','CANDIDATO')->sum('meta');
       $totalrutas = $totalrutas + $responsables->count();
       $totalmunicipios = $totalmunicipios + $cantidadmunicipios->count();
       $totalsecciones = $totalsecciones + $seccioness->count();
       $totalvehiculos = $totalvehiculos + $vehiculos;
       $totalLocalidades = $totalLocalidades + $localidades->count();

       $distritos2 = array( 'DISTRITO' => $cabecera["cabecera"], 
         'MUNICIPIOS' => $cantidadmunicipios->count(),
         'SECCIONES' => $seccioness->count(),
         'RUTA' => $responsables->count(),
         'LOCALIDADES' => $localidades->count(),
         'VEHICULOS' => $vehiculos,
         'COSTO' => $costo,
         'ELECTORES' => $electores,
         'META' => $meta,
         'AVANCE_NOMINAL' => $nominal
         );

       $sumacosto = $sumacosto + $costo;
       $sumaelectores = $sumaelectores + $electores;
       $sumameta = $sumameta + $meta;
       $sumanominal = $sumanominal + $nominal;


       array_push($distritos, $distritos2);
   } 
   $view->totalLocalidades = $totalLocalidades;
   $view->totalvehiculos = $totalvehiculos;
   $view->totalsecciones = $totalsecciones;
   $view->totalmunicipios = $totalmunicipios;
   $view->totalrutas = $totalrutas;
   $view->distritos = $distritos;
   $view->sumacosto = $sumacosto;
   $view->sumameta = $sumameta;
   $view->sumanominal = $sumanominal;
   if ($sumanominal > 0 && $sumameta > 0) {
     $view->porcentajenominal = round((($sumanominal / $sumameta) * 100),2)  ;
 }else{
    $view->porcentajenominal = 0  ;
}

$view->sumaelectores = $sumaelectores;
return $view;
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
