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
            'editor_email' => 'required',
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
}
