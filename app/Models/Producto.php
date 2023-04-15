<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Marca;
use App\Models\Tipo;
use App\Models\Colore;

/**
 * Class Producto
 *
 * @property $id
 * @property $contenido
 * @property $marcas_id
 * @property $tipos_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'contenido' => 'required',
		'marcas_id' => 'required',
		'colores_id' => 'required',
    'tipos_id' => 'required',
    'precio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['contenido','marcas_id','tipos_id','proveedores_id','colores_id','precio'];

    public function marcas()
    {
  
      return $this->HasOne(Marca::class,'id','marcas_id');//relacion con tipos
  
    }
    public function tipos()
    {
  
      return $this->HasOne(Tipo::class,'id','tipos_id');//relacion con tipos
  
    }
    public function colores()
    {
  
      return $this->HasOne(Colore::class,'id','colores_id');//relacion con colores
  
    }



}
