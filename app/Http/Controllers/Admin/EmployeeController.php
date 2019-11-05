<?php

namespace App\Http\Controllers\Admin;

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
        if (Auth::guard('user')->check() == null) {
            return redirect()->back();
        }
        $user_id = Auth::guard('user')->user()->id;
        $user = User::find($user_id);
        $companies = Company::all();
        $countries = Country::all();
        return view('admin.employees-index')->with(['countries' => $countries, 'companies' => $companies, 'user' => $user]);
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
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required'
        ]);
        if (Employee::where('email', '=', $request->input('email'))->exists() && ($request->input('email') != null)) {
            return Redirect::to('/admin/employees')->withInput(Input::except('email'))->with('error', 'That email address is already registered.');
        }else{
            // add company
            $encrypted_password = bcrypt('password'); //encrypt the password

            $employee = new Employee();
            $employee->last_name = $request->input('lastname');
            $employee->first_name = $request->input('firstname');
            $employee->company_id = $request->input('company');//company id
            $employee->email = $request->input('email');
            $employee->password = $encrypted_password;
            $employee->phone = $request->input('phone');
            $employee->country_id = $request->input('country');
            $employee->save();
            

            //get the id of new created employee 
            $lastInsertedEmployeeId = $employee->id;
            $listOfEmployeeInSelectedCompany = Employee::where('company_id', $request->input('company'))->get();
            foreach ($listOfEmployeeInSelectedCompany as $leis) {
                if ($leis->email != $request->input('email')) {
                    
                    $emp = new Notification();
                    $emp->employee_id = $leis->id;
                    $emp->new_employee_id = $lastInsertedEmployeeId;
                    $emp->company_id = $request->input('company');//company id
                    $emp->status = 0;
                    $emp->save();
                }
            }

            // store location
            $country = Country::find($request->input('country'));
            $cLat = $country->latitude;
            $cLng = $country->longitude;
            $radius = rand(1,20); // in miles
            $lng_min = $cLng - $radius / abs(cos(deg2rad($cLat)) * 69);
            $lng_max = $cLng + $radius / abs(cos(deg2rad($cLat)) * 69);
            $lat_min = $cLat - ($radius / 69);
            $lat_max = $cLat + ($radius / 69);

            $randTypeLat = rand(1,2);
            $randTypeLng = rand(1,2);
            
            $latTemp = 0;
            $lngTemp = 0;

            if ($randTypeLat == 1) {
                $latTemp = $lat_min;
            }else{
                $latTemp = $lat_max;
            }
            if ($randTypeLng == 1) {
                $lngTemp = $lng_min;
            }else{
                $lngTemp = $lng_max;
            }

            $lat = Str::substr($latTemp, 0, 8);
            $lng = Str::substr($lngTemp, 0, 8);

            $showEmployee = new ShowEmployee();
            $showEmployee->employee_id = $lastInsertedEmployeeId;
            $showEmployee->lat = $lat;
            $showEmployee->lng = $lng;
            $showEmployee->save();

            return redirect('/admin/employees')->with('success', 'New Employee Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::guard('user')->check() == null) {
            return redirect('/employee/dashboard');
        }
        $user_id = Auth::guard('user')->user()->id;
        $user = User::find($user_id);
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

        $country = Country::find($employee->country_id);
        $countryList = Country::all();

        return view('admin.employees-show')->with(['country' => $country, 'countriesList' => $countryList, 'employee' => $employee,'company' => $company, 'company_null' => $company_null, 'companiesList' => $companyList, 'user' => $user]);
        
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
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required'

        ]);

        $checkEmployee = Employee::find($id);
        if($checkEmployee->company_id != $request->input('company')){
            $notifDeleteEmployee = Notification::where('new_employee_id', $id);
            $notifDeleteEmployee->delete();

            $listOfEmployeeInSelectedCompany = Employee::where('company_id', $request->input('company'))->get();
            foreach ($listOfEmployeeInSelectedCompany as $leis) {
                if ($leis->id != $id) {
                    $emp = new Notification();
                    $emp->employee_id = $leis->id;
                    $emp->new_employee_id = $id;
                    $emp->company_id = $request->input('company');//company id
                    $emp->status = 0;
                    $emp->save();
                }
            }
        }

        // update employee
        $employee = Employee::find($id);
        $employee->last_name = $request->input('lastname');
        $employee->first_name = $request->input('firstname');
        $employee->company_id = $request->input('company');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->country_id = $request->input('country');
        $employee->save();

        // store location
        $country = Country::find($request->input('country'));
        $cLat = $country->latitude;
        $cLng = $country->longitude;
        $radius = rand(1,20); // in miles
        $lng_min = $cLng - $radius / abs(cos(deg2rad($cLat)) * 69);
        $lng_max = $cLng + $radius / abs(cos(deg2rad($cLat)) * 69);
        $lat_min = $cLat - ($radius / 69);
        $lat_max = $cLat + ($radius / 69);

        $randTypeLat = rand(1,2);
        $randTypeLng = rand(1,2);
        
        $latTemp = 0;
        $lngTemp = 0;

        if ($randTypeLat == 1) {
            $latTemp = $lat_min;
        }else{
            $latTemp = $lat_max;
        }
        if ($randTypeLng == 1) {
            $lngTemp = $lng_min;
        }else{
            $lngTemp = $lng_max;
        }

        $lat = Str::substr($latTemp, 0, 8);
        $lng = Str::substr($lngTemp, 0, 8);

        $showEmployee = ShowEmployee::where('employee_id', $id)->first();
        $showEmployee->lat = $lat;
        $showEmployee->lng = $lng;
        $showEmployee->save();

        return redirect('/admin/employees/'.$id)->with('success', 'Employee updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        
        return redirect('/admin/employees')->with('success', 'Employee Removed');
    }
}
