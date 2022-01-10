<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UpdateProfileRequest;

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

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return view('dashboard');
            // return redirect('dashboard')->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
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

        return Redirect('login');
    }

    public function viewProfile() {
        return view('profile')->with('user', auth()->user());
    }

    public function updateProfile(UpdateProfileRequest $request) {
        $user = auth()->user();

        $user->update([
            'name'=> $request->username,
            'email' => $request->email
        ]);

        session()->flash('success', 'Update profile successfully');

        return redirect('profile')->withSuccess("Update profile successfully");
    }
}
