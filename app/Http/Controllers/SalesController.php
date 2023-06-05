<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
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
        $sales = Sales::all();
        // return $sales;

        $users = User::all();
        $members = Member::all();
        $sale_details = SaleDetail::all();
        $products = Product::all();
        return view('admin.sales', compact('users', 'members', 'sale_details', 'products'));
    }

    public function api()
    {
        $sales = Sales::with('users', 'members', 'sale_details.products')->get();
        $datatables = datatables()->of($sales)->addIndexColumn();
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
        try {
            $input = $request->all();

            $sale = Sales::create([
                'user_id' => auth()->user()->id,
                'member_id' => $input['member_id'],
                'total' => $input['grandtotal'],
                'status' => 0,
            ]);

            foreach ($request['sales'] as $sales) {
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $sales['product']['id'],
                    'qty' => $sales['qty']
                ]);
            }

            return response()->json([
                'message' => 'success',
                'sale' => $sale
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
