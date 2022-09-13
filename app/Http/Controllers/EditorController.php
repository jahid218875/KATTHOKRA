<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Paper;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\HscContent;
use Illuminate\Http\Request;
use App\Models\EngineeringType;
use App\Models\EngineeringChapter;
use App\Models\EngineeringContent;
use App\Models\EngineeringSubject;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function dashboard()
    {
        return view('admin.editor.main');
    }

    public function content_add()
    {
        $subject = Subject::get();
        $editor = Auth::user();
        // dd($editor);

        return view('admin.editor.content-add', compact('subject', 'editor'));
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

        // dd($request->all());
        $hsc_content = $this->validate($request, [
            'editor_id' => 'required',
            'editor_name' => 'required',
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

    public function hsc_content_list()
    {
        $hsc_content = HscContent::with('getSubject', 'getPaper', 'getChapter', 'getType')->get();
        $editor = Auth::user();
        // dd($hsc_content);


        return view('admin.editor.hsc-content-list', compact('hsc_content', 'editor'));
    }

    public function hsc_content_edit($id)
    {

        $content = HscContent::where('id', $id)->with('getSubject', 'getPaper', 'getChapter', 'getType')->first();
        $editor = Auth::user();

        return view('admin.editor.content-edit', compact('content', 'editor'));
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
        ]);

        $hsc_content['editor2'] = $request->editor2;
        $hsc_content['editor3'] = $request->editor3;
        $hsc_content['editor4'] = $request->editor4;
        $hsc_content['editor5'] = $request->editor5;
        $hsc_content['status'] = 'pending';

        HscContent::where('id', $id)->update($hsc_content);



        return redirect()->route('editor.hsc_content_list')->with('success', 'Content Update Successfully');
    }

    // Engineering content add

    public function engineering_content_add()
    {
        $subject = EngineeringSubject::get();
        $editor = Auth::user();
        // dd($editor);

        return view('admin.editor.engineering-content-add', compact('subject', 'editor'));
    }

    public function engineering_chapter_process(Request $request)
    {
        return EngineeringChapter::where('subject_id', $request->subject_id)->get();
    }

    public function engineering_type_process(Request $request)
    {
        return EngineeringType::where('chapter_id', $request->chapter_id)->get();
    }

    public function engineering_content_submit(Request $request)
    {

        // dd($request->all());
        $hsc_content = $this->validate($request, [
            'editor_id' => 'required',
            'editor_name' => 'required',
            'subject_id' => 'required',
            'chapter_id' => 'required',
            'type_id' => 'required',
            'editor1' => 'required',
        ]);

        $hsc_content['editor2'] = $request->editor2;
        $hsc_content['editor3'] = $request->editor3;
        $hsc_content['editor4'] = $request->editor4;
        $hsc_content['editor5'] = $request->editor5;
        $hsc_content['status'] = 'pending';





        EngineeringContent::create($hsc_content);

        $success = "Content Added Successfully";

        return back()->with('success', $success);
    }

    public function engineering_content_list()
    {
        $engineering_content = EngineeringContent::with('getSubject', 'getChapter', 'getType')->get();
        $editor = Auth::user();
        // dd($engineering_content);


        return view('admin.editor.engineering-content-list', compact('engineering_content', 'editor'));
    }

    public function engineering_content_edit($id)
    {

        $content = EngineeringContent::where('id', $id)->with('getSubject', 'getChapter', 'getType')->first();
        $editor = Auth::user();

        return view('admin.editor.engineering-content-edit', compact('content', 'editor'));
    }

    public function engineering_content_update($id, Request $request)
    {

        $hsc_content = $this->validate($request, [
            'editor_id' => 'required',
            'editor_name' => 'required',
            'subject_id' => 'required',
            'chapter_id' => 'required',
            'type_id' => 'required',
            'editor1' => 'required',
        ]);

        $hsc_content['editor2'] = $request->editor2;
        $hsc_content['editor3'] = $request->editor3;
        $hsc_content['editor4'] = $request->editor4;
        $hsc_content['editor5'] = $request->editor5;
        $hsc_content['status'] = 'pending';

        EngineeringContent::where('id', $id)->update($hsc_content);



        return redirect()->route('editor.engineering_content_list')->with('success', 'Content Update Successfully');
    }
}
