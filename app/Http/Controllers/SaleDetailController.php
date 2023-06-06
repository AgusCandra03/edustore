<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sales;
use App\Models\Member;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleDetailController extends Controller
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
        $products = Product::all();
        $users = User::all();
        $members = Member::all();

        return view('admin.details', compact('sales', 'products', 'users', 'members'));
    }

    public function api(Request $request)
    {
        $sales = Sales::with('users', 'members', 'sale_details.products')->get();
        $datatables = datatables()->of($sales)
        ->addColumn('date', function ($sales) {
            return convert_date($sales->created_at);
        })
        ->addColumn('total_product', function ($row) {
            return $row->sale_details->count();
        })
        ->addColumn('member_name', function ($row) {
            if ($row->member_id == null) {
                return '-';
            } else {
                return $row->members->name;
            }
        })
        ->addIndexColumn();
        return $datatables->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function nota($id)
    {
        $sale = Sales::with(['sale_details'])->find($id);
        $pdf = Pdf::loadView('admin.nota', ['sale' => $sale]);

        // to preview
        return $pdf->stream('nota.pdf');

        // to download
        // return $pdf->download('nota.pdf');
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleDetail $saleDetail)
    {
        //
    }
}
