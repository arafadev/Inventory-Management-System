<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pos\AjaxController;
use App\Http\Controllers\pos\UnitController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\pos\ProductController;
use App\Http\Controllers\pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\pos\PurchaseController;
use App\Http\Controllers\Pos\SupplierController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







#######################################  Admin Routes ################################################

Route::group(['middleware' => 'auth', 'verified'], function () {

    Route::get('/', function () {
        return view('admin.index');
    });


    Route::get('/dashboard', function () {
        return view('admin.index');
    });



    Route::controller(AdminController::class)->group(function () {
        Route::get('index', 'index')->name('admin.index');
        Route::get('logout', 'destroy')->name('admin.logout');
        Route::get('profile', 'profile')->name('admin.profile');
        Route::get('edit/{id}', 'AdminEdit')->name('admin.edit');
        Route::post('update/{id}', 'AdminUpdate')->name('admin.update');

        Route::get('changePassword', 'changePassword')->name('admin.changePassword');
        Route::post('updatePassword', 'updatePassword')->name('admin.updatePassword');
    });


    // Supplier Routes
    Route::controller(SupplierController::class)->group(function () {

        Route::get('suppliers', 'supplierAll')->name('supplier.all');
        Route::get('supplier/add', 'supplierAdd')->name('supplier.add');
        Route::post('supplier/store', 'supplierStore')->name('supplier.store');
        Route::get('supplier/edit/{id}', 'supplierEdit')->name('supplier.edit');
        Route::post('supplier/update/{id}', 'supplierUpdate')->name('supplier.update');
        Route::get('supplier/active/{id}', 'supplierActive')->name('supplier.active');
        Route::get('supplier/inactive/{id}', 'supplierInactive')->name('supplier.inactive');
        Route::get('supplier/delete/{id}', 'supplierDelete')->name('supplier.delete');
    });

    // Customers Routes
    Route::controller(CustomerController::class)->group(function () {

        Route::get('customers', 'customerAll')->name('customers.all');
        Route::get('customer/add', 'customerAdd')->name('customer.add');
        Route::post('customer/store', 'customerStore')->name('customer.store');
        Route::get('customer/edit/{id}', 'customerEdit')->name('customer.edit');
        Route::post('customer/update/{id}', 'customerUpdate')->name('customer.update');
        Route::get('customer/active/{id}', 'customerActive')->name('customer.active');
        Route::get('customer/inactive/{id}', 'customerInactive')->name('customer.inactive');
        Route::get('customer/delete/{id}', 'customerDelete')->name('customer.delete');
    });


    // Unit Routes
    Route::controller(UnitController::class)->group(function () {

        Route::get('unit', 'unitAll')->name('unit.all');
        Route::get('unit/add', 'unitAdd')->name('unit.add');
        Route::post('unit/store', 'unitStore')->name('unit.store');
        Route::get('unit/edit/{id}', 'unitEdit')->name('unit.edit');
        Route::post('unit/update/{id}', 'unitUpdate')->name('unit.update');
        Route::get('unit/active/{id}', 'unitActive')->name('unit.active');
        Route::get('unit/inactive/{id}', 'unitInActive')->name('unit.inactive');
        Route::get('unit/delete/{id}', 'unitDelete')->name('unit.delete');
    });

    // Category Routes
    Route::controller(CategoryController::class)->group(function () {

        Route::get('category', 'categoryAll')->name('category.all');
        Route::get('category/add', 'categoryAdd')->name('category.add');
        Route::post('category/store', 'categoryStore')->name('category.store');
        Route::get('category/edit/{id}', 'categoryEdit')->name('category.edit');
        Route::post('category/update/{id}', 'categoryUpdate')->name('category.update');
        Route::get('category/active/{id}', 'categoryActive')->name('category.active');
        Route::get('category/inactive/{id}', 'categoryInActive')->name('category.inactive');
        Route::get('category/delete/{id}', 'categoryDelete')->name('category.delete');
    });

    // Product Routes
    Route::controller(ProductController::class)->group(function () {

        Route::get('product', 'productAll')->name('product.all');
        Route::get('product/add', 'productAdd')->name('product.add');
        Route::post('product/store', 'productStore')->name('product.store');
        Route::get('product/edit/{id}', 'ProductEdit')->name('product.edit');
        Route::post('product/update/{id}', 'productUpdate')->name('product.update');
        Route::get('product/active/{id}', 'productActive')->name('product.active');
        Route::get('product/inactive/{id}', 'productInActive')->name('product.inactive');
        Route::get('product/delete/{id}', 'productDelete')->name('product.delete');
    });

    // Product Routes
    Route::controller(PurchaseController::class)->group(function () {

        Route::get('purchase', 'purchaseAll')->name('purchase.all');
        Route::get('purchase/add', 'purchaseAdd')->name('purchase.add');
        Route::post('purchase/store', 'purchaseStore')->name('purchase.store');
        Route::get('purchase/active/{id}', 'purchaseActive')->name('purchase.active');
        Route::get('purchase/inactive/{id}', 'purchaseInActive')->name('purchase.inactive');
        Route::get('purchase/delete/{id}', 'purchaseDelete')->name('purchase.delete');
    });

    // Product Routes
    Route::controller(AjaxController::class)->group(function () {

        Route::get('get-category', 'getCategory')->name('get-category');
        Route::get('get-product', 'GetProduct')->name('get-product');
        Route::get('/check-product', 'GetStock')->name('check-product-stock');
    });


    // Invoice All Route 
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoices', 'invoiceAll')->name('invoice.all');
        Route::get('invoice/add', 'invoiceAdd')->name('invoice.add');
        Route::post('invoice/store', 'invoiceStore')->name('invoice.store');
    });
});
#######################################  End Admin Routes ################################################




Route::get('test', function () {

    return Product::with(['category' => function ($q) {
        $q->where('id', 5);
    }])->get();
});

require __DIR__ . '/auth.php';