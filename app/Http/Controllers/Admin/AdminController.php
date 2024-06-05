<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\SaveImgTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use SaveImgTrait;
    public function index()
    {
        return view('admin.index');
    }
    public function profile()
    {

        $user = User::findOrFail(Auth::user()->id);
        return view('admin.admin_profile', compact('user'));
    }


    public function AdminEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.admin_edit', compact('user'));
    }

    public function AdminUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:15|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'img' => 'mimes:jpeg,jpg,png,gif|max:10000', // max 10000kb
        ]);

        $user =   User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->file('img')) {

            $file = $request->file('img');
            $img_name = $this->saveImg($file, 'upload/admin_images/', $user->profile_img);
            $user['profile_img'] = $img_name;
        }

        $user->update();


        $notification = [
            'msg' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|max:50',
            'newPassword' => 'required|max:50',
            'confirmPassword' => ['same:newPassword'],
        ]);


        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            $notification = [
                'msg' => 'Current Password Not Correct',
                'alert-type' => 'warning'
            ];

            return back()->with($notification);
        }


        User::find(Auth::user()->id)->update(['password' => Hash::make($request->newPassword)]);

        $notification = [
            'msg' => 'Admin Password Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.profile')->with($notification);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            'msg' => 'Logout Successfully',
            'alert-type' => 'success'
        ];
        return redirect('/login')->with($notification);
    }
}