<?php

namespace App\Http\Controllers\Pos;

use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{

    public function supplierAll()
    {
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_all', compact('suppliers'));
    }

    public function supplierAdd()
    {
        return view('backend.supplier.supplier_add');
    }
    public function supplierStore(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|unique:suppliers,email',
            'mobile_no' => 'min:11|max:11|unique:suppliers,mobile_no',
            'address' => 'required|max:50',
            'status' => 'required|numeric',
        ]);

        try {

            Supplier::insert([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'status' => $request->status,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            $notification = [
                'msg' => 'Supplier Added Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('supplier.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the supplier',
                'alert-type' => 'error'
            ];

            return redirect()->route('supplier.all')->with($notification);
        }
    }

    public function supplierEdit($id)
    {

        $supplier  = Supplier::findOrFail($id);
        return view('backend.supplier.supplier_edit', compact('supplier'));
    }

    public function supplierUpdate(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'mobile_no' => 'min:11|max:11|unique:suppliers,mobile_no,' . $id,
            'address' => 'required|max:50',
            'status' => 'required|numeric',
        ]);

        try {

            Supplier::findOrFail($id)->Update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'msg' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('supplier.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the supplier',
                'alert-type' => 'error'
            ];

            return redirect()->route('supplier.all')->with($notification);
        }
    }

    public function supplierActive($id)
    {
        Supplier::findOrFail($id)->update([
            'status' => 1,
        ]);


        $notification = [
            'msg' => 'Supplier Active Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('supplier.all')->with($notification);
    }
    public function supplierInactive($id)
    {
        Supplier::findOrFail($id)->update([
            'status' => 0,
        ]);


        $notification = [
            'msg' => 'Supplier InActive Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('supplier.all')->with($notification);
    }

    public function supplierDelete($id)
    {
        Supplier::findOrFail($id)->delete();
        
        $notification = [
            'msg' => 'Supplier Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('supplier.all')->with($notification);
    }
}