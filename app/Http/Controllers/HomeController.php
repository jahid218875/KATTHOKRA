<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Mail\SignUp;
use App\Models\Type;
use App\Models\User;
use App\Mail\Contact;
use App\Models\Paper;
use App\Models\Review;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Teacher;
use App\Mail\SearchMail;
use App\Models\Bookmark;
use App\Models\Highlight;
use App\Models\HscContent;
use App\Models\PremiumUser;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PremiumCourses;
use App\Models\EngineeringType;
use App\Models\EngineeringContent;
use App\Models\EngineeringSubject;
use Illuminate\Support\Facades\DB;
use App\Models\EngineeringBookmark;
use App\Models\EngineeringHighlight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

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

    public function contact_form(Request $request)
    {

        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',

        ]);


        Mail::to('community@katthokra.com')->send(new Contact($data['name'], $data['email'], $data['message']));
        return back()->with('Thank you');
    }

    public function about()
    {

        return view('visitor.about');
    }

    public function hsc_admission()
    {
        return view('visitor.hsc-page');
    }

    // Search 

    public function search(Request $request)
    {


        $ss = $request->input('query');
        $search = "like','%$ss%";
        // $HscAndAdmission = HscContent::whereRaw('match(editor1) against(?)', [$search])->get();


        // dd($request->input('query'));
        $HscAndAdmission = HscContent::whereRaw('match(editor1) against(?)', [$search])
            ->orWhereRaw('match(editor2) against(?)', [$search])
            ->orWhereRaw('match(editor3) against(?)', [$search])
            ->orWhereRaw('match(editor4) against(?)', [$search])
            ->orWhereRaw('match(editor5) against(?)', [$search])
            ->with('getSubject')
            ->get();


        $EngineeringContent = EngineeringContent::where('editor1', 'like', '%' . $request->input('query') . '%')
            ->Orwhere('editor2', 'like', '%' . $request->input('query') . '%')
            ->Orwhere('editor3', 'like', '%' . $request->input('query') . '%')
            ->Orwhere('editor4', 'like', '%' . $request->input('query') . '%')
            ->Orwhere('editor5', 'like', '%' . $request->input('query') . '%')->with('getSubject')
            ->get();

        return view('visitor.search', compact('HscAndAdmission', 'EngineeringContent'));
    }

    public function search_form(Request $request)
    {

        $data = $this->validate($request, [
            'level' => 'required',
            'my_message' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }


        Mail::to('community@katthokra.com')->send(new SearchMail($data['level'], $data['my_message'], $data['image']));
        return back()->with('Thank you');
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

    public function profile()
    {
        $user = Auth::user();
        return view('visitor.profile', compact('user'));
    }

    public function profile_update(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'level' => 'required',
            'institution' => 'required',
            'email' => 'required',
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


        User::where('email', Auth::user()->email)->update($data);
        return redirect()->route('profile')->with('success', 'Profile Updated Successfully');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function reader($name, $subject)
    {
        $papers = Subject::where(['group_name' => $name, 'subject_name' => $subject])->with('get_paper')->get();
        // dd($papers);

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
        $content = HscContent::with('getSubject')
            ->where([
                'paper_id' => $request->paper_id,
                'chapter_id' => $request->chapter_id,
                'type_id' => $request->type_id
            ])->first();
        // $content->getSubject->group_name == Science

        if ($content->course_type == 'Premium') {

            $prem = PremiumUser::with('courses')
                ->where(
                    [
                        'user_id' => Auth()->user()->id,
                        'status' => 'approve'
                    ]
                )->get();



            if ($prem) {

                $done = [];
                foreach ($prem as $premik) {
                    foreach ($premik->courses as $courses) {
                        $done[] = $courses->course;
                    }
                }

                $sd = Subscription::whereIn('id', $done)->get();

                $final = [];
                foreach ($sd as $final) {
                    if ($final->subs_item == $content->getSubject->group_name) {
                        $got = 'got it';
                    }
                }

                if (@$got) {
                    return $content;
                } else {
                    $content['pricing'] = 'freemium';
                    return (object)$content;
                }
            }


            $content['pricing'] = 'freemium';
            return (object)$content;
        } else {
            return $content;
        }

        // return $content;
    }

    // HSC Highlight 

    public function highlight(Request $request)
    {
        $data = $this->validate($request, [
            'subject' => 'required',
            'paper' => 'required',
            'chapter' => 'required',
            'type' => 'required',
            'content' => 'required',
            'page' => 'required',
        ]);
        $data['user_id'] = Auth()->user()->id;
        $data['save_type'] = 'highlight';

        // dd($data);
        Highlight::create($data);

        return 'data submitted';
    }

    public function highlight_data(Request $request)
    {
        $data = Highlight::where(['user_id' => Auth()->user()->id, 'paper' => $request->paper_id, 'chapter' => $request->chapter_id, 'type' => $request->type_id, 'page' => $request->page_id])->get();
        return $data;
    }

    public function highlight_list()
    {
        $highlight = Highlight::where('user_id', Auth()->user()->id)->with('getSubject', 'getPaper', 'getChapter', 'getType')->get();
        // dd($highlight);
        $EngineeringHighlight = EngineeringHighlight::where('user_id', Auth()->user()->id)->with('getSubject', 'getChapter', 'getType')->get();
        return view('visitor.highlight-list', compact('highlight', 'EngineeringHighlight'));
    }

    public function highlight_delete($id)
    {
        Highlight::where('id', $id)->delete();

        return back()->with('success', 'Highlight Deleted!');
    }

    public function eng_highlight_delete($id)
    {
        EngineeringHighlight::where('id', $id)->delete();

        return back()->with('success', 'Highlight Deleted!');
    }

    // Bookmark 

    public function bookmark(Request $request)
    {
        $data = $this->validate($request, [
            'group' => 'required',
            'subject' => 'required',
            'paper' => 'required',
            'chapter' => 'required',
            'type' => 'required',
            'page' => 'required',
        ]);
        $data['user_id'] = Auth()->user()->id;
        $data['save_type'] = 'bookmark';

        $check = Bookmark::where($data)->first();
        if ($check) {
            return 'error';
        }

        Bookmark::create($data);

        return 'success';
    }

    public function bookmark_list()
    {
        $bookmark = Bookmark::where('user_id', Auth()->user()->id)->with('getSubject', 'getPaper', 'getChapter', 'getType')->get();
        // dd($bookmark);
        $eng_bookmark = EngineeringBookmark::where('user_id', Auth()->user()->id)->with('getSubject', 'getChapter', 'getType')->get();
        return view('visitor.bookmark-list', compact('bookmark', 'eng_bookmark'));
    }

    public function bookmark_delete($id)
    {
        Bookmark::where('id', $id)->delete();

        return back()->with('success', 'Bookmark Deleted!');
    }

    public function eng_bookmark_delete($id)
    {
        EngineeringBookmark::where('id', $id)->delete();

        return back()->with('success', 'Bookmark Deleted!');
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
        // $content = EngineeringContent::where(['chapter_id' => $request->chapter_id, 'type_id' => $request->type_id])->first();
        // return $content;

        $content = EngineeringContent::with('getSubject')
            ->where([
                'chapter_id' => $request->chapter_id,
                'type_id' => $request->type_id
            ])->first();
        // $content->getSubject->group_name == Engineering
        // dd($content);

        if ($content->course_type == 'Premium') {

            $prem = PremiumUser::with('courses')
                ->where(
                    [
                        'user_id' => Auth()->user()->id,
                        'status' => 'approve'
                    ]
                )->get();



            if ($prem) {

                $done = [];
                foreach ($prem as $premik) {
                    foreach ($premik->courses as $courses) {
                        $done[] = $courses->course;
                    }
                }

                $sd = Subscription::whereIn('id', $done)->get();

                $final = [];
                foreach ($sd as $final) {
                    if ($final->subs_item == $content->getSubject->subject_name) {
                        $got = 'got it';
                    }
                }

                if (@$got) {
                    return $content;
                } else {
                    $content['pricing'] = 'freemium';
                    return (object)$content;
                }
            }


            $content['pricing'] = 'freemium';
            return (object)$content;
        } else {
            return $content;
        }
    }

    // HSC Highlight 

    public function engineering_highlight(Request $request)
    {
        $data = $this->validate($request, [
            'subject' => 'required',
            'chapter' => 'required',
            'type' => 'required',
            'content' => 'required',
            'page' => 'required',
        ]);
        $data['user_id'] = Auth()->user()->id;
        $data['save_type'] = 'highlight';

        // dd($data);
        EngineeringHighlight::create($data);

        return 'data submitted';
    }
    public function engineering_highlight_data(Request $request)
    {
        $data = EngineeringHighlight::where(['user_id' => Auth()->user()->id, 'chapter' => $request->chapter_id, 'type' => $request->type_id, 'page' => $request->page_id])->get();
        return $data;
    }

    public function engineering_bookmark(Request $request)
    {
        $data = $this->validate($request, [
            'group' => 'required',
            'subject' => 'required',
            'chapter' => 'required',
            'type' => 'required',
            'page' => 'required',
        ]);
        $data['user_id'] = Auth()->user()->id;
        $data['save_type'] = 'bookmark';

        $check = EngineeringBookmark::where($data)->first();
        if ($check) {
            return 'error';
        }

        EngineeringBookmark::create($data);

        return 'success';
    }

    // Subscription 

    public function subscription()
    {
        $prem_user = PremiumCourses::where('user_id', Auth()->user()->id)->get();
        // $prem_user->
        $course_id = [];
        foreach ($prem_user as $courses) {
            $course_id[] = $courses->course;
        }

        // dd($course_id);
        if ($prem_user) {
            $sub_hsc = Subscription::whereNotIn('id', $course_id)->where('type', 'HSC')->get();
            // dd($sub_hsc[0]->type);
            $sub_eng = Subscription::whereNotIn('id', $course_id)->where('type', 'Engineering')->get();
        } else {
            $sub_hsc = Subscription::where('type', 'HSC')->get();
            $sub_eng = Subscription::where('type', 'Engineering')->get();
        }



        return view('visitor.subscription', compact('sub_hsc', 'sub_eng'));
    }

    public function subscription_total(Request $request)
    {
        $subs_total = Subscription::where('id', $request->sub_id)->first();
        return $subs_total;
    }

    public function checkout_data(Request $request)
    {
        // $a = json_encode($request->course);

        $this->validate($request, [
            'course' => 'required'
        ]);

        $courses = Subscription::whereIn('id', $request->course)->get();
        $total = Subscription::whereIn('id', $request->course)->sum('subscription_fee');


        $ids = $request->course;


        return redirect('checkout')->with(['courses' => $courses, 'total' => $total, 'ids' => $ids]);
    }

    public function checkout()
    {

        // dd(session()->get('ids'));

        if (session()->get('courses')) {
            return view('visitor.checkout');
        }

        return redirect('subscription');
    }


    public function premium_user(Request $request)
    {
        // $prem_user = PremiumUser::where('user_id', Auth()->user()->id)->first();
        // dd($prem_user);
        $courses = explode(',', $request->course);
        $order_id = random_int(100000, 999999);

        foreach ($courses as $course) {
            $premium_courses = [
                'course' => $course,
                'order_id' => $order_id,
                'user_id' => Auth()->user()->id,
            ];

            PremiumCourses::create($premium_courses);
        }

        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'PaymentType' => 'required',
            'PaymentNumber' => 'required',
            'transaction_id' => 'required',
        ]);
        $data['zipCode'] = $request->zipCode;
        $data['message'] = $request->message;
        $data['status'] = 'pending';
        $data['user_id'] = Auth()->user()->id;
        $data['order_id'] = $order_id;

        PremiumUser::create($data);




        $success = "Your Order has been Successfully Submitted";

        return redirect('subscription')->with('success', $success);
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
