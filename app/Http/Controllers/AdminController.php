<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Paper;
use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.main');
    }


    // Subject Added 
    public function subject_add()
    {
        $subject = DB::table('subjects')->OrderBy('id', 'desc')->get();
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

    public function subject_delete($id)
    {
        DB::table('subjects')->where('id', $id)->delete();
        return back()->with('success', 'Subject Deleted!');
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


    // Type Added 

    public function type_add()
    {
        $subject = Subject::get();
        $paper = Paper::get();
        return view('admin.type-add', compact('subject', 'paper'));
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
}
