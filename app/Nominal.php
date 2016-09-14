<?php

namespace RUTAS;

use Illuminate\Database\Eloquent\Model;

class Nominal extends Model
{
 	protected $table = "listado_nominal";
 	protected $primaryKey = "ID";
 	protected $fillable = ['nombre','apellidop','apellidom','domicilio','clave_elector','telefono','numruta','seccion', 'telefono2', 'telefono3', 'descripcion', 'usuario','municipio_id','tipoUsuario'];

 	public $timestamps =false;
}
