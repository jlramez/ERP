<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;

/**
 * Class TradeController
 * @package App\Http\Controllers
 */
class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trades = Trade::paginate();

        return view('trade.index', compact('trades'))
            ->with('i', (request()->input('page', 1) - 1) * $trades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trade = new Trade();
        return view('trade.create', compact('trade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Trade::$rules);

        $trade = Trade::create($request->all());

        return redirect()->route('trades.index')
            ->with('success', 'Trade created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trade = Trade::find($id);

        return view('trade.show', compact('trade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trade = Trade::find($id);

        return view('trade.edit', compact('trade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Trade $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        request()->validate(Trade::$rules);

        $trade->update($request->all());

        return redirect()->route('trades.index')
            ->with('success', 'Trade updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $trade = Trade::find($id)->delete();

        return redirect()->route('trades.index')
            ->with('success', 'Trade deleted successfully');
    }
}
