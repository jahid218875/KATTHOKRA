<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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

    public function dashboard()
    {
        return view('admin.main');
    }

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

    public function paper_add()
    {
        $subject = Subject::get();
        // dd($subject);
        return view('admin.paper-add', compact('subject'));
    }
}
