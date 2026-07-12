<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingCtrl extends Controller
{
    // function to reidrect and get all billing data on view billing page
    public function viewBillings()
    {
        $billings = DB::table('billing')->get();
        return view('admin.billing.billing', compact('billings'));
    }

    // function to get all the products in create bill page
    public function getProducts()
    {
        $products = DB::table('products')->select('id', 'product_name', 'product_price', 'product_qty')->get();
        return view('admin.billing.createBill', compact('products'));
    }

    // function to submit billing data
    public function submitBillingData(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'mobile_number' => 'required|digits:10',
            'address' => 'required|string|max:200',
            'selected_products' => 'required|array',
            'selected_products.*' => 'required|exists:products,id',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'product_gst' => 'nullable|numeric|min:0|max:100',
            'total_price' => 'required|numeric|min:0',
        ]);

        // Serialize array data for database storage
        $selectedProducts = serialize($request->selected_products);
        $selectedProductQty = serialize($request->qty);
        $selectedProductPrice = serialize($request->price);

        $invoiceData = [
            'customer_name'    => $request->customer_name,
            'contact_no'       => $request->mobile_number,
            'address'          => $request->address,
            'purchase_product' => $selectedProducts,
            'product_qty'      => $selectedProductQty,
            'product_price'    => $selectedProductPrice,
            'subtotal'         => $request->sub_total,
            'discount'         => $request->discount ?? 0,
            'gst'              => $request->product_gst ?? 0,
            'total_price'      => $request->total_price,
            'created_at'       => now(),
            'updated_at'       => now(),
        ];

        $insertData = DB::table('billing')->insert($invoiceData);

        $customerData = DB::table('customers')->where('contact_no', $request->mobile_number)->first();
        $parts = explode(" ", trim($request->customer_name), 2);
        $firstName = $parts[0];
        $lastName = isset($parts[1]) ? $parts[1] : '';

        if(!$customerData) {
            $customerInfo = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => '',
                'contact_no' => $request->mobile_number,
                'address' => $request->address,
                'created_at' => now(),
            ];

            $insertCustomerData = DB::table('customers')->insert($customerInfo);
        }

        if ($insertData) {
            return redirect()
                ->route('admin.billing.billing')
                ->with('success', 'Billing data submitted successfully.');
        }

        return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'msg' => 'Something went wrong while submitting the form.'
            ]);
    }

    public function getInvoice($id)
    {
        $invoiceData = DB::table('billing')->where('id', $id)->first();

        return view('admin.billing.printInvoice', compact('invoiceData'));
    }
}
