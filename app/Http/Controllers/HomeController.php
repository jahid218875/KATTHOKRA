<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        return view('visitor.index');
    }

    public function login()
    {
        return view('visitor.login');
    }

    public function group($name)
    {
        return view('visitor.group');
    }



    public function loginSubmit(Request $request)
    {

        if ($request->email and empty(@$request->otp) and empty($request->password)) {

            $user = User::where('email', $request->email)->first();
            if ($user) {
                return ['status' => 'password'];
            } else {
                $six_digit_random_number = random_int(100000, 999999);
                User::create(['email' => $request->email, 'otp' => $six_digit_random_number]);
                return ['status' => 'otp', 'email' => $request->email, 'otp' => $six_digit_random_number];
            }
        } elseif ($request->email and $request->otp and empty($request->password)) {
            // return $request->all();

            $user = User::where(['email' => $request->email, 'otp' => $request->otp])->first();
            if ($user) {
                return ['status' => 'set passsword'];
            } else {
                return ['status' => 'invalid otp'];
            }
        } elseif ($request->email and $request->otp and $request->password) {
            User::where('email', $request->email)->update(['password' => bcrypt($request->password), 'otp' => null]);
            return back()->with('success', 'Thank you for registration, Login to continue..');
        }
    }
}
