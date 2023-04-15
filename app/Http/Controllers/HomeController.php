<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Sale;
use App\Models\Inventario;
use carbon\carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fecha = Carbon::parse(now());
        $mfecha = $fecha->month;
        $dfecha = $fecha->day;
        $afecha = $fecha->year;
        $venta_mes=  Sale::selectRaw('SUM(total) as suma_total')->selectRaw('SUM(noarticulos) as suma_articulos')
        ->whereMonth('fecha', $mfecha)->first();
        $venta_mes_anterior=  Sale::selectRaw('SUM(total) as suma_total')->selectRaw('SUM(noarticulos) as suma_articulos')
        ->whereMonth('fecha', $mfecha-1)->first();
        $venta_total=$venta_mes_anterior->suma_total+$venta_mes->suma_total;
        $comparativa_mes_anterior=(($venta_mes->suma_total-$venta_mes_anterior->suma_total)/$venta_total)*100;
        //dd($pventa1,$pventa2,$comparativa_mes_anterior);
        $noproductos=Producto::all()->count();
        $noproductos=Producto::all()->count();
        $productosoff=Inventario::where('piezas','<=',2)->count();
        $noproductos_pv=Inventario::where('locations_id',2)->count();
      

        return view(('home'),compact('noproductos','venta_mes','productosoff','noproductos_pv','venta_mes_anterior','comparativa_mes_anterior'));
    }
}
