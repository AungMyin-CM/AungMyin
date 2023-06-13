<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuperAdminLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

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

            if (auth()->attempt($formFields) && $data->is_superadmin == true) {
                $request->session()->regenerate();

                return redirect('aung_myin/admin_dashboard')->with('message', 'You are now logged in!');
            }

            return back()->withErrors(['code' => 'Invalid Credentials!'])->onlyInput('code');
        }
    }

    public function index()
    {
        return view('superadmin.index');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('aung_myin/admin_dashboard/login');
    }
}
