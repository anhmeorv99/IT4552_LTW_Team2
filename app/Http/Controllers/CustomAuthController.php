<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            // dd(Auth::user());
            return redirect()->route('dashboard');
        }

        return redirect()->route("login")->withSuccess('Login details are not valid');
    }


    public function registration()
    {
        return view('auth.reg');
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        if ($check){
            Auth::login($check);
            return redirect()->route('dashboard');
        }

        return view('auth.reg');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }


    public function dashboard()
    {
        return view('dashboard');
    }


    public function signOut() {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }

    public function viewProfile() {
        return view('profile');
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');

        $user->save();
        return redirect()->back()->with('status','Student Updated Successfully');
    }

    public function viewChangePassword() {
        return view('change_password');
    }

    public function updateChangePassword(Request $request) {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Incorrect Password");
        }

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New password and Current password same");
        }

        if(strcmp($request->get('confirm_password'), $request->get('new_password')) != 0){
            // Current password and new password same
            return redirect()->back()->with("error-confirm","Confirm password and New password not same");
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6'
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success","Change Password Success");
    }


}

