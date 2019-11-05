<?php

namespace App\Imports;

use App\Employee;
use App\User;
use App\Notification;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Input;
use Redirect;

class EmployeeImport implements ToModel, WithHeadingRow
{
    private $cid;
    public function  __construct($id)
    {
        $this->cid = $id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employee = Employee::where('id', '=', $row['id'])->first();
        if($employee->exists()){
                $employee->company_id = $this->cid;
                $employee->save();
        }else{
            // add employee
            $emp = new Employee();
            $emp->last_name = $row['countryid'];
            $emp->last_name = $row['lastname'];
            $emp->first_name = $row['firstname'];
            $emp->company_id = $this->cid;//company id
            $emp->email = $row['email'];
            $emp->password = $row['password'];
            $emp->phone = $row['phone'];
            $emp->save();
            //get the id of new created employee 
            $lastInsertedEmployeeId = $emp->id;
            
            $listOfEmployeeInSelectedCompany = Employee::where('company_id', $row['companyid'])->get();
            foreach ($listOfEmployeeInSelectedCompany as $leis) {
                if ($leis->email != $row['email']) {
                    $emp = new Notification();
                    $emp->employee_id = $leis->id;
                    $emp->new_employee_id = $lastInsertedEmployeeId;
                    $emp->company_id = $row['companyid'];//company id
                    $emp->status = 0;
                    $emp->save();
                }
            }
            
        }
        

        $notifDeleteEmployee = Notification::where('new_employee_id', $row['id']);
        $notifDeleteEmployee->delete();

        $listOfEmployeeInSelectedCompany = Employee::where('company_id', $this->cid)->get();
        foreach ($listOfEmployeeInSelectedCompany as $leis) {
            if ($leis->email != $row['email']) {
                $emp = new Notification();
                $emp->employee_id = $leis->id;
                $emp->new_employee_id = $row['id'];
                $emp->company_id = $this->cid;//company id
                $emp->status = 0;
                $emp->save();
            }
        }


    }
}
