<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // function to redirect and get all products
    public function viewProducts()
    {
        $products = DB::table('products')->get();

        return view('admin.product.products', compact('products'));
    }

    // function to store data in product table
    public function saveProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:50',
            'productType' => 'required',
            'product_number' => 'required',
            'nshCode' => 'required',
            'productWeight' => 'required',
            'purity' => 'required',
            'product_price' => 'required',
            'makingCharges' => 'required',
            'holeMarkCharges' => 'required',
            'product_qty' => 'required',
        ]);

        $productData = [
            'product_name' => $request->product_name,
            'item_type' => $request->productType,
            'product_number' => $request->product_number,
            'nsh_code' => $request->nshCode,
            'product_weight' => $request->productWeight,
            'purity' => $request->purity,
            'product_price' => $request->product_price,
            'making_charge' => $request->makingCharges,
            'hole_mark_charge' => $request->holeMarkCharges,
            'product_qty' => $request->product_qty,
            'created_at' => now(),
        ];

        $insertData = DB::table('products')->insert($productData);

        if($insertData) {
            return redirect()->route('admin.product.products')->with('success', 'Your data submitted successfully');
        } else {
            return redirect()->route('admin.product.products')->withErrors(['msg' => 'Something went wrong while submitting form']);
        }
    }

    // function to redirect on edit page
    public function editProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        return view('admin.product.editProduct', compact('product'));
    }

    // function to update product details
    public function updateProduct(Request $request)
    {
        $productId = $request->productID;

        $updateArray = [
            'product_name' => $request->product_name,
            'item_type' => $request->productType,
            'product_number' => $request->product_number,
            'nsh_code' => $request->nshCode,
            'product_weight' => $request->productWeight,
            'product_price' => $request->product_price,
            'making_charge' => $request->makingCharges,
            'hole_mark_charge' => $request->holeMarkCharges,
            'product_qty' => $request->product_qty,
            'purity' => $request->purity
        ];

        $updateProduct = DB::table('products')->where('id', $productId)->update($updateArray);

        if($updateProduct) {
            return redirect()->route('admin.product.products')->with('success', 'Product detail updated successfully');
        } else {
            return redirect()->route('admin.product.products')->withErrors(['msg' => 'Something went wrong while updating product detail, please try again']);
        }
    }

    // function to delete product'
    public function deleteProduct($id)
    {
        $deleteProduct =  DB::table('products')->where('id', $id)->delete();

        if($deleteProduct) {
            return redirect()->back()->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Something went wrong while deleting product detail, please try again']);
        }   
    }
}
