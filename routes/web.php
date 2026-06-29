<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerCtrl;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\ProductController;

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
    Route::post('admin/index/submitData', [CustomerCtrl::class, 'saveCustomer'])->name('admin.index.submitData');
    
    // customer routes
    Route::get('admin/createCustomer', [CustomerCtrl::class, 'createCustomer'])->name('admin.createCustomer');
    Route::get('admin/customers', [CustomerCtrl::class, 'viewCustomers'])->name('admin.customers');
    Route::delete('admin/customers/deleteCustomer/{id}', [CustomerCtrl::class, 'deleteCustomer'])->name('admin.customers.deleteCustomer');
    Route::get('admin/editCustomer/{id}', [CustomerCtrl::class, 'editCustomer'])->name('admin.editCustomer');
    Route::post('admin/updateCustomer', [CustomerCtrl::class, 'updateCustomer'])->name('admin.updateCustomer');
    
    // products routes
    Route::get('admin/products', [ProductController::class, 'viewProducts'])->name('admin.products');
    Route::get('admin/createProduct', function() {
        return view('admin.createProduct');
    });
});