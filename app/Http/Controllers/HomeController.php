<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Mail\SignUp;
use App\Models\Type;
use App\Models\User;
use App\Models\Paper;
use App\Models\Review;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\HscContent;
use Illuminate\Http\Request;
use App\Models\EngineeringType;
use App\Models\EngineeringContent;
use App\Models\EngineeringSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        $teachers = Teacher::get();
        $reviews = Review::get();
        $ads = Ads::get();
        $engineering = EngineeringSubject::orderBy('id', 'asc')->get();
        // dd($engineering);
        return view('visitor.index', compact('teachers', 'reviews', 'ads', 'engineering'));
    }

    public function engineering()
    {
        $engineering = EngineeringSubject::orderBy('id', 'asc')->get();
        // dd($engineering);
        return view('visitor.engineering', compact('engineering'));
    }

    public function contact()
    {

        return view('visitor.contact');
    }

    public function about()
    {

        return view('visitor.about');
    }

    public function hsc_admission()
    {
        return view('visitor.hsc-page');
    }

    public function login()
    {
        return view('visitor.login');
    }

    public function group($name)
    {
        $subject = Subject::where('group_name', $name)->get();
        // dd($subject);
        return view('visitor.group', compact('subject'));
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
                    Mail::to($request->email)->send(new SignUp($request->email, $six_digit_random_number, 'Thank you for Signup.'));
                } else {
                    $token = "28|4RAQVFfe8fJAyvqRL563ze8goiFecESpni5bHsoS";
                    $email = $request->email;
                    $url = "https://sms.devswire.com/api/v3/sms/send?recipient=88$email&sender_id=8804445632730&message=katthokra.com Otp Code is: $six_digit_random_number";

                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $url, [
                        'headers' => ['Authorization' => 'Bearer ' . $token],
                    ]);
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
                return back()->with('error', 'invalid email or password');
            }
        }
    }

    public function signup()
    {
        // $user = Auth::user();
        return view('visitor.signup');
    }

    public function signupData(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'level' => 'required',
            'institution' => 'required',
            'email_phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }


        $user = User::where('email', Auth::user()->email)->update($data);
        return redirect()->route('home');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function reader($name, $subject)
    {
        $papers = Subject::where(['group_name' => $name, 'subject_name' => $subject])->with('get_paper')->get();

        return view('visitor.reader', compact('papers'));
    }

    public function paper_to_chapter(Request $request)
    {
        return Chapter::where('paper_id', $request->paper_id)->get();
    }

    public function chapter_to_type(Request $request)
    {
        return Type::where('chapter_id', $request->chapter_id)->get();
    }

    public function type_to_content(Request $request)
    {
        $content = HscContent::where(['paper_id' => $request->paper_id, 'chapter_id' => $request->chapter_id, 'type_id' => $request->type_id])->first();
        return $content;
    }


    // Engineering Reader

    public function engineering_reader($subject)
    {
        $chapters = EngineeringSubject::where('subject_name', $subject)->with('get_chapter')->get();

        return view('visitor.engineering-reader', compact('chapters'));
    }

    public function engineering_chapter_to_type(Request $request)
    {
        return EngineeringType::where('chapter_id', $request->chapter_id)->get();
    }

    public function engineering_type_to_content(Request $request)
    {
        $content = EngineeringContent::where(['chapter_id' => $request->chapter_id, 'type_id' => $request->type_id])->first();
        // dd($content);
        return $content;
    }


    public function forgotPassword()
    {
        return view('visitor.forgot');
    }


    public function forgot(Request $request)
    {
        if ($request->email and empty($request->otp) and empty($request->password)) {
            $check = User::where('email', $request->email)->first();
            if ($check) {
                $six_digit_random_number = random_int(100000, 999999);
                User::where('email', $request->email)->update(['forgot' => $six_digit_random_number]);

                if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($request->email)->send(new SignUp($request->email, $six_digit_random_number, 'Forgot Password Verification Code..'));
                } else {
                    $token = "28|4RAQVFfe8fJAyvqRL563ze8goiFecESpni5bHsoS";
                    $email = $request->email;
                    $url = "https://sms.devswire.com/api/v3/sms/send?recipient=88$email&sender_id=8804445632730&message=katthokra.com Otp Code is: $six_digit_random_number";
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $url, [
                        'headers' => ['Authorization' => 'Bearer ' . $token],
                    ]);
                }
                return ['status' => 'otp'];
            } else {
                return ['error' => 'Email Or Phone not found'];
            }
        } elseif ($request->email and $request->otp and empty($request->password)) {
            $check = User::where(['email' => $request->email, 'forgot' => $request->otp])->first();
            if ($check) {
                return ['status' => 'set passsword'];
            } else {
                return ['error' => 'Invalid Otp Code...'];
            }
        } elseif ($request->email and $request->otp and $request->password) {
            User::where(['email' => $request->email, 'forgot' => $request->otp])->update(['password' => bcrypt($request->password), 'forgot' => null]);
            return redirect()->route('login')->with('success', 'Password Changed Successfully');
        }
    }
}
