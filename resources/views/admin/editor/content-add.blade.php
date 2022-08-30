@extends('admin.layouts.app')

@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    {{-- <h3>Add Subject</h3>
                    <p class="text-subtitle text-muted">Multiple form layouts, you can use</p> --}}
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Layout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>




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
                            <h4 class="card-title">HSC & Admission Content Add</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('admin.type_submit')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>Subject Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="subject" name="subject_id" required>
                                                    <option value="">Select....</option>
                                                    @foreach($subject as $sub_name)
                                                    <option value="{{$sub_name->id}}">{{$sub_name->subject_name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Paper Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="paper" name="paper_id" required>
                                                    <option value="">Select....</option>

                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Chapter Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="chapter" name="chapter_id" required>
                                                    <option value="">Select....</option>

                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Type Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="type" name="type_id" required>
                                                    <option value="">Select....</option>

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
                                                        rows="10"></textarea>

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
                                                        rows="10"></textarea>

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
                                                        rows="10"></textarea>

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
                                                        rows="10"></textarea>

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
                                                        rows="10"></textarea>

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
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
    $("#subject").change(function(e){
  
  e.preventDefault();
  $('#chapter').html( '<option value="">Select....</option>');
  $('#type').html( '<option value="">Select....</option>');

 var subject = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('editor.paper_process') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        subject_id: subject
    },

        success:function(data){

            var paper = [];
            data.map(function(papers){
            paper.push(`<option value="${papers.id}">${papers.paper_name}</option>`)

        })
        $('#paper').html( '<option value="">Select....</option>' + paper) ;
        
         
     }
  });

});

$("#paper").change(function(e){
  
  e.preventDefault();
 var paper = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('editor.chapter_process') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        paper_id: paper
    },

        success:function(data){

            var chapter = [];
            data.map(function(chapters){
            chapter.push(`<option value="${chapters.id}">${chapters.chapter_name}</option>`)

        })
        $('#chapter').html( '<option value="">Select....</option>' + chapter) ;
        
         
     }
  });

});

$("#chapter").change(function(e){
  
  e.preventDefault();
 var chapter = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('editor.type_process') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        chapter_id: chapter
    },

        success:function(data){

            var type = [];
            data.map(function(types){
            type.push(`<option value="${types.id}">${types.type_name}</option>`)

        })
        $('#type').html( '<option value="">Select....</option>' + type) ;
        
         
     }
  });

});

// CK Editor 
CKEDITOR.replace( 'editor1' );
CKEDITOR.replace( 'editor2' );
CKEDITOR.replace( 'editor3' );
CKEDITOR.replace( 'editor4' );
CKEDITOR.replace( 'editor5' );

</script>
@endsection