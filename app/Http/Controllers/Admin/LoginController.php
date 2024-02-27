<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Mail\PasswordToken;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReCaptcha\ReCaptcha;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function adminLogin()
    {
        if (auth()->check()) { return redirect()->route('dashboard'); }
        return view('admin.login');
    }
   
     public function adminGetLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function showChangeForm()
    {
        return view('admin.settings');
    }
    
   public function change(Request $request)
    {
        // Validate the form data
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'The old password is incorrect.');
        }

        // Update the user's password
        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('dashboard')->with('success', 'Password updated successfully!');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');
    }

    // public function forgotPassword()
    // {
    //     return view('admin.forgot_password');
    // }

    // public function forgotPasswordToken(Request $request)
    // {
    //     $v = Validator::make($request->all(), [
    //         'email' => 'required',
    //     ]);

    //     if ($v->fails()) {
    //         return redirect('forgot-password')->withErrors($v->errors());
    //     }

    //     $email = request()->get('email');

    //     $d = Admin::where('email', '=', $email)->count();
    //     if ($d == '1') {
    //         $fprand = substr(str_shuffle(str_repeat('0123456789', '16')), 0, '16');
    //         $ef = Admin::where('email', '=', $email)->first();
    //         $name = ucfirst($ef->fname) . ' ' . ucfirst($ef->lname);
    //         $ef->pwresetkey = $fprand;
    //         $ef->save();

    //         $fpw_link = url('admin/forgot-password-token-code/' . $fprand);

    //         try {
    //             Mail::to($email)->send(new ForgotPassword($fpw_link, $name));
    //             return redirect('admin/forgot-password')->with([
    //                 'message' => "Reset link sent to your email, Please Check your email",
    //             ]);
    //         } catch (Exception $ex) {
    //             return redirect('admin/forgot-password')->with([
    //                 'message' => $ex->getMessage(),
    //             ]);
    //         }
    //     } else {
    //         return redirect('admin/forgot-password')->with([
    //             'message' => 'Sorry, there is no registered user with this email address',
    //             'message_important' => true,
    //         ]);
    //     }
    // }

    // public function forgotPasswordTokenCode($token)
    // {
    //     $tfnd = Admin::where('pwresetkey', '=', $token)->where('status','Active')->count();
    //     if ($tfnd == '1') {
    //         $d = Admin::where('pwresetkey', '=', $token)->where('status','Active')->first();
    //         $name = ucfirst($d->fname) . ' ' . ucfirst($d->lname);
    //         $url = url('/admin');
    //         $email = $d->email;
    //         $username = $d->username;

    //         $rawpass = Str::random(40);

    //         $password = bcrypt($rawpass);

    //         $d->password = $password;
    //         $d->pwresetkey = '';
    //         $d->save();

    //         /*For Email Confirmation*/

    //         try { 
    //             Mail::to($email)->send(new PasswordToken($name, $username, $rawpass, $url));

    //             return redirect('/admin')->with([
    //                 'message' => 'A new password generated. Please check your email.',
    //             ]);
    //         } catch (Exception $ex) {
    //             return redirect('/admin')->with([
    //                 'message' => $ex->getMessage(),
    //             ]);
    //         }
    //     } else {
    //         return redirect('/admin')->with([
    //             'message' => 'Sorry password reset token expired or not exist, Please try again.',
    //             'message_important' => true,
    //         ]);
    //     }
    // }
}
