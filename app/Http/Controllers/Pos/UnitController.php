<?php

namespace App\Http\Controllers\pos;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function unitAll()
    {
        $units = Unit::latest()->get();
        return view('backend.unit.unit_all', compact('units'));
    }
    public function unitAdd()
    {
        return view('backend.unit.unit_add');
    }

    public function unitStore(Request $request)

    {
        $request->validate([
            'name' => 'required|max:15',
        ]);

        try {

            Unit::insert([
                'name' => $request->name,
                'status' => $request->status,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);


            $notification = [
                'msg' => 'Unit Added Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('unit.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the Unit',
                'alert-type' => 'error'
            ];

            return redirect()->route('unit.all')->with($notification);
        }
    }
    public function unitEdit($id)
    {
        $unit = Unit::findOrFail($id);

        return view('backend.unit.unit_edit', compact('unit'));
    }

    public function unitUpdate(Request $request, $id)
    {
        try {

            Unit::findOrFail($id)->Update([
                'name' => $request->name,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = [
                'msg' => 'Unit Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('unit.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the Unit',
                'alert-type' => 'error'
            ];

            return redirect()->route('unit.all')->with($notification);
        }
    }


    public function unitActive($id)
    {
        Unit::findOrFail($id)->update([
            'status' => 1,
        ]);


        $notification = [
            'msg' => 'Unit Active Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('unit.all')->with($notification);
    }

    public function unitInActive($id)
    {
        Unit::findOrFail($id)->update([
            'status' => 0,
        ]);


        $notification = [
            'msg' => 'Unit InActive Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('unit.all')->with($notification);
    }

    public function unitDelete($id)
    {
        Unit::findOrFail($id)->delete();

        $notification = [
            'msg' => 'Unit Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('unit.all')->with($notification);
    }
}