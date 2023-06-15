<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Package;
use App\Models\PackagePurchase;
use App\Models\UserClinic;
use App\Http\Requests\SuperAdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function login()
    {
        return view('superadmin.login');
    }

    public function authenticate(SuperAdminLoginRequest $request)
    {
        if ($request->validated()) {
            $data = User::where('code', $request->code)->get()->first();

            $formFields = $request->only('code', 'password');

            if (Auth::guard('user')->attempt($formFields) && $data->is_superadmin == true) {
                $request->session()->regenerate();

                return redirect('aung_myin/admin_dashboard')->with('message', 'You are now logged in!');
            }

            return back()->withErrors(['code' => 'Invalid Credentials!'])->onlyInput('code');
        }
    }

    public function index()
    {
        // Get Total Users
        $total_users = count(User::all());

        // Get Package Purchased Users
        $p_users = count(PackagePurchase::all());

        // Get Unverified Users
        $u_users = count(User::where('email_verified', 0)->get());

        // Get Clinic Users
        $c_users = count(UserClinic::all());

        // Get Only Verified
        $v_users = $total_users - ($c_users + $u_users);

        // Get Total Clinics
        $total_clinics = count(Clinic::all());

        // Get Total Packages
        $total_packages = count(Package::all());

        return view('superadmin.index')
            ->with('total_users', $total_users)
            ->with('p_users', $p_users)
            ->with('v_users', $v_users)
            ->with('u_users', $u_users)
            ->with('c_users', $c_users)
            ->with('total_clinics', $total_clinics)
            ->with('total_packages', $total_packages);
    }

    public function users()
    {
        $users = User::all();
        return view('superadmin.users')->with('users', $users);
    }

    public function edit(String $id)
    {
        $user = User::where('id', $id)->get()->first();
        return view('superadmin.edit')->with('user', $user);
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('aung_myin/admin_dashboard/login');
    }
}
