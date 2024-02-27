<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function showLoginForm()
    {
        return view('user_profile.login');
    }

    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('contacts')->attempt($credentials)) {
            // Authentication passed, redirect to admin dashboard or wherever you want
            return redirect()->route('contact.dashboard');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout()
    {
        Auth::guard('contacts')->logout();
        return redirect()->route('admin.login.form');
    }
}
