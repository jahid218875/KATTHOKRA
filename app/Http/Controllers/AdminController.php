<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\Subject;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.main');
    }


    // Subject Added 
    public function subject_add()
    {
        return view('admin.subject-add');
    }
    // public function subject_list()
    // {
    //     return view('admin.subject-list');
    // }

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

    // Paper Added 

    public function paper_add()
    {
        $subject = Subject::get();
        return view('admin.paper-add', compact('subject'));
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


    // Chapter Added 
    public function chapter_add()
    {
        $subject = Subject::get();
        $paper = Paper::get();
        return view('admin.chapter-add', compact('subject', 'paper'));
    }

    public function chapter_add_process(Request $request)
    {
        $paper = Paper::where('subject_id', $request->subject_id)->get();

        $chapter = $this->validate($request, [
            'subject_id' => 'required',
            'paper_id' => 'required',
            'chapter_name' => 'required',
        ]);
    }
}
