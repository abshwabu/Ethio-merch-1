<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Creator;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class CreatorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        return redirect()->intended('creator/dashboard');
    }
    public function dashboard()
    {
        $products = Product::all();
        return view('creator.dashboard', compact('products'));
    }
    public function personal_information(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                "first_name" => ['required', 'string'],
                "last_name" => ['required', 'string'],
                "media_url" => ['required', 'url', Rule::unique('creators', 'media_url')->ignore($request->id)],
                "phone_number" => ['numeric', 'digits:10', Rule::unique('creators', 'phone_number')->ignore($request->id)],

            ]);
            if ($id) {
                $creator = Creator::find($id);
                $creator->user_id = Auth::user()->id;
                $creator->media_url = $request->media_url;
                $creator->first_name = $request->first_name;
                $creator->last_name = $request->last_name;
                $creator->phone_number = $request->phone_number;
                $creator->update();
            } else {


                $creator = Creator::create([
                    'user_id' => Auth::user()->id,
                    'media_url' => $request->media_url,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_number' => $request->phone_number
                ]);
            }
            session()->flash('success', 'profile updated successfully');
            return redirect('creator/dashboard');
        }
        $title = 'edit profile';
        if (Creator::where('user_id', $id)->exists()) {
            $creator = Creator::where('user_id', $id)->first();
            //    $creator=json_decode(json_encode([$creator ]),true);
            //    echo "<pre>";print_r($creator); die;
        } else {
            $creator = null;
        }

        return view('creator.account.personal-information', compact('title', 'creator'));
    }
    public function account_setting(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $user = User::find($id);

            if (Hash::check($request->current_password, $user->password)) {
                $request->validate([
                    'current_password' => ['required'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $user->password = Hash::make($request->password);
                $user->update();
                session()->flash('success', 'password updated successfully');
                return redirect('creator');
            } else {
                Session::flash('error', 'old password not correct');
                // session()->flash('error','old password not correct');
                return back();
            }
        }

        $title = 'Account Setting';
        return view('creator.account.account-setting', compact('title'));
    }
    public function update_avatar(Request $request, $id)
    {
        $request->validate([
            "profile_picture" => ['image', 'mimes:jpeg,png,jpg,gif,svg|max:2048'],
        ]);
        $user = User::find($id);
        if ($request->hasFile('profile_picture')) {
            if (File::exists(public_path('storage/' . $user->profile_picture))) {
                File::delete(public_path('storage/' . $user->profile_picture));
            }
            $profile_picture = $request->profile_picture;
            $path = $profile_picture->store('creators', 'public');
            $user->profile_picture = $path;
            $user->update();
        }
        session()->flash('success', 'avatar added successfully');
        return redirect('creator');
    }
}
