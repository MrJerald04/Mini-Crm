<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\User;
use App\Country;
use App\Company;
use App\ShowCompany;
use App\Employee;
use App\Notification;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use App\Mail\MailtrapExample;

use Maatwebsite\Excel\Facades\Excel;

use Auth;
use DataTables;

class CompanyController extends Controller
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

        $countries = Country::all();
        return view('employee.companies-index')->with(['countries' => $countries, 'user' => $employee, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif]);
        
    }
    public function companiesList(){
        return DataTables::of(Company::query())->make(true);
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
        $user = User::find($user_id);
        $company = Company::find($id);
        $country = Country::find($company->country_id);
        $countryList = Country::all();

        $employee = Employee::find($user_id);
        $temp_employee = Employee::where('email', $employee->email)->get();
        $notif = Notification::all()->where('employee_id', $temp_employee[0]->id)->where('status', 0)->where('company_id', $temp_employee[0]->company_id);
        $new_employee_list = Employee::all();
        $countOfNotif = $notif->count();
        
        $checkCompany = Employee::where('company_id', $id)->count();//check the company if have an employee
        $checkCompanyResult = false;
        if ($checkCompany > 0) {
            $checkCompanyResult = true;
        }
        return view('employee.companies-show')->with(['countryList' => $countryList, 'countries' => $country, 'company' => $company, 'user' => $user, 'checkCompanyResult' => $checkCompanyResult, 'notif' => $notif, 'new_employee_list' => $new_employee_list, 'countOfNotif' => $countOfNotif]);
    }

    public function companiesEmployeeList($cid){
        $employee = Employee::select(['id', 'last_name', 'first_name'])
            ->where('company_id', $cid)
            ->orderBy('created_at', 'DESC');
        return DataTables::of($employee)->make(true);

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

   
}
