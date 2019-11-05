<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Employee;

class ChangePasswordController extends Controller
{
    public function update(Request $request, $id){
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required'
        ]);
        $employee = Employee::where('id', $id)->first();
        $encrypted_new_password = bcrypt($request->newpassword);
        if (password_verify($request->oldpassword, $employee->password)) {
            if ($request->newpassword == $request->confirmpassword) {
                $employee_password = Employee::find($id);
                $employee_password->password = $encrypted_new_password;
                $employee_password->save();
                return redirect()->back()->with('success', 'Password successfully updated');
            }else{
                return redirect()->back()->withInput(Input::except('oldpassword'))->with('error', 'New password not match');
            }
        }else{
            return redirect()->back()->withInput(Input::except('oldpassword'))->with('error', 'Old password is incorrect');
        }
    }
}
