<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Password dun match.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Wrong password');
        }

        auth()->login($user);
        return redirect('/')->with('success', 'Login successful');
    }

    public function showRegister()
    {
        return view('auth.register');
    }
    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'image' => 'required|mimes:png,jpg,webp,jpeg',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $findUser = User::where('email', $request->email)->first();
        if ($findUser) {
            return redirect()->back()->with('error', 'Email already exits.');
        }

        $image = $request->file('image');
        $image_name = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image_name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        auth()->login($user);
        return redirect('/')->with('success', 'Welcome ' . $request->name);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/login')->with('success', 'Logout Successfully');
    }
}
