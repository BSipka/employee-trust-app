<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Company;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{

    public function index()
    {
        $companies = Company::with('advertisements')->get();
        return $companies;
    }
}
