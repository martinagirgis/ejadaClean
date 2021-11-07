<?php

namespace App\Http\Controllers\Api;

//use App\Http\Traits\GeneralTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\models\Employee;
use App\models\Supervisor;

class AuthController extends Controller
{
    use GeneralTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:apiEmployees', ['except' => ['login']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if($request->type == 'employee')
        {
            //return $credentials;
            if ($token = Auth::guard('apiEmployees')->attempt($credentials)) {
                $emp = Employee::where('email', $request->email)->with('supervisor')->first();
                //return $emp;
                unset(
                    $emp->created_at,
                    $emp->updated_at
                );
                
                $emp->update(['token' => $token]);
                return $this->returnData(['user'],[$emp],'login successfuly');
                //return $this->respondWithToken($token);
            }
        }
        elseif($request->type == 'supervisor')
        {
            if ($token = Auth::guard('apiSupervisors')->attempt($credentials)) {
                $emp = Supervisor::where('email', $request->email)->first();
                //return $emp;
                unset(
                    $emp->created_at,
                    $emp->updated_at
                );
                
                $emp->update(['token' => $token]);
                return $this->returnData(['user'],[$emp],'login successfuly');
                //return $this->respondWithToken($token);
        
            }
        }
        
        return response()->json(['status' => true,'msg' => "login Unsuccessfuly", 'data' => '']);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        if ($this->checkGuard() == 'false') {
            return 'false';
        }
        else{
            return response()->json($this->checkGuard()->user());
        }
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {if ($this->checkGuard() == 'false') {
        return $this->returnError(401, 'enter valid token');
    }
    else {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        
            return $this->respondWithToken($this->guard()->refresh());
        
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard('apiEmployees')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        // if(Auth::guard('apiEmployees')->check())
        //     {return Auth::guard('apiEmployees');}
        // elseif(Auth::guard('apiSupervisors')->check())
        //     {return Auth::guard('apiSupervisors');}
        return Auth::guard('apiEmployees');
    }

    public function getGuard()
    {
        if(Auth::guard('apiEmployees')->check())
            {return "apiEmployees";}
        elseif(Auth::guard('apiSupervisors')->check())
            {return "apiSupervisors";}
       // return Auth::guard('api');
    }

    public function checkGuard()
    {
        if(Auth::guard('apiEmployees')->check())
            {return Auth::guard('apiEmployees');}
        elseif(Auth::guard('apiSupervisors')->check())
            {return Auth::guard('apiSupervisors');}
        else {return 'false';}
        
    }
}
