<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Provedore;

/**
 * Class Marca
 *
 * @property $id
 * @property $contenido
 * @property $proveedores_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Marca extends Model
{
    
    static $rules = [
		'contenido' => 'required',
		'proveedores_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['contenido','proveedores_id'];


    public function proveedores()
    {
  
      return $this->HasOne(Proveedore::class,'id','proveedores_id');//relacion con proveedores
  
    }

}
