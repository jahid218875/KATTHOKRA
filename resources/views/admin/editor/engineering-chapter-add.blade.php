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
                            <h4 class="card-title">Engineering Chapter Add</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('editor.engineering_chapter_submit')}}"
                                    method="post" enctype="multipart/form-data">
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
                                            <div class="form-group">
                                                <label for="chapter_name">Chapter Name</label>
                                                <input type="text" id="chapter_name" class="form-control"
                                                    placeholder="Chapter 1" name="chapter_name" required>
                                            </div>
                                        </div>
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

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Chapter Name</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapter as $chapter_list)
                            <tr>
                                <td>{{$chapter_list->getSubject->subject_name}}</td>
                                <td>{{$chapter_list->chapter_name}}</td>
                                {{-- <td>
                                    <a href="{{ route('admin.engineering_chapter_delete', $chapter_list->id)}}"
                                        onclick="return confirm('are you sure?')" class="badge bg-danger">Delete</a>
                                </td> --}}
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

        </section>
        <!-- Basic Tables end -->
    </div>
</div>

@endsection