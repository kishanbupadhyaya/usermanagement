<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\SendVerificationCode;
use Mail;

class VerificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function verify()
    {
        if (is_null(Auth::user()->token)) {
            $this->sendMail();
        }

        return view('auth.verify');
    }

    public function verifyOTP(Request $request)
    {
        if (request('otp') == Auth::user()->token) {
            User::where('id', Auth::user()->id)->update(['token' => null, 'email_verified_at' => date('Y-m-d H:i:s')]);

            return redirect()->to('home')->with('success', 'Email Address Verified!!!');
        } else {
            return redirect()->back()->with('error', 'Sorry, please try agin latter!!!');
        }
    }

    public function sendMail()
    {
        $token = Str::random(5);

        User::where('id', Auth::user()->id)->update(['token' => $token]);
        
        Mail::to(Auth::user()->email)->send(new SendVerificationCode($token));
 
        if (Mail::failures()) {
            \Session::flash('error', 'Sorry! Please try again latter'); 
        } else {
            \Session::flash('success', 'We have sent you otp on your email address!!!'); 
        }
    }
}
