<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QualityManagerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:quality_manager')->except('logout');
    }

    public function login($password,$email)
    {
        // Attempt to log the user in
        if(Auth::guard('quality_manager')->attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended(route('quality_manager.dashboard'));
            // return 'user login';
        }

        // // if unsuccessful
        return redirect()->back()->with('error','البريد الالكتروني او كلمة المرور غير صحيحة');

        // return 'user';
    }
}
