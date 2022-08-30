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
}
