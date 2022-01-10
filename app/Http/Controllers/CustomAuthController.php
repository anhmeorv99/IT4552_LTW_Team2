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
}
