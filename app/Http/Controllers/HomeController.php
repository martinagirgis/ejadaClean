<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function checkAuthLogin(Request $request)
    {
        if($request->type == 'admin')
        {
            return redirect()->route('admin.login.toty',['password'=> $request->password, 'email'=>$request->email]);
        }
        elseif($request->type == 'company_general_manager')
        {
            return redirect()->route('company_general_manager.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        elseif($request->type == 'quality_manager')
        {
            return redirect()->route('quality_manager.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        elseif($request->type == 'clean_mantanance_manager')
        {
            return redirect()->route('clean_mantanance_manager.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        elseif($request->type == 'supervisor')
        {
            return redirect()->route('supervisor.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        elseif($request->type == 'employee')
        {
            return redirect()->route('employee.login',['password'=> $request->password, 'email'=>$request->email]);
        }
        return 'sad';
    }
}
