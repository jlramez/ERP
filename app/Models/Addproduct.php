<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

/**
 * Class Addproduct
 *
 * @property $id
 * @property $requriments_id
 * @property $productos_id
 * @property $solicitados
 * @property $transferidos
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Addproduct extends Model
{
    
    static $rules = [
		'productos_id' => 'required',
		'solicitados' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['requeriments_id','productos_id','solicitados','transferidos','surtido'];

    public function productos()
    {
  
      return $this->HasOne(Producto::class,'id','productos_id');//relacion con tipos
  
    }


}
