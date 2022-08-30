<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Paper;
use App\Models\Subject;
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
        $paper = Paper::get();

        $type = Type::with('getSubject', 'getPaper', 'getChapter')->get();

        return view('admin.editor.content-add', compact('subject', 'paper', 'type'));
    }
}
