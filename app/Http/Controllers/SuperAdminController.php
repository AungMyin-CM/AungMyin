<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Package;
use App\Models\UserClinic;
use App\Models\PackagePurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SuperAdminLoginRequest;

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

    public function users(Request $request)
    {
        $type = $request->query('type');

        if ($type === 'p_users') {
            // Get Package Purchased Users
            $users = User::has('package_purchase')->get();
            return view('superadmin.users')->with('users', $users);
        } elseif ($type === 'f_users') {
            // Get Free Users
            return "This is free users";
        } elseif ($type === 'v_users') {
            // Get Only Verified
            $users = User::where('email_verified', 1)->doesntHave('user_clinic')->get();
            return view('superadmin.users')->with('users', $users);
        } elseif ($type === 'u_users') {
            // Get Unverified Users
            $users = User::where('email_verified', 0)->get();
            return view('superadmin.users')->with('users', $users);
        } elseif ($type === 'c_users') {
            // Get Clinics Users
            $users = User::has('user_clinic')->get();
            return view('superadmin.users')->with('users', $users);
        } else {
            $users = User::all();
            return view('superadmin.users')->with('users', $users);
        }
    }

    public function edit(String $id)
    {
        $user = User::where('id', $id)->get()->first();
        return view('superadmin.edit')->with('user', $user);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'phoneNumber' => 'required',
            'password' => 'confirmed',
        ]);

        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('images/avatars'), $filename);
        } else {
            $filename = User::where('id', $id)->value('avatar');
        }

        $requests = [
            'name' => $request->name,
            'speciality' => $request->speciality,
            'avatar' => $filename,
            'credentials' => $request->credentials,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'gender' => $request->gender,
            'short_bio' => $request->short_bio,
            'fees' => $request->fees,
        ];

        if ($request->password != null && trim($request->password) != '') {
            $requests += ['password' => Hash::make($request->password)];
        }

        User::whereId($id)->update($requests);

        return redirect('aung_myin/admin_dashboard/users')->with('success', 'User updated successfully!');
    }

    public function clinics()
    {
        $clinics = Clinic::all();
        return view('superadmin.clinics')->with('clinics', $clinics);
    }

    public function profile()
    {
        $user = auth()->user();
        return view('superadmin.profile')->with('user', $user);
    }

    public function profileUpdate(Request $request, String $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'phoneNumber' => 'required',
            'password' => 'confirmed',
        ]);

        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('images/avatars'), $filename);
        } else {
            $filename = User::where('id', $id)->value('avatar');
        }

        $requests = [
            'name' => $request->name,
            'speciality' => $request->speciality,
            'avatar' => $filename,
            'credentials' => $request->credentials,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'gender' => $request->gender,
            'short_bio' => $request->short_bio,
            'fees' => $request->fees,
        ];

        if ($request->password != null && trim($request->password) != '') {
            $requests += ['password' => Hash::make($request->password)];
        }

        User::whereId($id)->update($requests);

        return redirect('aung_myin/admin_dashboard/profile')->with('success', 'User updated successfully!');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('aung_myin/admin_dashboard/login');
    }
}
