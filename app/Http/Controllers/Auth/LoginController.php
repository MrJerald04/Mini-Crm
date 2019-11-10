<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){
        //validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (User::all()) {
            //attemp to user in // user is admin
            if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'remember_token' => $request->remember])) {
                //if successful the redirect to intended location
                return redirect()->intended(route('admin.dashboard'))->with('name', Auth::guard('user')->user()->name);
            }
            if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password, 'remember_token' => $request->remember])) {
                //if successful the redirect to intended location
                return redirect()->intended(route('employee.dashboard'))->with('name', Auth::guard('employee')->user()->first_name);
            }
            // if unsuccessful the redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->with('login_error', 'Your Email/Password is incorrect');
        }else{
            return redirect()->back()->with('login_error', 'Your account does not exist');
        }
        
    }
}
