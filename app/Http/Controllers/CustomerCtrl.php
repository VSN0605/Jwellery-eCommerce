<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerCtrl extends Controller
{
    // function to store data in customers table;
    public function saveCustomer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            // 'custom_email' => 'required|string|max:30',
            'contact_num' => 'required|digits:10',
            'address' => 'required|string|max:200'
        ]);

        $customerData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->custom_email,
            'contact_no' => $request->contact_num,
            'address' => $request->address,
            'created_at' => now(),
        ];

        $insertData = DB::table('customers')->insert($customerData);

        if($insertData) {
            return redirect()->route('admin.customer.customers')->with('success', 'Your data submitted successfully'); 
        } else {
            return redirect()->route('admin.customer.customers')->withErrors(['msg' => 'Something went wrong while submitting form']);
        }
    }

    // function to get data from customers table and redirect on view all customers page
    public function viewCustomers()
    {
        $customers = DB::table('customers')->get();

        return view('admin.customer.customers', compact('customers'));
    }

    // function to delete entry from table
    public function deleteCustomer($id)
    {
        $deleteCustomer = DB::table('customers')->where('id', $id)->delete();

        if($deleteCustomer) {
            return redirect()->back()->with('success', 'Customer entry deleted successfully');
        } else {
           return redirect()->back()->withErrors(['msg' => 'Something went wrong while deleting customer detail, please try again']); 
        }
    }

    // function to edit customer
    public function editCustomer($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();

        return view('admin.customer.editCustomer', compact('customer'));
    }

    // function to update customer data
    public function updateCustomer(Request $request)
    {
        $customerID = $request->customerID;

        $updateArray = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->custom_email,
            'contact_no' => $request->contact_num,
            'address' => $request->address,
        ];

        $updateCustomer = DB::table('customers')->where('id', $customerID)->update($updateArray);

        if($updateCustomer) {
            return redirect()->route('admin.customer.customers')->with('success', 'Customer details updated successfully');
        } else {
            return redirect()->route('admin.customer.customers')->withErrors(['msg' => 'Something went wrong while updating entry, please try again']);
        }
    }
}
