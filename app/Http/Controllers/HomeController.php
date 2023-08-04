<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class HomeController extends Controller
{
    use HasRoles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.Backend.daseboard');
    }

    public function profile()
    {
        return view('layouts.Backend.profile');
    }

    public function profilePasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'current_password:web'],
            'password' => ['required', 'min:8', 'different:old_password', 'confirmed'],
        ]);
        $password = Hash::make($request->password);
        $user = User::find(auth()->user()->id);
        $user->password = $password;
        $user->save();

        return back();
    }

    public function profileInfoUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email,'.auth()->user()->id],
            'phone' => ['numeric', 'min:0'],
            'profile_img' => ['mimes:jpeg,png,jpg'],
        ]);

        $user = User::find(auth()->user()->id);
        if ($request->hasFile('profile_img')) {
            $nemProfileImg = str(auth()->user()->name)->slug().'-'.Carbon::now()->format('-d-m-y-H-i-s').'.'.$request->profile_img->extension();
            $request->profile_img->storeAs('users', $nemProfileImg, 'public');
            $user->profile_img = $nemProfileImg;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();

        return back();
    }

    public function allUser()
    {
        $allUser = User::get();

        return view('layouts.Backend.allUser', compact('allUser'));
    }

    public function banUser($id)
    {
        $bannedUser = User::where('id', $id)->first();

        $bannedUser->is_ban = true;
        $bannedUser->save();

        $allUser = User::get();

        return view('layouts.Backend.allUser', compact('allUser'));
    }

    public function notbanUser($id)
    {
        $bannedUser = User::where('id', $id)->first();

        $bannedUser->is_ban = false;
        $bannedUser->save();

        $allUser = User::get();

        return view('layouts.Backend.allUser', compact('allUser'));
    }
}
