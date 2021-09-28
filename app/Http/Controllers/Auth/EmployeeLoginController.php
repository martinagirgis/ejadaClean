<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }

    public function login($password,$email)
    {
        // Attempt to log the user in
        if(Auth::guard('employee')->attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended(route('employee.dashboard'));
            // return 'user login';
        }

        // // if unsuccessful
        return redirect()->back()->with('error','البريد الالكتروني او كلمة المرور غير صحيحة');

        // return 'user';
    }
}
