<?php

namespace App\Http\Controllers;

use App\Models\Addproduct;
use App\Models\Producto;
use App\Models\Requeriment;
use App\Models\Inventario;
use Illuminate\Http\Request;

/**
 * Class AddproductController
 * @package App\Http\Controllers
 */
class AddproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addproducts = Addproduct::paginate();

        return view('addproduct.index', compact('addproducts'))
            ->with('i', (request()->input('page', 1) - 1) * $addproducts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $requeriments=Requeriment::find($id);
        $addproduct = new Addproduct();
        $productos= Producto::all();
        $addproducts=Addproduct::where('requeriments_id',$id)->paginate();
        return view('addproduct.add', compact('addproducts','addproduct','productos','requeriments'))
        ->with('i', (request()->input('page', 1) - 1) * $addproducts->perPage());
    }
    public function list($id)
    {
        $requeriments=Requeriment::find($id);
        $addproduct = new Addproduct();
        $productos= Producto::all();
        $addproducts=Addproduct::where('requeriments_id',$id)->paginate();
       

        return view('addproduct.reqdetail', compact('addproducts','addproduct','productos','requeriments'))
        ->with('i', (request()->input('page', 1) - 1) * $addproducts->perPage());
    }
     public function create()
    {
        $addproduct = new Addproduct();
        return view('addproduct.create', compact('addproduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        request()->validate(Addproduct::$rules);

        $addproduct = Addproduct::create($request->all());

        return redirect()->route('addproducts.add',$request->requeriments_id)
            ->with('success', 'Addproduct created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addproduct = Addproduct::find($id);

        return view('addproduct.show', compact('addproduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addproduct = Addproduct::find($id);
        $productos= Producto::all();

        return view('addproduct.edit', compact('addproduct','productos'));
    }
    public function transfer($id)
    {
        $addproduct = Addproduct::find($id);
        $productos= Producto::all();

        return view('addproduct.transfer', compact('addproduct','productos'));
    }
    public function cancel($id)
    {
        $addproduct = Addproduct::find($id);
        $productos= Producto::all();

        return view('addproduct.cancel', compact('addproduct','productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Addproduct $addproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Addproduct $addproduct)
    {
        request()->validate(Addproduct::$rules);
        $addproduct->update($request->all());

        return redirect()->route('addproducts.add',$addproduct->requeriments_id)
            ->with('success', 'Addproduct updated successfully');
  
    }
    public function update_transfer(Request $request, Addproduct $addproduct)
    {
        request()->validate(Addproduct::$rules);
        $inventarios=Inventario::where('productos_id',$request->productos_id)->first();
        $stock=Inventario::where('productos_id',$request->productos_id)
                ->where('locations_id',2)->first();
        $transferencia=$inventarios->piezas - $request->transferidos;
        if($request->transferidos>0)
        {
            if($transferencia>=0)
            {
               $inventarios->piezas = $transferencia;
               $inventarios->save();
                if ($stock)
                {
                    $stock_total=$stock->piezas+$request->transferidos;
                    $stock->update([
                        'piezas' => $stock_total,
                    ]);
                }
                else
                {
                    
                    $inventario= new Inventario;
                    $inventario->create([
                        'productos_id' => $inventarios->productos_id,
                        'cantidad' => 0,
                        'piezas' => $request->transferidos,
                        'units_id' => $inventarios->units_id,
                        'locations_id' => 2

                    ]);
                }
            }
        }
        else
        {
            return redirect()->route('addproducts.list',$addproduct->requeriments_id)
            ->with('success', 'Solicita 0 , cambie número. ');
        }
        if ($transferencia<0)
        {
            return redirect()->route('addproducts.list',$addproduct->requeriments_id)
            ->with('success', 'No existe inventario suficiente');
        }
        $addproduct->update($request->all());
        $addproduct->surtido= 1 ;
        $addproduct->save();
        $nosurtidos=Addproduct::where('requeriments_id',$addproduct->requeriments_id)->where('surtido','!=',0)->count();
        $nototalprods=Addproduct::where('requeriments_id',$addproduct->requeriments_id)->count();
        $requeriment=Requeriment::find($addproduct->requeriments_id);
        $requeriment->surtidos=$nosurtidos;
        $requeriment->total_prods=$nototalprods;
        if ($requeriment->total_prods==0)
        {
            $total_prods=1;
            $cumplimiento=$requeriment->surtidos/$total_prods;
        }
        else 
        {
            $cumplimiento=$requeriment->surtidos/$requeriment->total_prods;
        }
        if($cumplimiento==0)
           {
            $requeriment->cumplimiento=0;//pendiente
           }
           if($cumplimiento<1)
           {
            $requeriment->cumplimiento=1;//incompleto
           }
           if($cumplimiento==1)
           {
            $requeriment->cumplimiento=2;//Completada
           }
        $requeriment->save();


        return redirect()->route('addproducts.list',$addproduct->requeriments_id)
            ->with('success', 'Addproduct updated successfully');
    }
    public function cancel_transfer(Request $request, Addproduct $addproduct)
    {
        request()->validate(Addproduct::$rules);
        $inventarios=Inventario::where('productos_id',$request->productos_id)->first();
        $stock=Inventario::where('productos_id',$request->productos_id)
                ->where('locations_id',2)->first();
        $transferencia=$inventarios->piezas + $request->transferidos;
        if($request->transferidos>0)
        {
            if ($request->transferido>$stock->piezas) //ojo aqui decimales '==0'
            {
               return redirect()->route('addproducts.list',$addproduct->requeriments_id)
               ->with('success', 'No existen inventario SUFICIENTE  para cancelación en piso de venta');
            }
            if ($stock->piezas==0) //ojo aqui decimales '==0'
            {
               return redirect()->route('addproducts.list',$addproduct->requeriments_id)
               ->with('success', 'No existe inventario');
            }
            if ($stock->piezas<1) //ojo aqui decimales '==0' VERIFICAR QUE EXISTAN PIEZAS COMPLETAS EN PISO DE VENTA
             {
                return redirect()->route('addproducts.list',$addproduct->requeriments_id)
                ->with('success', 'No existen piezas COMPLETAS para cancelación');
             }
            if($stock->piezas>1) //ojo aqui decimales '>0' SI EXISTE ALGUNA
            {
               $inventarios->piezas = $transferencia;
               $inventarios->save();
               $addproduct->transferidos = 0;
               $addproduct->surtido=0;
               $addproduct->save();
               $requeriment=Requeriment::find($addproduct->requeriments_id);
               $nosurtidos=Addproduct::where('requeriments_id',$addproduct->requeriments_id)->where('surtido','!=',0)->count();
               $requeriment->surtidos=$nosurtidos;
               $requeriment->save();
               $nototalprods=$requeriment->total_prods;
               

               if ($nototalprods==0)
               {
                   $total_prods=1;
                   $cumplimiento=$requeriment->surtidos/$total_prods;
               }
               else 
               {
                   $cumplimiento=$requeriment->surtidos/$nototalprods;
               }
               if($cumplimiento==0)
                  {
                    $requeriment->cumplimiento=0; //pendiente
                  }
                  if($cumplimiento<1 && $nosurtidos != 0)
                  {
                   $requeriment->cumplimiento=1;//incompleto
                  }
                  if($cumplimiento==1)
                  {
                   $requeriment->cumplimiento=2;//Completada
                  } 
                   $requeriment->save();
        

                if ($stock)
                {
                    $stock_total=$stock->piezas-$request->transferidos;
                    $stock->update([
                        'piezas' => $stock_total,
                    ]);
                    return redirect()->route('addproducts.list',$addproduct->requeriments_id)
                    ->with('success', 'Addproduct updated successfully');
                }
                /*else
                {
                    
                    $inventario= new Inventario;
                    $inventario->create([
                        'productos_id' => $inventarios->productos_id,
                        'cantidad' => 0,
                        'piezas' => $request->transferidos,
                        'units_id' => $inventarios->units_id,
                        'locations_id' => 2

                    ]);
                }*/
            }
        }
        else
        {
            return redirect()->route('addproducts.list',$addproduct->requeriments_id)
            ->with('success', 'Cancela 0 , cambie número. ');
        }
        /*if ($transferencia<0)
        {
            return redirect()->route('addproducts.list',$addproduct->requeriments_id)
            ->with('success', 'No existe inventario suficiente');
        }*/
        /* $addproduct->update($request->all());    

        return redirect()->route('addproducts.list',$addproduct->requeriments_id)
            ->with('success', 'Addproduct updated successfully AQUI');*/
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $addproduct = Addproduct::find($id);
        $requeriments= Requeriment::find($addproduct->requeriments_id);
        $delete=$addproduct->delete();    
        return redirect()->route('addproducts.add',$requeriments->id)
            ->with('success', 'Addproduct deleted successfully');
    }
    public function cumplimiento()
    {
        
    }
}
