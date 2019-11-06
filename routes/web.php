<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@index');
Route::prefix('admin')->group(function(){
    Route::get('/dashboard', 'PageController@AdminDashboard')->name('admin.dashboard');
    Route::get('/companies', 'PageController@AdminCompanies')->name('admin.companies');
    Route::get('/employees', 'PageController@AdminEmployees')->name('admin.employees');
    Route::get('/send_mail', 'PageController@AdminSendEmail')->name('admin.send_email');
    Route::get('/map', 'PageController@AdminMap')->name('admin.map');

    Route::resource('/companies', 'Admin\CompanyController');
    Route::resource('/employees', 'Admin\EmployeeController');
    Route::resource('/send_email', 'Admin\SendEmailController');
});
Route::prefix('employee')->group(function(){
    Route::get('/dashboard', 'PageController@EmployeeDashboard')->name('employee.dashboard');
    Route::get('/companies', 'PageController@EmployeeCompanies')->name('employee.companies');
    Route::get('/employees', 'PageController@EmployeeEmployees')->name('employee.employees');
    Route::get('/send_mail', 'PageController@EmployeeSendEmail')->name('employee.send_email');
    Route::get('/map', 'PageController@EmployeeMap')->name('employee.map');
    Route::get('/profile', 'PageController@EmployeeProfile')->name('employee.profile');

    Route::resource('/companies', 'Employee\CompanyController');
    Route::resource('/employees', 'Employee\EmployeeController');
    Route::resource('/send_email', 'Employee\SendEmailController');
    Route::resource('/change_password', 'Employee\ChangePasswordController');
});
//for admin
    // for companies datatable
    Route::get('companies-data', 'Admin\CompanyController@companiesList')->name('company.data');
    Route::get('companies-employee-data/{cid}', 'Admin\CompanyController@companiesEmployeeList')->name('company_employee.data');

    // for employees datatable
    Route::get('employies-data', 'Admin\EmployeeController@employeesList')->name('employee.data');
    Route::get('employees/{id}/{notifID}', 'Employee\EmployeeController@readedNotification')->name('employee_notif.data');

    //for import and export
    Route::get('export/{id}', 'Admin\CompanyController@export')->name('export.data');
    Route::post('import/{id}', 'Admin\CompanyController@import')->name('import');
    //for deleteing company and employee

    Route::post('/companies/{id}', 'Admin\CompanyController@destroyCompanyAndEmployee');
//----
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    ]);



