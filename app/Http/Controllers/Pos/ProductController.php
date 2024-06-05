<?php

namespace App\Http\Controllers\pos;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productAll()
    {

        $products = Product::with('supplier', 'category', 'unit')->get();

        // return response()->json($products);

        return view('backend.product.product_all', compact('products'));
    }

    public function productAdd()
    {
        $suppliers = Supplier::latest()->get();
        $categories = Category::latest()->get();
        $units = Unit::latest()->get();

        return view('backend.product.product_add', compact('suppliers', 'categories', 'units'));
    }

    public function productStore(Request $request)
    {

        $request->validate([
            'name' => 'required|max:30',
            'supplier_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'status' =>  'required|integer|between:0,1',
        ]);

        try {

            Product::insert([
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            $notification = [
                'msg' => 'Product Added Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('product.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the supplier',
                'alert-type' => 'error'
            ];

            return redirect()->route('product.all')->with($notification);
        }
    }

    public function ProductEdit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::latest()->get();
        $categories = Category::latest()->get();
        $units = Unit::latest()->get();




        return view('backend.product.product_edit', compact('product', 'categories', 'units', 'suppliers'));
    }

    public function productUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:30',
            'supplier_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'status' =>  'required|integer|between:0,1',
        ]);

        try {

            Product::findOrFail($id)->Update([
                'name' => $request->name,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'msg' => 'Product Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('product.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the supplier',
                'alert-type' => 'error'
            ];

            return redirect()->route('product.all')->with($notification);
        }
    }


    function productDelete($id)
    {

        Product::findOrFail($id)->delete();

        $notification = [
            'msg' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('product.all')->with($notification);
    }
    public function productActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);


        $notification = [
            'msg' => 'Product Active Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('product.all')->with($notification);
    }
    public function productInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);


        $notification = [
            'msg' => 'Product InActive Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('product.all')->with($notification);
    }
}