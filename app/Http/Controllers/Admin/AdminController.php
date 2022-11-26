<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    protected function index(){
        return redirect()->intended('admin/dashboard');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function profile($id){
        $title = 'Admin profile';
        $admin = Admin::where('user_id',$id)->first();
        return view('admin.profile',compact('admin','title'));
    }
    public function edit_profile(Request $request, $id=null){
    
       
            if ($request->isMethod('post')) {
                $request->validate([
                    "phone_number" => ['max:13','min:10',Rule::unique('admins', 'phone_number')->ignore($request->id)],
                    "profile_picture" => ['image','mimes:jpeg,png,jpg,gif,svg|max:2048'],
                ]);
            $admin = Admin::where('user_id',$id)->first();

                if ($request->hasFile('profile_picture')) {
                    if (File::exists(public_path('storage/' . $admin->profile_picture))) {
                        File::delete(public_path('storage/' . $admin->profile_picture));
                    }
                    
                    $profile_picture = $request['profile_picture'];
                    $path = $profile_picture->store('admins','public');
                    $admin->profile_picture=$path;
                    
                }
                $admin->user_id = Auth::user()->id;
                $admin->first_name = $request->first_name;
                $admin->last_name = $request->last_name;
                $admin->phone_number = $request->phone_number;
                $admin->update();
                Session::flash('success','profile updated successfully');
                return redirect()->back();


            }
            $title = 'Edit Profile';
            $admin = Admin::where('user_id',$id)->first();
        return view('admin.edit_profile',compact('title','admin'));
    }
   
    public function admin(){
        $user = Admin::get();
        return view('admin.users.admin',compact('user'));
    }
    public function admin_details(){
        return view('admin.users.contacts');
    }
    public function update_password(Request $request, $id=null){
        if($request->isMethod('post')){
            
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
                 $user = User::find($id);

                 $user->password = Hash::make($request->password);
                 $user->update();
                 Session::flash('success','password updated successfully');
                 return redirect()->route('dashboard');
     
     
            
        }
        $title = 'Update Password';
    return view('admin.update_password',compact('title'));
}
}
