<?php

namespace App\Http\Controllers;

use App\Mail\SignUp;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

            $user = User::where('email', $request->email)->whereNull('otp')->first();
            if ($user) {
                return ['status' => 'password'];
            } else {
                $six_digit_random_number = random_int(100000, 999999);

                $user = User::where('email', $request->email)->first();
                if ($user) {
                    User::where('email', $request->email)->update(['otp' => $six_digit_random_number]);
                } else {
                    User::create(['email' => $request->email, 'otp' => $six_digit_random_number]);
                }

                //mail to SignUp
                if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($request->email)->send(new SignUp($request->email, $six_digit_random_number));
                } else {

                    $token = "21|ZEzUo3Z09qMHOiVMvvzfKCnbJWYVnws2ksrtyQ4n";
                    $email = $request->email;
                    $url = "https://sms.devswire.com/api/v3/sms/send?recipient=88$email&sender_id=8804445600777&message=katthokra.com Otp Code is: $six_digit_random_number";
                    $authorization = "Authorization: Bearer " . $token;

                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $url, [
                        'headers' => ['Authorization' => 'Bearer ' . $token],
                    ]);
                    $body = $response->getBody();
                }

                return ['status' => 'otp', 'email' => $request->email, 'otp' => $six_digit_random_number];
            }
        } elseif ($request->email and $request->otp and empty($request->password)) {
            $user = User::where(['email' => $request->email, 'otp' => $request->otp])->first();
            if ($user) {
                return ['status' => 'set passsword'];
            } else {
                return ['status' => 'invalid otp'];
            }
        } elseif ($request->email and $request->otp and $request->password) {
            User::where('email', $request->email)->update(['password' => bcrypt($request->password), 'otp' => null]);
            return back()->with('success', 'Thank you for registration, Login to continue..');
        } elseif ($request->email and $request->password) {
            $login = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (Auth::attempt($login)) {
                if (empty(Auth::user()->name)) {
                    return redirect()->route('signup');
                } else {
                    return redirect()->route('home');
                }
            } else {
                return ['status' => 'invalid email or password'];
            }
        }
    }

    public function signup()
    {
        return view('visitor.signup');
    }

    public function signupData(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'level' => 'required',
            'institution' => 'required',
            'email_phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $name);
        $data['image'] = $name;

        $user = User::where('email', Auth::user()->email)->update($data);
        return redirect()->route('home');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
