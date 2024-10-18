<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view("auth/login");
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
            'password' => 'required',

        ]);

        if ($validator->passes()) {
            if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
                $userRole = Auth::guard()->user()->role;
                
                // Role-based redirection
                if ($userRole == "Admin") {
                    return redirect()->route('admin.dashboard');
                } elseif ($userRole == "Engineer") {
                    return redirect()->route('home.Engineer');
                } else {
                    // Default user role redirection
                    return redirect()->route('users/Home');
                }
            } else {
                // Failed authentication, redirect with error message
                return redirect()->route('auth/login')->with('error', 'Invalid email or password.');
            }
        } else {
            // Validation failed, redirect back with input and validation errors
            return redirect()->route('index.login')
                ->withInput()
                ->withErrors($validator);
        }






    }


}
