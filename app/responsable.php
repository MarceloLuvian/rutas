<?php

namespace RUTAS;

use Illuminate\Database\Eloquent\Model;

class responsable extends Model
{
   protected $table = "responsables";
 	protected $primaryKey = "id";
 	protected $fillable = ['nombre', 'distrito', 'seccion' , 'municipio' , 'numruta' , 'usuario','tipoUsuario'];

 	public $timestamps =false;
}
