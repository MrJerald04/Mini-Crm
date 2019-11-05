<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Employee;
use App\Notification;
use App\Country;

use Auth;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:employee');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::guard('user')->check() != null) {
            return redirect()->back();
        }
        if (Auth::guard('employee')->check() != null) {
            return redirect()->back();
        }
        return view('auth/login');
    }
    //for admin sides
    public function AdminDashboard(){
        if (Auth::guard('user')->check() == null) {
            return redirect()->back();
        }
        $total_company = Company::all()->count();
        $total_employee = Employee::all()->count();
        return view('admin.dashboard')->with(['totalCompany' => $total_company, 'totalEmployee' => $total_employee]);
    }
    public function AdminCompanies(){
        return view('admin.companies-index');
    }
    public function AdminEmployees(){
        return view('admin.employees-index');
    }
    public function AdminSendEmail(){
        if (Auth::guard('user')->check() == null) {
            return redirect()->back();
        }
        return view('admin.send_mail');
    }
    public function AdminMap(){
        if (Auth::guard('user')->check() == null) {
            return redirect()->back();
        }
        return view('admin.map');
    }

    //for emploee sides
    public function EmployeeDashboard(){
        if (Auth::guard('employee')->check() == null) {
            return redirect()->back();
        }

        $user_id = Auth::guard('employee')->user()->id;
        $employee = Employee::find($user_id);

        $temp_employee = Employee::where('email', $employee->email)->get();
        $notif = Notification::all()->where('employee_id', $temp_employee[0]->id)->where('status', 0)->where('company_id', $temp_employee[0]->company_id);
        $new_employee_list = Employee::all();
        $countOfNotif = $notif->count();

        $total_company = Company::all()->count();
        $total_employee = Employee::all()->count();
        return view('employee.dashboard')->with(['totalCompany' => $total_company, 'totalEmployee' => $total_employee, 'user' => $employee, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif]);
    }
    public function EmployeeCompanies(){
        return view('employee.companies-index');
    }
    public function EmployeeEmployees(){
        return view('employee.employees-index');
    }
    public function EmployeeSendEmail(){
        if (Auth::guard('employee')->check() == null) {
            return redirect()->back();
        }
        $user_id = Auth::guard('employee')->user()->id;
        $employee = Employee::find($user_id);

        $temp_employee = Employee::where('email', $employee->email)->get();
        $notif = Notification::all()->where('employee_id', $temp_employee[0]->id)->where('status', 0)->where('company_id', $temp_employee[0]->company_id);
        $new_employee_list = Employee::all();
        $countOfNotif = $notif->count();
        return view('employee.send_mail')->with(['user' => $employee, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif]);
    }
    public function EmployeeMap(){
        if (Auth::guard('employee')->check() == null) {
            return redirect()->back();
        }
        $user_id = Auth::guard('employee')->user()->id;
        $employee = Employee::find($user_id);

        $temp_employee = Employee::where('email', $employee->email)->get();
        $notif = Notification::all()->where('employee_id', $temp_employee[0]->id)->where('status', 0)->where('company_id', $temp_employee[0]->company_id);
        $new_employee_list = Employee::all();
        $countOfNotif = $notif->count();
        return view('employee.map')->with(['user' => $employee, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif]);
    }
    public function EmployeeProfile(){
        if (Auth::guard('employee')->check() == null) {
            return redirect()->back();
        }
        $user_id = Auth::guard('employee')->user()->id;
        $employee = Employee::find($user_id);

        $temp_employee = Employee::where('email', $employee->email)->get();
        $notif = Notification::all()->where('employee_id', $temp_employee[0]->id)->where('status', 0)->where('company_id', $temp_employee[0]->company_id);
        $new_employee_list = Employee::all();
        $countOfNotif = $notif->count();

        $employee_company_name = Company::where('id', $employee->company_id)->first();
        $country = Country::where('id', $employee->country_id)->first();
        return view('employee.profile')->with(['user' => $employee, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif, 'employee_company_name' => $employee_company_name, 'country' => $country]);
    }

}
