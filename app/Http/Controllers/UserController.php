<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request) {
        $creds = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ], [
            "email.required" => "Sähköpostiosoite puuttuu.",
            "email.email" => "Sähköpostiosoite on virheellinen.",
            "password.required" => "Salasana puuttuu.",
        ]);
        
        
        if (Auth::attempt($creds)) {
            $request->session()->regenerate();
            return redirect()->intended("/");
        }
        else {
            return back()->withErrors([
                "email" => "Salasana tai sähköpostiosoite eivät täsmää."
            ])->onlyInput("email");
        }
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect()->intended("/");
    }
}
