<?php

namespace App\Http\Controllers;

use App\categoryMember;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

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
        $total_product = Product::count();
        $total_supplier = Supplier::count();
        $total_member = Member::count();
        $total_user = User::count();
        return view('home', compact('total_product','total_supplier', 'total_member', 'total_user'));
    }
}
