<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerCtrl;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillingCtrl;

Route::get('/', function() {
    return view('index');
});

Route::get('/register', function() {
    return view('register');
});

Route::post('register/store', [registrationController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['role', 'prevent-back-history'])->group(function () {
    Route::get('/admin/index', function() {
        if(!session()->has('user_id')) {
            return view('index');
        }
        return view('admin.index');
    });

    // customer routes
    Route::get('admin/customer/createCustomer', function() {
        return view('admin.customer.createCustomer');
    });
    Route::get('admin/customer/createCustomer', [CustomerCtrl::class, 'createCustomer'])->name('admin.customer.createCustomer');
    Route::get('admin/customer/customers', [CustomerCtrl::class, 'viewCustomers'])->name('admin.customer.customers');
    Route::delete('admin/customers/deleteCustomer/{id}', [CustomerCtrl::class, 'deleteCustomer'])->name('admin.customers.deleteCustomer');
    Route::get('admin/customer/editCustomer/{id}', [CustomerCtrl::class, 'editCustomer'])->name('admin.customer.editCustomer');
    Route::post('admin/customer/updateCustomer', [CustomerCtrl::class, 'updateCustomer'])->name('admin.customer.updateCustomer');
    
    // products routes
    Route::get('admin/product/products', [ProductController::class, 'viewProducts'])->name('admin.product.products');
    Route::get('admin/product/createProduct', function() {
        return view('admin.product.createProduct');
    });
    Route::post('admin/product/saveProduct', [ProductController::class, 'saveProduct'])->name('admin.product.saveProduct');
    Route::get('admin/product/editProduct/{id}', [ProductController::class, 'editProduct'])->name('admin.product.editProduct');
    Route::post('admin/product/updateProduct', [ProductController::class, 'updateProduct'])->name('admin.product.updateProduct');
    Route::delete('admin/product/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('admin.product.deleteProduct');

    // Billings Routes
    Route::get('admin/billing/billing', [BillingCtrl::class, 'viewBillings'])->name('admin.billing.billing');
    Route::get('admin/billing/createBill', function() {
        return view('admin.billing.createBill');
    });
});