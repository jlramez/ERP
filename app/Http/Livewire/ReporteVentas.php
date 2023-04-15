<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Addventaproduct;
use App\Models\Sale;
class ReporteVentas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $fecha_inicial, $fecha_final, $info_id, $productos_top, $ventas_top;
    public function render()
    {
        
    $fecha = Carbon::parse(now());
    $mfecha = $fecha->month;
    $dfecha = $fecha->day;
    $afecha = $fecha->year;
        
        $venta_hoy = Sale::selectRaw('SUM(total) as suma_total')->selectRaw('SUM(noarticulos) as suma_articulos')
        ->whereDay('fecha', $dfecha)->first();
        $venta_mes=  Sale::selectRaw('SUM(total) as suma_total')->selectRaw('SUM(noarticulos) as suma_articulos')
        ->whereMonth('fecha', $mfecha)->first();
        $venta_year= Sale::selectRaw('SUM(total) as suma_total')->selectRaw('SUM(noarticulos) as suma_articulos')
        ->whereYear('fecha', $afecha)->first();
       
   
        if($this->fecha_inicial && $this->fecha_final)
        {
            $top_v= Sale::where('fecha','>=',$this->fecha_inicial)
            ->where('fecha','<=',$this->fecha_final)
            ->orderBy('total','desc')->take(5)->get();

            $top_p= Addventaproduct::groupBy('productos_id')
            ->selectRaw('productos_id,count(productos_id) as total')
            ->orderBy("total", "desc")
            ->join('sales','sales_id','=','sales.id')
            ->where('fecha','>=',$this->fecha_inicial)
            ->where('fecha','<=',$this->fecha_final)
            ->take(5)->get();

            $venta_rango=Sale::
            selectRaw('SUM(total) as suma_total')
            ->where('fecha','>=',$this->fecha_inicial)
            ->where('fecha','<=',$this->fecha_final)
            ->first();

        }
        else{
            $top_v= Sale::where('fecha','>=',$dfecha)
            ->where('fecha','<=', $dfecha)
            ->orderBy('total','desc')->get();

           
            $top_p= Addventaproduct::groupBy('productos_id')
            ->selectRaw('productos_id,count(productos_id) as total')
            ->orderBy("total", "desc")
            ->join('sales','sales_id','=','sales.id')
            ->where('fecha','>=',$dfecha)
            ->where('fecha','<=',$dfecha)
            ->take(5)->get();

            $venta_rango=Sale::
            selectRaw('SUM(total) as suma_total')
            ->where('fecha','>=',now())
            ->where('fecha','<=',now())
            ->first();
        }
        $this->productos_top=$top_p;
        $this->ventas_top=$top_v;
       
        if($this->productos_top)
        {
            return view('livewire.reporteventas.reporte', [
                'productos' => $this->productos_top,
                'ventas' => $this->ventas_top,
                'venta_hoy' => $venta_hoy,
                'venta_mes' => $venta_mes,
                'venta_year' => $venta_year,
                'venta_rango' => $venta_rango,
                'fecha_1' => $this->fecha_inicial,
                'fecha_2' => $this->fecha_final,
            ]);
        }  
    }

    public function calcular()
    {
    $top_p= Addventaproduct::groupBy('productos_id')
                    ->selectRaw('productos_id,count(productos_id) as total')
                    ->orderBy("total", "desc")->get();
    $top_v= Sale::where('fecha','>=',$this->fecha_inicial)
                  ->where('fecha','<=',$this->fecha_final)
                  ->orderBy('total','desc')->get();
    $this->ventas_top=$top_v;
    
    
    $this->productos_top=$top_p;
    }
    
}
