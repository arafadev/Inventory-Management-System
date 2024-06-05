<?php

namespace App\Http\Controllers\pos;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Pure;


class PurchaseController extends Controller
{

    public function purchaseAll()
    {
        $purchases =  Purchase::with('supplier', 'product', 'category')
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')->get();

        return view('backend.purchase.purchase_all', compact('purchases'));
    }


    public function purchaseAdd()
    {
        $categories = Category::latest()->get();
        $suppliers = Supplier::latest()->get();
        return view('backend.purchase.purchase_add', compact('categories', 'suppliers'));
    }
    public function purchaseStore(Request $request)
    {

        if ($request->category_id == null) {

            $notification = array(
                'msg' => 'Sorry you do not select any item',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        } else {

            $count_category = count($request->category_id);

            for ($i = 0; $i < $count_category; $i++) {
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];

                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];

                $purchase->created_by = Auth::user()->id;
                $purchase->status = 1;
                $purchase->save();
            } // end foreach
        } // end else 

        $notification = array(
            'msg' => 'Data Save Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.all')->with($notification);
    } // End Method 



    public function purchaseActive($id)
    {
        Purchase::findOrFail($id)->update([
            'status' => 1,
        ]);


        $notification = [
            'msg' => 'Purchase Approved Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('purchase.all')->with($notification);
    }
    public function purchaseInActive($id)
    {
        Purchase::findOrFail($id)->update([
            'status' => 0,
        ]);


        $notification = [
            'msg' => 'Purchase Un Approved  ',
            'alert-type' => 'warning'
        ];

        return redirect()->route('purchase.all')->with($notification);
    }

    public function purchaseDelete($id)
    {

        Purchase::findOrFail($id)->delete();

        $notification = array(
            'msg' => 'Purchase  Deleted Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}