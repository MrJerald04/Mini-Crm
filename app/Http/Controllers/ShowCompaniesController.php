<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShowCompany;
use App\Company;

class ShowCompaniesController extends Controller
{
    public function showCompanies(){

        // $showCompanies = ShowCompany::find(1);
        $showCompanies = ShowCompany::join('companies', 'companies.id', '=', 'show_companies.company_id')
            ->select('companies.*', 'show_companies.lat', 'show_companies.lng')
            ->get();
        
        return $showCompanies;
    }
}
