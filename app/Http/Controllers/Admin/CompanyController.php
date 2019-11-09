<?php

namespace App\Http\Controllers\Admin;

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
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use App\Mail\MailtrapExample;

use Maatwebsite\Excel\Facades\Excel;

use Auth;
use DataTables;

class CompanyController extends Controller
{
    protected $countries_id;
    public function __construct()
    {
        
    }
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
        $countries = Country::all();
        return view('admin.companies-index')->with(['countries' => $countries, 'user' => $user]);
        
    }
    public function companiesList(){
        return DataTables::of(Company::query()->orderBy('created_at','desc'))->make(true);
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
            'name' => 'required',
            'logo' => 'image|nullable|max:2000|dimensions:max_width=100,max_height=100'
        ]);
        // Handle File Upload
        if($request->hasFile('logo')){
            $filenameWithExt = $request->file('logo')->getClientOriginalName();//get file name with the extension
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);// get just filename
            $extension = $request->file('logo')->getClientOriginalExtension();//get just ext
            $fileNameToStore = $filename.'_'.time().'.'.$extension;//filename to store
            $path = $request->file('logo')->storeAs('public/logo', $fileNameToStore);//upload image
        } else {
            $fileNameToStore = 'noimage.png';
        }
        //send an 
        $fromEmail = 'jeralddelacruz004@gmail.com';
        $companyName = $request->input('name');
        Mail::to('hanszerodii@gmail.com')->send(new MailtrapExample($fromEmail, $companyName)); 

        // add company
        $company = new Company();
        $company->country_id = $request->input('country');
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->color = $request->input('color');
        $company->logo = $fileNameToStore;
        $company->save();

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

        $showCompany = new ShowCompany();
        $showCompany->company_id = $company->id;
        $showCompany->lat = $lat;
        $showCompany->lng = $lng;
        $showCompany->save();
        
        return redirect('/admin/companies')->with('success', 'New Company Added');
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
        $company = Company::find($id);
        $country_data = Country::find($company->country_id);
        
        if ($country_data != null) {
            $this->country = $country_data->name;
            $this->countries_id = $country_data->id;
        }else{
            $this->country = 'No Country';
        }
        $countryList = Country::all();
        
        $checkCompany = Employee::where('company_id', $id)->count();//check the company if have an employee
        $checkCompanyResult = false;
        if ($checkCompany > 0) {
            $checkCompanyResult = true;
        }
        return view('admin.companies-show')->with(['countryList' => $countryList, 'countries' => $this->country, 'country_id' => $this->countries_id, 'company' => $company, 'user' => $user, 'checkCompanyResult' => $checkCompanyResult]);
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
        $this->validate($request, [
            'name' => 'required',
            'logo' => 'image|nullable|max:2000|dimensions:max_width=100,max_height=100'
        ]);
        // Handle File Upload
        if($request->hasFile('logo')){
            //get file name with the extension
            $filenameWithExt = $request->file('logo')->getClientOriginalName();

            // get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('logo')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image
            $path = $request->file('logo')->storeAs('public/logo', $fileNameToStore);
        }
        // add company
        $company = Company::find($id);
        $company->country_id = $request->input('country');
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->color = $request->input('color');
        if($request->hasFile('logo')){
            $company->logo = $fileNameToStore;
        }
        $company->save();

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

        $showCompany = ShowCompany::where('company_id', $id)->first();
        $showCompany->lat = $lat;
        $showCompany->lng = $lng;
        $showCompany->save();

        return redirect('/admin/companies/'.$id)->with('success', 'Company Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if($company->logo != 'noimage.png'){
            //Delete image
            Storage::delete('public/logo/'.$company->logo);
        } 
        $company->delete();
        return redirect('/admin/companies')->with('success', 'Company Removed');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(int $id) 
    {
        // return Excel::download(new EmployeeExport, 'employeeData.xlsx');
        $emp = Employee::find($id);
        $name = $emp->last_name.', '.$emp->first_name.' Data.xlsx';
        return (new EmployeeExport)->employeeID($id)->download($name);

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function import(Request $request, $id) 
    {
       
        $this->validate($request, [
            'file' => 'required|mimes:csv,xlsx'
        ]);
        $data = Excel::toArray(new EmployeeImport($id), request()->file('file')); 
        $cl = collect(head($data));
        foreach($cl as $cls){
            if($cls['companyid'] != $id){
                $employee = Employee::where('company_id', $id)->where('id', $cls['id'])->first();
                if($employee != null){
                    return back()->with('error', 'Emploee is already in this company');
                }else{
                    Excel::import(new EmployeeImport($id), $request->file('file'));
                    return back()->with('success', 'Emploee successfully imported in this company');
                }
                
            }else{
                
                //check if the employee is need to return in their old company
                $check_employee = Employee::where('company_id', $cls['companyid'])->first();
                if ($check_employee != null) {
                    $employee = Employee::where('company_id', $id)->where('id', $cls['id'])->first();
                    if($employee != null){
                        return back()->with('error', 'Emploee is already in this company');
                    }else{
                        Excel::import(new EmployeeImport($id), $request->file('file'));
                        return back()->with('success', 'Emploee successfully imported in this company');
                    }
                }else{
                    // return 'yes';
                    // return back()->with('error', 'Emploee is already in this company');
                    Excel::import(new EmployeeImport($id), $request->file('file'));
                    return back()->with('success', 'Emploee successfully imported in this company');
                }
                
            }
        }
    }

    public function destroyCompanyAndEmployee($id){
        $employee = Employee::where('company_id', $id)->get();
        foreach ($employee as $key => $value) {
            $value->delete();
        }
        // $employee->delete();
        $company = Company::find($id);
        if($company->logo != 'noimage.png'){
            //Delete image
            Storage::delete('public/logo/'.$company->logo);
        } 
        $company->delete();
        return redirect('/admin/companies')->with('success', 'Company Removed');
    }
}
