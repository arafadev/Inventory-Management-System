<?php

namespace App\Http\Controllers\pos;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categoryAll()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    public function categoryAdd()
    {
        return view('backend.category.category_add');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15',
        ]);

        try {

            Category::insert([
                'name' => $request->name,
                'status' => $request->status,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);


            $notification = [
                'msg' => 'Category Added Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('category.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the Unit',
                'alert-type' => 'error'
            ];

            return redirect()->route('category.all')->with($notification);
        }
    }

    public function categoryEdit($id)
    {

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:15',
        ]);

        try {

            Category::findOrFail($id)->Update([
                'name' => $request->name,
                'status' => $request->status,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);


            $notification = [
                'msg' => 'Category Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('category.all')->with($notification);
        } catch (\Throwable $th) {

            $notification = [
                'msg' => ' An error occurred adding the Unit',
                'alert-type' => 'error'
            ];

            return redirect()->route('category.all')->with($notification);
        }
    }
    public function categoryInActive($id)
    {
        Category::findOrFail($id)->update([
            'status' => 0,
        ]);


        $notification = [
            'msg' => 'Category InActive Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.all')->with($notification);
    }

    public function categoryActive($id)
    {
        Category::findOrFail($id)->update([
            'status' => 1,
        ]);


        $notification = [
            'msg' => 'Category Active Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.all')->with($notification);
    }


    public function categoryDelete($id)
    {
        Category::findOrFail($id)->delete();

        $notification = [
            'msg' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('category.all')->with($notification);
    }
}