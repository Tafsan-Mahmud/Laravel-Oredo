<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function users()
    {
        $userData = User::where('id', '!=', Auth::id())->paginate(10);
        $total = User::count();
        return view('Admin.User.user', compact('userData', 'total'));
    }
    function user_delete($user_id)
    {

        User::find($user_id)->delete();
        return back()->with("dltUser", "user delete Successfully");
    }
    function edit_profile()
    {
        return view('Admin.User.editProfile');
    }
    function update_profile(Request $request)
    {
        if ($request->password == '' || $request->oldPassword == '') {
            User::find(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return back()->with('updateinfoSuccss', "Update successfully");
        } else {
            if (Hash::check($request->oldPassword, Auth::user()->password)) {
                User::find(Auth::id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password
                ]);
                return back()->with('updateinfoSuccss', "Update successfully");
            } else {
                return back()->with('OlsPassErr', "old password does't match");
            }
        }
    }

    function update_profile_image(Request $request)
    {
        $uploaded_file = $request->photo;
        $extention = $uploaded_file->getClientOriginalExtension();
        $fileName = Auth::id() . "." . $extention;
        Image::make($uploaded_file)->save(public_path('/uploads/users/' . $fileName));
        User::find(Auth::id())->update([
            'photo' => $fileName
        ]);
        return back()->with('updateimageSuccss', "Update successfully");
    }

    function delete_checkbox(Request $request)
    {
        if (!$request->check == '') {
            foreach ($request->check as $user_id) {
                User::find($user_id)->delete();
            }
        }
        return back();
    }
    function hard_delete_checkbox(Request $request)
    {

        if ($request->click == 1) {
            if (!$request->check == '') {
                foreach ($request->check as $user_id) {
                    $image = User::onlyTrashed()->find($user_id);
                    if (!$image->photo == '') {
                        $delete_from = public_path('/uploads/users/' . $image->photo);
                        unlink($delete_from);
                    }
                    User::onlyTrashed()->find($user_id)->forceDelete();
                }
            }
            return back();
        } elseif ($request->click == 2) {
            if (!$request->check == '') {
                foreach ($request->check as $user_id) {
                    User::onlyTrashed()->find($user_id)->restore();
                }
            }
            return back();
        }
    }
    function trash_user()
    {
        $userData = User::onlyTrashed()->where('id', '!=', Auth::id())->get();
        $total = User::onlyTrashed()->count();
        return view('Admin.User.trashUser', [
            'userData' => $userData,
            'total' => $total,
        ]);
    }
    function user_restore($user_id)
    {
        User::onlyTrashed()->find($user_id)->restore();
        return back();
    }
    function user_hard_delete($user_id)
    {
        $image = User::onlyTrashed()->find($user_id);
        if (!$image->photo == '') {
            $delete_from = public_path('/uploads/users/' . $image->photo);
            unlink($delete_from);
        }
        User::onlyTrashed()->find($user_id)->forceDelete();
        return back();
    }
}
