<?php

namespace RUTAS\Http\Controllers;

use Illuminate\Http\Request;

use RUTAS\Http\Requests;
use RUTAS\municipio;
use RUTAS\microregiones;
use RUTAS\Nominal;
use RUTAS\listanominal;
use RUTAS\Ruta;
use RUTAS\Auth;
use RUTAS\responsable;
use RUTAS\repMunicipales;

class reportesController extends Controller
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
      $usuario = \Auth::user();

      $view = \View::make('reportes.index');

      $municipios = $this->municipios($usuario->distrito);
      $view->usuario = $usuario;
      $view->municipios = $municipios;
      return $view;
    }

     public function municipios($distrito){
        $usuario = \Auth::user();
      if ($usuario->nivel == 53) {
        $municipios = microregiones::groupby('municipio')->get();
      return $municipios;
      }else if($usuario->nivel == 54){
       $municipios = microregiones::where('id_municipio',$usuario->municipio)->groupby('municipio')->get();
      return $municipios;
      }

      else{
        $municipios = microregiones::where('distrito','=',$distrito)->groupby('municipio')->get();
      return $municipios;
      }
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

//     public function reporteDistrial(Request $request){
// $usuario = \Auth::user();
// $cabecera = microregiones::where('distrito','=',$usuario->distrito)->get();
//      $id = $usuario->id;


//      // $ruta = $request->rutaselect2;      

//      $seccion = $request->seccion2;

//      $cabe = $cabecera[0]->cabecera;

//      $rutatch = responsable::where('usuario', $id)->where('seccion',$seccion)->get();

//      foreach ($rutatch as $ruta) {

//         $rutas = Ruta::where('seccion','=',$seccion)->where('usuario','=',$id)->where('numruta','=',$ruta->numruta)->get();
//      $respoaux  = responsable::where('numruta','=',$ruta->numruta)->where('usuario','=',$id)->where('seccion','=',$seccion)->first();

//      $municipio = $respoaux->municipio;
//      if ($rutas->count() == 0) {

//       $respo = $respoaux->nombre;
//     }else
//     {
//      $respo = $rutas[0]->responsable;
//    }




  
//      }
//  $view = \View::make('pdf.F1');
//    $view->ruta = $ruta->numruta;
//    $view->seccion = $seccion;
//    $view->rutas = $rutas;
//    $view->seccion = $seccion;
//    $view->respo = $respo;
//    $view->municipio = $municipio;
//    $view->cabe = $cabe;
//    $view->distrito = $usuario->distrito;

   
//    return $view;
     

//     }

    public function reporteDistrial(Request $request){
     $usuario = \Auth::user();

     if ($usuario->nivel == 53) {
      $cabecera = microregiones::where('distrito','=',$request->distritos)->get();
     }else{
      $cabecera = microregiones::where('distrito','=',$usuario->distrito)->get();
     }
     

     $id = $usuario->id;
     $ruta = $request->rutaselect2;      

     $seccion = $request->seccion2;
     $cabe = $cabecera[0]->cabecera;
     $rutas = Ruta::where('seccion','=',$seccion)->where('usuario','=',$id)->where('numruta','=',$ruta)->get();
     $respoaux  = responsable::where('numruta','=',$ruta)->where('usuario','=',$id)->where('seccion','=',$seccion)->first();

     $municipio = $respoaux->municipio;
     if ($rutas->count() == 0) {

      $respo = $respoaux->nombre;
    }else
    {
     $respo = $rutas[0]->responsable;
   }




   $view = \View::make('pdf.F1');
   $view->ruta = $ruta;
   $view->seccion = $seccion;
   $view->rutas = $rutas;
   $view->seccion = $seccion;
   $view->respo = $respo;
   $view->municipio = $municipio;
   $view->cabe = $cabe;
   $view->distrito = $usuario->distrito;

   
   return $view;
 }

 public function reporteDistrialnominal(Request $request){
  $usuario = \Auth::user();
      if ($usuario->nivel == 53) {
      $cabecera = microregiones::where('distrito','=',$request->distritos2)->get();
     }else{
      $cabecera = microregiones::where('distrito','=',$usuario->distrito)->get();
     }
  $seccion = $request->seccion;
  $id = $usuario->id;
  $ruta = $request->rutaselect;
  $listado = Nominal::where('seccion','=',$seccion)->where('usuario','=',$usuario->id)->where('numruta','=',$ruta)->orderby('nombre','asc')->get();


  $cabe = $cabecera[0]->cabecera;
  $rutas = Ruta::where('seccion','=',$seccion)->where('usuario','=',$id)->where('numruta','=',$ruta)->get();
  $respoaux  = responsable::where('numruta','=',$ruta)->where('usuario','=',$id)->where('seccion','=',$seccion)->first();
  $municipio = $respoaux->municipio;
  if ($rutas->count() == 0) {

    $respo = $respoaux->nombre;
  }else
  {
   $respo = $rutas[0]->responsable;
 }
 
if ($listado->count() > 0) {
  $view = \View::make('pdf.F2');
 $view->ruta = $ruta;
 $view->numero = $listado->count();
 $view->municipio = $municipio;
 $view->seccion = $seccion;
 $view->respo = $respo;
 $view->listado = $listado;
 $view->cabe = $cabe;
 $view->distrito = $usuario->distrito;
 return $view;
}else

{
 $view = \View::make('pdf.F2');
 $view->ruta = $ruta;
 $view->numero = $listado->count();
 $view->municipio = $municipio;
 $view->seccion = $seccion;
 $view->respo = $respo;
 $view->listado = $listado;
 $view->cabe = $cabe;
 $view->distrito = $usuario->distrito;
 return $view;
}
 


}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function reportef3(Request $request){
      $usuario = \Auth::user();
       
     if ($usuario->nivel == 53) {
      $cabecera = microregiones::where('distrito','=',$request->distritos3)->get();
     }else{
      $cabecera = microregiones::where('distrito','=',$usuario->distrito)->get();
     }
      $id = $usuario->id;
      $cabe = $cabecera[0]->cabecera;
      $municipio = municipio::where('numeromunicipio',$request->municipio3)->first();
      $nombre = $municipio->nombre;

      $secciones = Ruta::where('usuario','=',$id)->where('municipio_id','=',$request->municipio3)->groupby('seccion')->get();
      $localidades = Ruta::where('usuario','=',$id)->where('municipio_id','=',$request->municipio3)->groupby('localidad')->get();
      $rutas = Ruta::where('usuario','=',$id)->where('municipio_id','=',$request->municipio3)->count();
      $vehiculos = Ruta::where('usuario','=',$id)->where('municipio_id','=',$request->municipio3)->sum('cantVehiculo');
      $costo = Ruta::where('usuario','=',$id)->where('municipio_id','=',$request->municipio3)->sum('costo');
      $electores = Ruta::where('usuario','=',$id)->where('municipio_id','=',$request->municipio3)->sum('electores');
      $meta = Ruta::where('usuario','=',$id)->where('municipio_id','=',$request->municipio3)->sum('meta');
      $view = \View::make('pdf.F3');

      $municipal = repMunicipales::where('usuario',$usuario->id)->where('numeromunicipio',$municipio->numeromunicipio)->get();
$view->representante = "";
      
      $view->cabecera = $cabe;
      $view->distrito = $usuario->distrito;
      $view->municipio = $nombre;
      $view->seccion = $secciones->count();
      $view->ruta = number_format($rutas);
      $view->costo = number_format( $costo);
      if ($municipal->count() > 0) {
        $view->representante = $municipal[0]->nombre;
      }

      
      $view->vehiculos = number_format($vehiculos);
      $view->electores = number_format($electores);
      $view->meta = number_format($meta);
      $view->localidad = number_format($localidades->count());

      return $view;

    }

    function reportef4(Request $request){
     $usuario = \Auth::user();
     $distrito = $usuario->distrito;
      $usuario = \Auth::user();
     if ($usuario->nivel == 53) {
      $cabecera = microregiones::where('distrito','=',$request->distritos4)->get();
        $rmunicipios = microregiones::where('distrito','=',$request->distritos4)->groupby('id_municipio')->lists('id_municipio')->all();


     $cabecera = microregiones::where('distrito',$request->distritos4)->groupby('cabecera')->first();
     }else{
      $cabecera = microregiones::where('distrito','=',$usuario->distrito)->get();
        $rmunicipios = microregiones::where('distrito','=',$distrito)->groupby('id_municipio')->lists('id_municipio')->all();


     $cabecera = microregiones::where('distrito',$distrito)->groupby('cabecera')->first();
     }


   
     $municipiosTotales = array();


     foreach ($rmunicipios as $mun) { 
       $rutas = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->get();

       if($rutas->count()>0){
         $secciones = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->groupby('seccion')->get();
         $localidades = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->groupby('localidad')->get();     

         $vehiculos = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('cantVehiculo');
         $costo = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('costo');
         $electores = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('electores');
         $meta = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('meta');


         $municipios2 = array( 'DISTRITO' => $cabecera["cabecera"], 
           'MUNICIPIOS' => $rutas[0]->municipio, 
           'SECCIONES' => $secciones->count(),
           'RUTA' => number_format($rutas->count()),
           'LOCALIDADES' =>number_format($localidades->count()),
           'VEHICULOS' => number_format($vehiculos),
           'COSTO' => '$'.number_format($costo),
           'ELECTORES' => number_format($electores),
           'META' => number_format($meta)
           );
         array_push($municipiosTotales, $municipios2);

       }

     }   


     $id = $usuario->id;

     $secciones = Ruta::where('usuario','=',$id)->groupby('seccion')->get();
     $municipio = Ruta::where('usuario','=',$id)->groupby('municipio_id')->get();
     $localidades = Ruta::where('usuario','=',$id)->groupby('localidad')->get();
     $rutas = Ruta::where('usuario','=',$id)->count();
     $vehiculos = Ruta::where('usuario','=',$id)->sum('cantVehiculo');
     $costo = Ruta::where('usuario','=',$id)->sum('costo');
     $electores = Ruta::where('usuario','=',$id)->sum('electores');
     $meta = Ruta::where('usuario','=',$id)->sum('meta');


     $view = \View::make('pdf.F4');
     if ($usuario->nivel == 53) {
      $cabecera2 = microregiones::where('distrito','=',$request->distritos4)->get();
     }else{
      $cabecera2 = microregiones::where('distrito','=',$usuario->distrito)->get();
     }
     $cabe2 = $cabecera2[0]->cabecera;
     $view->cabecera = $cabe2;
      if ($usuario->nivel == 53) {
     $view->distrito = $request->distritos4;
     }else{
      $view->distrito = $usuario->distrito;
     }
     

     $view->municipiosTotales = $municipiosTotales;
     $view->seccion = number_format( $secciones->count());
     $view->ruta = number_format( $rutas);
     $view->municipio = number_format($municipio->count());
     $view->costo = number_format($costo);
     $view->vehiculos = number_format($vehiculos);
     $view->electores = number_format($electores);
     $view->meta = number_format($meta);
     $view->localidad = number_format($localidades->count());

     return $view;

   }

   function reportef4get($distrito){
     $usuario = \Auth::user();

     $cabecera = microregiones::where('distrito','=',$distrito)->get();
     $rmunicipios = microregiones::where('distrito','=',$distrito)->groupby('id_municipio')->lists('id_municipio')->all();

     $cabecera = microregiones::where('distrito',$distrito)->groupby('cabecera')->first();
     $municipiosTotales = array();

     $countaux = 0;
     foreach ($rmunicipios as $mun) { 
       $rutas = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->get();

       if($rutas->count()>0){
        $countaux++;
        $secciones = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->groupby('seccion')->get();
        $localidades = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->groupby('localidad')->get();     

        $vehiculos = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('cantVehiculo');
        $costo = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('costo');
        $electores = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('electores');
        $meta = Ruta::where('municipio_id',$mun)->where('usuario','=',$usuario->id)->sum('meta');


        $municipios2 = array( 'DISTRITO' => $cabecera["cabecera"], 
         'MUNICIPIOS' => $rutas[0]->municipio, 
         'SECCIONES' => $secciones->count(),
         'RUTA' => $rutas->count(),
         'LOCALIDADES' => $localidades->count(),
         'VEHICULOS' => $vehiculos,
         'COSTO' => $costo,
         'ELECTORES' => $electores,
         'META' => $meta
         );
        array_push($municipiosTotales, $municipios2);

      }

    }   


    $id = $usuario->id;

    $secciones = Ruta::where('usuario','=',$id)->groupby('seccion')->get();
    $municipio = Ruta::where('usuario','=',$id)->groupby('municipio_id')->get();
    $localidades = Ruta::where('usuario','=',$id)->groupby('localidad')->get();
    $rutas = Ruta::where('usuario','=',$id)->count();
    $vehiculos = Ruta::where('usuario','=',$id)->sum('cantVehiculo');
    $costo = Ruta::where('usuario','=',$id)->sum('costo');
    $electores = Ruta::where('usuario','=',$id)->sum('electores');
    $meta = Ruta::where('usuario','=',$id)->sum('meta');


    $view = \View::make('pdf.F4');
    $cabecera2 = microregiones::where('distrito','=',$distrito)->get();
    $cabe2 = $cabecera2[0]->cabecera;
    $view->cabecera = $cabe2;
    $view->distrito = $distrito;

    
    $municipios2 = array(  'DISTRITO' => '<strong> TOTAL</strong>', 
     'MUNICIPIOS' => '<strong>'.$countaux.'</strong>', 
     'SECCIONES' => '<strong>'.$secciones->count().'</strong>',
     'RUTA' => $rutas,
     'LOCALIDADES' => $localidades->count(),
     'VEHICULOS' => $vehiculos,
     'COSTO' => $costo,
     'ELECTORES' => $electores,
     'META' => $meta
     );
    array_push($municipiosTotales, $municipios2);

    return $municipiosTotales;

  }

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
