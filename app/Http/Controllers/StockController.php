<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Product::all();
        $suppliers= Supplier::all();
        return view('admin.stock',compact('products','suppliers'));
    }

    public function api()
    {
        $stoks = Stock::with('products', 'suppliers')->get();
        $datatables = datatables()->of($stoks)->addIndexColumn();
        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date_entry'  => 'required',
            'product_id'  => 'required',
            'supplier_id'  => 'required',
            'note' => 'required',
            'qty' => 'required',
        ]);

        $stock = Stock::create($request->all());
        $product = Product::find($request->product_id);
        $product->stock = $product->stock + $request->qty;
        $product->save();
        return redirect('stocks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        // $this->validate($request, [
        //     'date_entry'  => 'required',
        //     'product_id'  => 'required',
        //     'supplier_id'  => 'required',
        //     'note' => 'required',
        //     'qty' => 'required',
        // ]);

        // $stock->update($request->all());
        // return redirect('stocks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        
        $stock->delete();
    }
}
