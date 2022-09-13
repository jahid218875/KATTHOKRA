@extends('admin.layouts.app')

@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">

        <!-- // Basic multiple Column Form section start -->

        <section id="multiple-column-form">
            <div class="row match-height">


                @if(session('success'))
                <script>
                    Swal.fire(
                    'Good job!',
                    '{{ session('success') }}',
                    'success'
                    )
                </script>
                @elseif(session('error'))
                <script>
                    Swal.fire(
                    'Ooops....!',
                    '{{ session('error') }}',
                    'error'
                    )
                </script>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Engineering Content Edit</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form"
                                    action="{{ route('editor.engineering_content_update', $content->id)}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>Your Name</h6>
                                            <fieldset class="form-group">
                                                <input type="text" class="form-control" name="editor_name"
                                                    value="{{$editor->name}}" readonly>
                                                <input type="text" class="form-control" name="editor_id"
                                                    value="{{$editor->id}}" hidden>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Subject Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="subject" name="subject_id" required>
                                                    <option value="{{$content->subject_id}}">
                                                        {{$content->getSubject->subject_name}}</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Chapter Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="chapter" name="chapter_id" required>
                                                    <option value="{{$content->chapter_id}}">
                                                        {{$content->getChapter->chapter_name}}</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Type Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="type" name="type_id" required>
                                                    <option value="{{$content->type_id}}">
                                                        {{$content->getType->type_name}}</option>

                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Page 1</h4>
                                                </div>
                                                <div class="card-body">
                                                    <textarea name="editor1" id="editor1" cols="30"
                                                        rows="10">{{$content->editor1}}</textarea>

                                                    {{-- <div id="editor">
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Page 2</h4>
                                                </div>
                                                <div class="card-body">
                                                    <textarea name="editor2" id="editor2" cols="30"
                                                        rows="10">{{$content->editor2}}</textarea>

                                                    {{-- <div id="editor">
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Page 3</h4>
                                                </div>
                                                <div class="card-body">
                                                    <textarea name="editor3" id="editor3" cols="30"
                                                        rows="10">{{$content->editor3}}</textarea>

                                                    {{-- <div id="editor">
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Page 4</h4>
                                                </div>
                                                <div class="card-body">
                                                    <textarea name="editor4" id="editor4" cols="30"
                                                        rows="10">{{$content->editor4}}</textarea>

                                                    {{-- <div id="editor">
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Page 5</h4>
                                                </div>
                                                <div class="card-body">
                                                    <textarea name="editor5" id="editor5" cols="30"
                                                        rows="10">{{$content->editor5}}</textarea>

                                                    {{-- <div id="editor">
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="type_name">Type Name</label>
                                                <input type="text" id="type_name" class="form-control"
                                                    placeholder="Mathmetical Problem" name="type_name" required>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success me-1 mb-1">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->


    </div>
</div>

@endsection

@section('scripts')

<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>


<script>
    // CK Editor 
CKEDITOR.replace( 'editor1', {
    removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor'
});

CKEDITOR.replace( 'editor2', {
    removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor'
} );
CKEDITOR.replace( 'editor3', {
    removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor'
} );
CKEDITOR.replace( 'editor4', {
    removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor'
} );
CKEDITOR.replace( 'editor5', {
    removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor'
} );

</script>
@endsection