<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class EmployeeLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:employee');
    }

    public function showLoginForm(){
        return view('auth.employee-login');
    }

    public function login(Request $request){
        //validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //attemp to use in
        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password, 'remember_token' => $request->remember])) {
            //if successful the redirect to intended location
            return redirect()->intended(route('employee.dashboard'))->with('name', Auth::guard('employee')->user()->first_name);
            
        }
        // if unsuccessful the redirect back
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
