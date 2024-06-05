<?php

namespace App\Http\Controllers\Pos;

use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Traits\SaveImgTrait;
use App\Http\Controllers\Controller;
use App\Http\Traits\DeleteFileTrait;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    use SaveImgTrait, DeleteFileTrait;
    public function customerAll()
    {

        $customers = Customer::latest()->get();
        return view('backend.customer.customer_all', compact('customers'));
    }
    public function customerAdd()
    {
        return view('backend.customer.customer_add');
    }
    public function customerStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'max:20',
            'email' => 'required|email|unique:customers,email',
            'mobile_no' => 'min:11|max:11|unique:customers,mobile_no',
            'address' => 'max:50',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|numeric',
        ]);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->created_by = Auth::user()->id;

        if ($request->file('customer_image')) {

            $customer_image = $this->saveImg($request->customer_image, 'upload/customer/');

            $customer['customer_image'] = $customer_image;
        }

        $customer->save();

        $notification = [
            'msg' => 'Customer Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.all')->with($notification);
    }

    public function customerEdit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customer'));
    }

    public function customerUpdate(Request $request, $id)
    
    {
        $validate = $request->validate([
            'name' => 'max:20',
            'email' => 'required|email|unique:customers,email,' . $id,
            'mobile_no' => 'min:11|max:11|unique:customers,mobile_no,' . $id,
            'address' => 'max:50',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|numeric',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->updated_by = Auth::user()->id;

        if ($request->file('customer_image')) {

            $customer_image = $this->saveImg($request->customer_image, 'upload/customer/', $customer->customer_image);

            $customer['customer_image'] = $customer_image;
        }

        $customer->update();

        $notification = [
            'msg' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.all')->with($notification);
    }

    public function customerActive($id)
    {

        Customer::findOrFail($id)->update([
            'status' => 1,
        ]);


        $notification = [
            'msg' => 'Customer Active Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.all')->with($notification);
    }

    public function customerInactive($id)
    {
        Customer::findOrFail($id)->update([
            'status' => 0,
        ]);


        $notification = [
            'msg' => 'Customers InActive Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.all')->with($notification);
    }

    public function customerDelete($id)
    {

        $customer = Customer::findOrFail($id);

        $this->deleteFile('upload/customer/', $customer->customer_image);


        $customer->delete();

        $notification = [
            'msg' => 'Customers Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('customers.all')->with($notification);
        
        }
}