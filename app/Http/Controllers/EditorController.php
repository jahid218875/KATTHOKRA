<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Paper;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\HscContent;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function dashboard()
    {
        return view('admin.editor.main');
    }

    public function content_add()
    {
        $subject = Subject::get();

        return view('admin.editor.content-add', compact('subject'));
    }

    public function paper_process(Request $request)
    {
        return Paper::where('subject_id', $request->subject_id)->get();
    }

    public function chapter_process(Request $request)
    {
        return Chapter::where('paper_id', $request->paper_id)->get();
    }

    public function type_process(Request $request)
    {
        return Type::where('chapter_id', $request->chapter_id)->get();
    }

    public function hsc_content_submit(Request $request)
    {

        $hsc_content = $this->validate($request, [
            'subject_id' => 'required',
            'paper_id' => 'required',
            'chapter_id' => 'required',
            'type_id' => 'required',
            'editor1' => 'required',
        ]);

        $hsc_content['editor2'] = $request->editor2;
        $hsc_content['editor3'] = $request->editor3;
        $hsc_content['editor4'] = $request->editor4;
        $hsc_content['editor5'] = $request->editor5;
        $hsc_content['status'] = 'pending';



        HscContent::create($hsc_content);

        $success = "Content Added Successfully";

        return back()->with('success', $success);
    }
}
