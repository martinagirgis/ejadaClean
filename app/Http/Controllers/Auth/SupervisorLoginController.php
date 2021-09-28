<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupervisorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:supervisor')->except('logout');
    }

    public function login($password,$email)
    {
        // Attempt to log the user in
        if(Auth::guard('supervisor')->attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended(route('supervisor.dashboard'));
            // return 'user login';
        }

        // // if unsuccessful
        return redirect()->back()->with('error','البريد الالكتروني او كلمة المرور غير صحيحة');

        // return 'user';
    }
}
