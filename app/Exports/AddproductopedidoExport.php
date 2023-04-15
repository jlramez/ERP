<?php
namespace App\Exports;
use App\Models\Addproductopedido;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class AddproductopedidoExport implements FromQuery
{
    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        /*$tareas=Tarea::join('actividades','actividades_id', '=', 'actividades.id')
        ->join('areas','areas.id', '=','actividades.areas_id')
        ->where('areas.id','=',$area_id)
        -> select('tareas.*')*/
        return Addproductopedido::query()->select('marcas.contenido','productos.contenido as pc'
        ,'tipos.descripcion as td','colores.descripcion as cd','colores.clave','cantidad')
        ->join('productos','productos_id','=','productos.id')
        ->join('marcas','marcas_id','=','marcas.id')
        ->join('tipos','tipos_id','=','tipos.id')
        ->join('colores','colores_id','=','colores.id')
        ->where('addproductopedidos.pedidos_id', $this->id);
    }
}
