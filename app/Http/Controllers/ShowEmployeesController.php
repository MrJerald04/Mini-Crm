<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShowEmployee;
use App\Employee;

class ShowEmployeesController extends Controller
{
    public function showEmployees(){
        $showEmployees = ShowEmployee::join('employees', 'employees.id', '=', 'show_employees.employee_id')
            ->join('companies', 'companies.id', '=', 'employees.company_id')
            ->select('employees.*', 'companies.color', 'companies.name', 'show_employees.lat', 'show_employees.lng')
            ->get();
        return $showEmployees;
    }
}
