<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingCtrl extends Controller
{
    public function viewBillings()
    {
        $billings = DB::table('billing')->get();
        return view('admin.billing.billing', compact('billings'));
    }
}
