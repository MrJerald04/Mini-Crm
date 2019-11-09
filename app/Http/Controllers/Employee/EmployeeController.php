<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;


use Auth;
use App\User;
use App\Company;
use App\Employee;
use App\Country;
use App\Notification;
use App\ShowEmployee;
use DataTables;
use Redirect;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('employee')->check() == null) {
            return redirect()->back();
        }
        $user_id = Auth::guard('employee')->user()->id;
        $employee = Employee::find($user_id);

        $temp_employee = Employee::where('email', $employee->email)->get();
        $notif = Notification::all()->where('employee_id', $temp_employee[0]->id)->where('status', 0)->where('company_id', $temp_employee[0]->company_id);
        $new_employee_list = Employee::all();
        $countOfNotif = $notif->count();

        $companies = Company::all();
        $countries = Country::all();
        return view('employee.employees-index')->with(['countries' => $countries, 'companies' => $companies, 'user' => $employee, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif]);
    }

    public function employeesList(){
        return DataTables::of(Employee::query()->orderBy('created_at','desc'))->make(true);
        // $employee = Employee::leftJoin('companies', 'employees.company_id', '=', 'companies.id')
        //     ->select(['employees.id', 'employees.last_name', 'employees.first_name', 'companies.name'])
        //     ->orderBy('employees.created_at', 'DESC');
        // return DataTables::of($employee)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guard('employee')->check() == null) {
            return redirect('/admin/dashboard');
        }
        $user_id = Auth::guard('employee')->user()->id;
        $employee = Employee::find($user_id);

        $temp_employee = Employee::where('email', $employee->email)->first();
        $notif = Notification::all()->where('employee_id', $temp_employee->id)->where('status', 0)->where('company_id', $temp_employee->company_id);
        $new_employee_list = Employee::all();
        $countOfNotif = $notif->count();

        //get all the info of employee by id
        $employee = Employee::find($id);
        //get companies name by employee company_id
        $company = Company::find($employee->company_id);
        // check if employee have company
        $company_null = '';
        if ($company != null) {
            $company_null = 'NO';
        }else{
            $company_null = 'YES';
        }

        $companyList = Company::all();
        $country = '';
        $country_data = Country::find($employee->country_id);
        if ($country_data != null) {
            $country = $country_data->name;
        }else{
            $country = 'No Country';
        }
        $countryList = Country::all();

        return view('employee.employees-show')->with(['country' => $country, 'countriesList' => $countryList, 'employee' => $employee,'company' => $company, 'company_null' => $company_null, 'companiesList' => $companyList, 'user' => $employee, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function readedNotification($id, $notifID){
        // update employee
        $notif = Notification::find($notifID);
        $notif->delete();

        return redirect('/employee/employees/'.$id);
    }
}
