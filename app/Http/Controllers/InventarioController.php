<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use App\Models\Inventario;
use App\Models\Location;
use App\Models\Unit;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class InventarioController
 * @package App\Http\Controllers
 */
const maximo=85;
 class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
    {
        $max=config('constants.max');
        $inventarios = Inventario::paginate(500);
        $productos=Producto::Latest()->get();
        $locations=Location::Latest()->get();
      
        $units=Unit::Latest()->get();

        return view('inventario.index', compact('inventarios','units','locations','productos','max'))
            ->with('i', (request()->input('page', 1) - 1) * $inventarios->perPage());
    }
    public function inventarios($id)
    {
        $max=config('constants.max');
        $inventarios = Inventario::where('locations_id',$id)->paginate(500);
        $productos=Producto::Latest()->get();
        $locations=Location::Latest()->get();
        $location=Inventario::where('locations_id',$id)->first();
        $name=$location->locations->descripcion;
        $units=Unit::Latest()->get();

        return view('inventario.index', compact('name','inventarios','units','locations','productos','max'))
            ->with('i', (request()->input('page', 1) - 1) * $inventarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventario = new Inventario();
        $productos=Producto::Latest()->get();
        $locations=Location::Latest()->get();
        $units=Unit::Latest()->get();
        return view('inventario.create', compact('inventario','locations','units','productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Inventario::$rules);
        $id_unit=$request->units_id;
        $cantidad=$request->cantidad;
        $piezas=$this->calculo_unitario($id_unit,$cantidad);
        $total_unitario=$piezas;
        $denominador=$this->calculo_denominador($id_unit);
        $paquetes=$piezas/$denominador;
        $inventario = Inventario::create([
            'productos_id' => $request->productos_id,
            'cantidad' => $paquetes,
            'units_id' => $request->units_id,
            'locations_id' => $request->locations_id,
            'piezas' => $piezas,

        ]);

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventario = Inventario::find($id);

        return view('inventario.show', compact('inventario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $inventario = Inventario::find($id);
        $productos=Producto::Latest()->get();
        $locations=Location::Latest()->get();
        $units=Unit::Latest()->get();
        return view('inventario.edit', compact('inventario','productos','locations','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Inventario $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
       // dd($request);
        request()->validate(Inventario::$rules);
        $id_unit=$request->units_id;
        $cantidad=$request->cantidad;
        $piezas=$this->calculo_unitario($id_unit, $cantidad);
        $total_unitario=$inventario->piezas+$piezas;
        $denominador=$this->calculo_denominador($id_unit);
        $total_paquete=$total_unitario/$denominador;
        
        
        $inventario->update([
            //'units_id' => $id_unit,
            'cantidad' => $total_paquete,
            'piezas' => $total_unitario,
        ]);

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $inventario = Inventario::find($id)->delete();

        return redirect()->route('inventarios.index')
            ->with('success', 'Inventario deleted successfully');
    }
    public function calculo_unitario($id_unit,$cantidad)
    {
        //si no existe el inventrio
        
        //si existe el inventario
        $unidad=Unit::find($id_unit);
        $piezas=$unidad->piezas*$cantidad;
        return $piezas; 
    }
    public function calculo_denominador($id_unit)
    {
        switch ($id_unit)
         {
            case 1:
                $denominador=15;
                break;
            case 2:
                $denominador=100;
                break;
            case 5:
                    $denominador=15;
                    break;
            default:
                $denominador=1;
        }
        return $denominador;
    }
}
