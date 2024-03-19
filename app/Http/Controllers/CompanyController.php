<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return Company::get();
    }

    public function show(Company $company)
    {
        return $company;
    }
}
