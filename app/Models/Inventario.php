<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Unit;
use App\Models\Location;

/**
 * Class Inventario
 *
 * @property $id
 * @property $poductos_id
 * @property $cantidad
 * @property $units_id
 * @property $locations_id
 * @property $created_at
 * @property $updated_at
 * @property $piezas
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inventario extends Model
{
    
    static $rules = [
		'productos_id' => 'required',
		'cantidad' => 'required',
		'units_id' => 'required',
		'locations_id' => 'required',
   
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['productos_id','cantidad','units_id','locations_id','piezas'];

    public function productos()
    {
  
      return $this->HasOne(Producto::class,'id','productos_id');//relacion con tipos
  
    }

    public function locations()
    {
  
      return $this->HasOne(Location::class,'id','locations_id');//relacion con tipos
  
    }

    public function units()
    {
  
      return $this->HasOne(Unit::class,'id','units_id');//relacion con tipos
  
    }



}
