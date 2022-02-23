<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Clinic;

class ClinicController extends Controller
{
    public function register(RegisterRequest $request) 
    {
        $clinic = Clinic::create($request->validated());
        return redirect('/')->with('success', "Clinic successfully registered.");
    }

}
