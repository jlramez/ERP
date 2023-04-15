<?php

namespace App\Http\Controllers;

use App\Models\Addproductopedido;
use App\Models\Pedido;
use App\Models\Inventario;
use App\Models\Producto;
use App\Exports\AddproductopedidoExport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Http\Request;

/**
 * Class AddproductopedidoController
 * @package App\Http\Controllers
 */
class AddproductopedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export($id) 
    {
        ob_end_clean();
        //return Excel::download(new AddproductopedidoExport,$id, 'addproductospedidos.xlsx');
        return (new AddproductopedidoExport($id))->download('productos_pedido.xlsx');
    }
     public function index()
    {
        $addproductopedidos = Addproductopedido::paginate();

        return view('addproductopedido.index', compact('addproductopedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $addproductopedidos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $addproductopedido = new Addproductopedido();
        return view('addproductopedido.create', compact('addproductopedido'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Addproductopedido::$rules);   
        $addproductopedido = Addproductopedido::create($request->all());
        return redirect()->route('addproductopedido.addproductos',$request->pedidos_id)
            ->with('success', 'Addproductopedido created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addproductopedido = Addproductopedido::find($id);

        return view('addproductopedido.show', compact('addproductopedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addproductos($id)
    {
        
        $bottom_stock=config('constants.bottom_stock');
        $pedido=Pedido::find($id);
        $productos= Inventario::where('piezas','<=',$bottom_stock)->get();
        $addproductopedido=Addproductopedido::where('pedidos_id',$id)->paginate();
        return view('addproductopedido.addproduct', compact('pedido','productos','addproductopedido'))
        ->with('i', (request()->input('page', 1) - 1) * $addproductopedido->perPage());
    }
     public function edit($id)
    {
        $addproductopedido = Addproductopedido::find($id);
        $productos=Producto::all();

        return view('addproductopedido.edit', compact('addproductopedido','productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Addproductopedido $addproductopedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Addproductopedido $addproductopedido)
    {
        request()->validate(Addproductopedido::$rules);
        $addproductopedido->update($request->all());
        return redirect()->route('addproductopedido.addproductos',$addproductopedido->pedidos_id);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
      
        $addproductopedido=Addproductopedido::find($id);
        $pedidos= Pedido::find($addproductopedido->pedidos_id);
        $delete=$addproductopedido->delete();    
        return redirect()->route('addproductopedido.addproductos',$addproductopedido->pedidos_id)
            ->with('success', 'Addproduct deleted successfully');
    }
}
