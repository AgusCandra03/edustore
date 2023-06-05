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
        // $details = SaleDetail::with('users', 'products', 'sales.users', 'sales.members')->get();
        $details = SaleDetail::with('sales', 'products', 'sales.users', 'sales.members');
        $datatables = datatables()->of($details)
            ->addColumn('date', function ($details) {
                return convert_date($details->created_at);
            })
            ->addIndexColumn();

        return $datatables->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function printDetail()
    {
        $details = SaleDetail::with(['sales', 'sales.users'])->get();

        $pdf = Pdf::loadView('admin/printDetail', ['sale_details' => $details]);
        return $pdf->stream('ReportSales.pdf');
    }

    public function receipt()
    {
        $details = SaleDetail::with(['sales', 'sales.users'])->get();

        $pdf = Pdf::loadView('admin/receipt', ['sale_details' => $details]);
        return $pdf->download('Receipt.pdf');
    }

    public function nota($id)
    {
        $sale = Sales::with(['sale_details'])->find($id);
        $pdf = Pdf::loadView('admin.nota', ['sale' => $sale]);

        // to preview
        // return $pdf->stream();

        // to download
        return $pdf->download('nota.pdf');
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
