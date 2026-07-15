<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardCtrl extends Controller
{
    public function viewDashboard()
    {
        $billings = DB::table('billing')->count();
        $totalSale = DB::table('billing')->sum('total_price');

        $productQty = DB::table('products')->sum('product_qty');
        return view('admin/index', compact('billings', 'totalSale', 'productQty'));
    }
}