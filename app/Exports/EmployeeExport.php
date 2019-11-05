<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class EmployeeExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use Exportable;
    public function employeeID(int $id)
    {
        $this->id = $id;
        
        return $this;
    }

    public function query()
    {
        return Employee::where('id', $this->id);
    }
    public function headings(): array
    {
        return [
            'id',
            'countryid',
            'firstname',
            'lastname',
            'companyid',
            'email',
            'password',
            'phone',
            'created_at',
            'updated_at'
        ];
    }
}
