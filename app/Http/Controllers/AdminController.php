<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Type;
use App\Models\User;
use App\Models\Admin;
use App\Models\Paper;
use App\Models\Review;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\HscContent;
use Mockery\Matcher\Subset;
use Illuminate\Http\Request;
use App\Models\EngineeringType;
use App\Models\EngineeringChapter;
use App\Models\EngineeringContent;
use App\Models\EngineeringSubject;
use App\Models\PremiumCourses;
use App\Models\PremiumUser;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login()
    {

        return view('admin.login');
    }


    public function loginSubmit(Request $request)
    {
        $login = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $login['role'] = 'admin';

        $editor = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'editor',
        ];

        if (auth()->guard('admin')->attempt($login)) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->guard('editor')->attempt($editor)) {
            return redirect()->route('editor.hsc_content_list');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        auth()->guard('editor')->logout();
        return redirect()->route('manager.login');
    }

    public function dashboard()
    {
        $admin = Admin::where('role', 'admin')->count();
        $editor = Admin::where('role', 'editor')->count();
        $users = User::count();
        $posts = HscContent::count();

        return view('admin.main', compact('admin', 'editor', 'users', 'posts'));
    }


    // Editor Added 
    public function editor_add()
    {
        $editor = Admin::where('role', 'editor')->OrderBy('id', 'desc')->get();
        // dd($editor);
        return view('admin.editor-add', compact('editor'));
    }

    public function editor_add_process(Request $request)
    {
        $editor = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);
        $editor['password'] = bcrypt($request->password);
        $editor['role'] = 'editor';

        $check = Admin::where('email', $request->email)->first();
        if ($check) {
            unset($editor['email']);
            Admin::where('email', $request->email)->update($editor);
            $success = "Editor Updated Successfully";
        } else {
            Admin::create($editor);
            $success = "Editor Added Successfully";
        }


        return back()->with('success', $success);
    }

    public function editor_delete($id)
    {
        Admin::where('id', $id)->delete();

        return back()->with('success', 'Editor Deleted!');
    }


    // Teacher Added 
    public function teacher_add()
    {
        $teacher = Teacher::get();
        return view('admin.teacher-add', compact('teacher'));
    }

    public function teacher_add_process(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'email' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->file('image')) {
            $image      = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path() . '/uploads', $image_name);
        }

        $data['image'] = $image_name;

        Teacher::create($data);

        $success = "Teacher Homepage Added Successfully";

        return back()->with('success', $success);
    }

    public function teacher_delete($id)
    {
        Teacher::where('id', $id)->delete();

        return back()->with('success', 'Teacher Deleted!');
    }


    // Ads 

    public function ads()
    {
        $ads = Ads::get();
        return view('admin.ads', compact('ads'));
    }

    public function ads_process(Request $request)
    {
        $data = $this->validate($request, [
            'ads_name' => 'required',
            'ads_image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->file('ads_image')) {
            $image      = $request->file('ads_image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path() . '/uploads', $image_name);
        }

        $data['ads_image'] = $image_name;

        Ads::create($data);

        $success = "Ads Image Added Successfully";

        return back()->with('success', $success);
    }

    public function ads_delete($id)
    {
        Ads::where('id', $id)->delete();

        return back()->with('success', 'Ads Deleted!');
    }

    // Review add 

    public function review_add()
    {
        $review = Review::get();
        return view('admin.review-add', compact('review'));
    }

    public function review_add_process(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'university_name' => 'required',
            'review' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->file('image')) {
            $image      = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path() . '/uploads', $image_name);
        }

        $data['image'] = $image_name;

        Review::create($data);

        $success = "Review Homepage Added Successfully";

        return back()->with('success', $success);
    }

    public function review_delete($id)
    {
        Review::where('id', $id)->delete();

        return back()->with('success', 'Review Deleted!');
    }


    // Subscription Add 

    public function subscription_add()
    {
        $Hscgroup = Subject::select('group_name')->groupBy('group_name')->get();
        $eng_subject = EngineeringSubject::get();
        // dd($eng_subject[0]->subject_name);
        return view('admin.subscription-add', compact('Hscgroup', 'eng_subject'));
    }

    public function subscription_add_process(Request $request)
    {
        $data = $this->validate($request, [
            'type' => 'required',
            'subs_item' => 'required',
            'subscription_fee' => 'required',
        ]);

        Subscription::create($data);

        $success = "Subscription Added Successfully";

        return back()->with('success', $success);
    }

    public function subscription_list()
    {
        $subscription = Subscription::get();

        return view('admin.subscription-list', compact('subscription'));
    }

    public function subscription_edit($id)
    {
        $subscription = Subscription::where('id', $id)->first();
        // dd($subscription);

        return view('admin.subscription-edit', compact('subscription'));
    }

    public function subscription_update($id, Request $request)
    {
        $data = $this->validate($request, [
            'type' => 'required',
            'subs_item' => 'required',
            'subscription_fee' => 'required',
        ]);

        Subscription::where('id', $id)->update($data);

        $success = "Subscription Updated Successfully";

        return redirect()->route('admin.subscription_list')->with('success', $success);
    }

    public function subscription_delete($id)
    {
        Subscription::where('id', $id)->delete();

        return back()->with('success', 'Subscription Deleted!');
    }

    // Premium User 

    public function premium_user_list()
    {
        $premium_user = PremiumUser::get();

        return view('admin.premium-user-list', compact('premium_user'));
    }

    public function premium_user_edit($id)
    {
        $premium_user = PremiumUser::where('id', $id)->first();
        $PremiumCourses = PremiumCourses::where(['user_id' => $premium_user->user_id, 'order_id' => $premium_user->order_id])->get();

        $prem_Courses = [];
        foreach ($PremiumCourses as $courses) {
            $prem_Courses[] = $courses->course;
        }

        $courses = Subscription::whereIn('id', $prem_Courses)->get();
        $total = Subscription::whereIn('id', $prem_Courses)->sum('subscription_fee');

        return view('admin.premium-user-edit', compact('premium_user', 'courses', 'total'));
    }

    public function premium_update($id, Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        PremiumUser::where('id', $id)->update($data);

        $success = "Premium User Updated Successfully";

        return redirect()->route('admin.premium_user_list')->with('success', $success);
    }
    public function premium_user_delete($id)
    {
        $PremiumUser = PremiumUser::where('id', $id)->first();
        PremiumCourses::where('order_id', $PremiumUser->order_id)->delete();
        PremiumUser::where('id', $id)->delete();


        return back()->with('success', 'Premium User Deleted!');
    }

    // Subject Added 
    public function subject_add()
    {
        $subject = Subject::OrderBy('id', 'desc')->get();
        // dd($subject);
        return view('admin.subject-add', compact('subject'));
    }

    public function subject_add_process(Request $request)
    {
        $data = $this->validate($request, [
            'group_name' => 'required',
            'subject_name' => 'required',
            'subject_image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->file('subject_image')) {
            $image      = $request->file('subject_image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path() . '/uploads', $image_name);
        }

        $data['subject_image'] = $image_name;

        Subject::create($data);

        $success = "Subject Added Successfully";

        return back()->with('success', $success);
    }

    public function subject_edit($id)
    {
        $subject = Subject::where('id', $id)->first();

        return view('admin.subject-edit', compact('subject'));
    }

    public function subject_update($id, Request $request)
    {
        $data = $this->validate($request, [
            'group_name' => 'required',
            'subject_name' => 'required',
            'subject_image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->file('subject_image')) {
            $image      = $request->file('subject_image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path() . '/uploads', $image_name);
        }

        $data['subject_image'] = $image_name;

        Subject::where('id', $id)->update($data);

        $success = "Subject Updated Successfully";

        return redirect()->route('admin.subject_add')->with('success', $success);
    }

    public function subject_delete($id)
    {
        Subject::where('id', $id)->delete();
        Paper::where('subject_id', $id)->delete();
        Chapter::where('subject_id', $id)->delete();
        Type::where('subject_id', $id)->delete();
        HscContent::where('subject_id', $id)->delete();

        return back()->with('success', 'Subject Deleted!');
    }

    // Paper Added 

    public function paper_add()
    {
        $subject = Subject::get();
        $paper = Paper::with('getSubject')->get();
        return view('admin.paper-add', compact('subject', 'paper'));
    }

    public function paper_add_process(Request $request)
    {

        $paper = $this->validate($request, [
            'subject_id' => 'required',
            'paper_name' => 'required',
        ]);

        $check = Paper::where($paper)->first();
        if ($check) {
            return back()->with('error', 'This Paper Name is Already Exists');
        }

        Paper::create($paper);

        $success = "Paper Added Successfully";

        return back()->with('success', $success);
    }

    public function paper_delete($id)
    {
        Paper::where('id', $id)->delete();
        Chapter::where('paper_id', $id)->delete();
        Type::where('paper_id', $id)->delete();
        HscContent::where('paper_id', $id)->delete();
        return back()->with('success', 'Paper Deleted!');
    }


    // Chapter Added 
    public function chapter_add()
    {
        $subject = Subject::get();
        $paper = Paper::get();
        $chapter = Chapter::with('getSubject', 'getPaper')->get();

        return view('admin.chapter-add', compact('subject', 'paper', 'chapter'));
    }

    public function chapter_add_process(Request $request)
    {
        return Paper::where('subject_id', $request->subject_id)->get();
    }

    public function chapter_add_submit(Request $request)
    {

        $chapter = $this->validate($request, [
            'subject_id' => 'required',
            'paper_id' => 'required',
            'chapter_name' => 'required',
        ]);

        $check = Chapter::where($chapter)->first();
        if ($check) {
            return back()->with('error', 'This Chapter Name is Already Exists');
        }

        Chapter::create($chapter);

        $success = "Chapter Added Successfully";

        return back()->with('success', $success);
    }

    public function chapter_delete($id)
    {
        Chapter::where('id', $id)->delete();
        Type::where('chapter_id', $id)->delete();
        HscContent::where('chapter_id', $id)->delete();
        return back()->with('success', 'Chapter Deleted!');
    }


    // Type Added 

    public function type_add()
    {
        $subject = Subject::get();
        $paper = Paper::get();

        $type = Type::with('getSubject', 'getPaper', 'getChapter')->get();

        return view('admin.type-add', compact('subject', 'paper', 'type'));
    }

    public function type_add_process(Request $request)
    {
        return Chapter::where('paper_id', $request->paper_id)->get();
    }

    public function type_add_submit(Request $request)
    {

        $type = $this->validate($request, [
            'subject_id' => 'required',
            'paper_id' => 'required',
            'chapter_id' => 'required',
            'type_name' => 'required',
        ]);

        $check = Type::where($type)->first();
        if ($check) {
            return back()->with('error', 'This Type Name is Already Exists');
        }

        Type::create($type);

        $success = "Type Added Successfully";

        return back()->with('success', $success);
    }

    public function type_delete($id)
    {
        Type::where('id', $id)->delete();
        HscContent::where('type_id', $id)->delete();
        return back()->with('success', 'Type Deleted!');
    }

    // Hsc Content List 

    public function hsc_content_list()
    {
        $hsc_content = HscContent::with('getSubject', 'getPaper', 'getChapter', 'getType')->get();

        return view('admin.admin-hsc-content-list', compact('hsc_content'));
    }

    public function hsc_content_edit($id)
    {

        $content = HscContent::where('id', $id)->with('getSubject', 'getPaper', 'getChapter', 'getType')->first();

        // dd($content);

        return view('admin.hsc-content-edit', compact('content'));
    }

    public function hsc_content_update($id, Request $request)
    {

        $hsc_content = $this->validate($request, [
            'editor_id' => 'required',
            'editor_name' => 'required',
            'subject_id' => 'required',
            'paper_id' => 'required',
            'chapter_id' => 'required',
            'type_id' => 'required',
            'editor1' => 'required',
            'status' => 'required',
            'course_type' => 'required',
        ]);

        $hsc_content['editor2'] = $request->editor2;
        $hsc_content['editor3'] = $request->editor3;
        $hsc_content['editor4'] = $request->editor4;
        $hsc_content['editor5'] = $request->editor5;

        HscContent::where('id', $id)->update($hsc_content);



        return redirect()->route('admin.hsc_content_list')->with('success', 'Content Update Successfully');
    }

    public function hsc_content_delete($id)
    {
        HscContent::where('id', $id)->delete();
        return back()->with('success', 'Hsc Content Deleted!');
    }

    // Engineering Subject Added 
    public function engineering_subject_add()
    {
        $subject = EngineeringSubject::OrderBy('id', 'desc')->get();
        // dd($subject);
        return view('admin.engineering-subject-add', compact('subject'));
    }

    public function engineering_subject_process(Request $request)
    {
        $data = $this->validate($request, [
            'group_name' => 'required',
            'subject_name' => 'required',
            'subject_image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->file('subject_image')) {
            $image      = $request->file('subject_image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path() . '/uploads', $image_name);
        }

        $data['subject_image'] = $image_name;

        EngineeringSubject::create($data);

        $success = "Subject Added Successfully";

        return back()->with('success', $success);
    }

    public function engineering_subject_edit($id)
    {
        $subject = EngineeringSubject::where('id', $id)->first();

        return view('admin.engineering-subject-edit', compact('subject'));
    }

    public function engineering_subject_update($id, Request $request)
    {
        $data = $this->validate($request, [
            'group_name' => 'required',
            'subject_name' => 'required',
            'subject_image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        if ($request->file('subject_image')) {
            $image      = $request->file('subject_image');
            $image_name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path() . '/uploads', $image_name);
        }

        $data['subject_image'] = $image_name;

        EngineeringSubject::where('id', $id)->update($data);

        $success = "Subject Updated Successfully";

        return redirect()->route('admin.engineering_subject_add')->with('success', $success);
    }

    public function engineering_subject_delete($id)
    {
        EngineeringSubject::where('id', $id)->delete();
        EngineeringChapter::where('subject_id', $id)->delete();
        EngineeringType::where('subject_id', $id)->delete();
        EngineeringContent::where('subject_id', $id)->delete();

        return back()->with('success', 'Subject Deleted!');
    }

    // Engineering Chapter Added 
    public function engineering_chapter_add()
    {
        $subject = EngineeringSubject::get();
        $chapter = EngineeringChapter::with('getSubject')->get();

        return view('admin.engineering-chapter-add', compact('subject', 'chapter'));
    }

    public function engineering_chapter_submit(Request $request)
    {

        $chapter = $this->validate($request, [
            'subject_id' => 'required',
            'chapter_name' => 'required',
        ]);

        $check = EngineeringChapter::where($chapter)->first();
        if ($check) {
            return back()->with('error', 'This Chapter Name is Already Exists');
        }

        EngineeringChapter::create($chapter);

        $success = "Chapter Added Successfully";

        return back()->with('success', $success);
    }

    public function engineering_chapter_delete($id)
    {
        EngineeringChapter::where('id', $id)->delete();
        EngineeringType::where('chapter_id', $id)->delete();
        EngineeringContent::where('chapter_id', $id)->delete();
        return back()->with('success', 'Chapter Deleted!');
    }

    // Engineering Type Added 

    public function engineering_type_add()
    {
        $subject = EngineeringSubject::get();

        $type = EngineeringType::with('getSubject', 'getChapter')->get();

        return view('admin.engineering-type-add', compact('subject', 'type'));
    }

    public function engineering_type_process(Request $request)
    {
        return EngineeringChapter::where('subject_id', $request->subject_id)->get();
    }

    public function engineering_type_submit(Request $request)
    {

        $type = $this->validate($request, [
            'subject_id' => 'required',
            'chapter_id' => 'required',
            'type_name' => 'required',
        ]);

        $check = EngineeringType::where($type)->first();
        if ($check) {
            return back()->with('error', 'This Type Name is Already Exists');
        }

        EngineeringType::create($type);

        $success = "Type Added Successfully";

        return back()->with('success', $success);
    }

    public function engineering_type_delete($id)
    {
        EngineeringType::where('id', $id)->delete();
        EngineeringContent::where('type_id', $id)->delete();
        return back()->with('success', 'Type Deleted!');
    }

    // Engineering Content List 

    public function engineering_content_list()
    {
        $engineering_content = EngineeringContent::with('getSubject', 'getChapter', 'getType')->get();

        return view('admin.admin-engineering-content-list', compact('engineering_content'));
    }

    public function engineering_content_edit($id)
    {

        $content = EngineeringContent::where('id', $id)->with('getSubject', 'getChapter', 'getType')->first();

        // dd($content);

        return view('admin.engineering-content-edit', compact('content'));
    }

    public function engineering_content_update($id, Request $request)
    {

        $content = $this->validate($request, [
            'editor_id' => 'required',
            'editor_name' => 'required',
            'subject_id' => 'required',
            'chapter_id' => 'required',
            'type_id' => 'required',
            'editor1' => 'required',
            'status' => 'required',
            'course_type' => 'required',
        ]);

        $content['editor2'] = $request->editor2;
        $content['editor3'] = $request->editor3;
        $content['editor4'] = $request->editor4;
        $content['editor5'] = $request->editor5;

        EngineeringContent::where('id', $id)->update($content);



        return redirect()->route('admin.engineering_content_list')->with('success', 'Content Update Successfully');
    }

    public function engineering_content_delete($id)
    {
        EngineeringContent::where('id', $id)->delete();
        return back()->with('success', 'Content Deleted!');
    }


    public function user_list()
    {
        $user_list = User::get();

        return view('admin.user-list', compact('user_list'));
    }

    public function user_delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with('success', 'User Deleted!');
    }
}
