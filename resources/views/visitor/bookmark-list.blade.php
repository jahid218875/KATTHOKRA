@extends('visitor.layouts.app')

@section('styles')

<!-- Data Table  -->

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

@endsection

@section('content')

<div class="container">

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

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mt-5">Bookmark List</h3>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-outline-success me-2" onclick="HscAndAdmission()">Hsc and
                            Admission</button>
                        <button class="btn btn-outline-success" onclick="engineering()">Engineering</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section my-5">
            <div class="card" id="HscAndAdmission">
                <h3 class="text-center pt-5 mb-3">Hsc and Admission</h3>
                <div class="card-body table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Paper</th>
                                <th>Chapter</th>
                                <th>Type</th>
                                <th>Content</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($bookmark as $bookmark_list)
                            <tr>
                                <td>{{$bookmark_list->getSubject->subject_name}}</td>
                                <td>{{$bookmark_list->getPaper->paper_name}}</td>
                                <td>{{$bookmark_list->getChapter->chapter_name}}</td>
                                <td>{{$bookmark_list->getType->type_name}}</td>
                                <td>
                                    <a href="{{route('reader',['name' => $bookmark_list->group, 'subject' => $bookmark_list->getSubject->subject_name, 'paper' => $bookmark_list->paper, 'chapter' => $bookmark_list->chapter, 'type' => $bookmark_list->type,  'page' => $bookmark_list->page])}}"
                                        class="btn btn-success btn-sm">Open</a>
                                    <a href="{{route('bookmark_delete', $bookmark_list->id)}}"
                                        onclick="return confirm('are you sure?')"
                                        class="btn btn-danger btn-sm mt-2 mt-md-0">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="section my-5">
            <div class="card" id="engineering" style="display: none">
                <h3 class="text-center pt-5 mb-3">প্রকৌশলবিদ্যা</h3>
                <div class="card-body table-responsive">
                    <table class="table" id="table2">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Chapter</th>
                                <th>Type</th>
                                <th>Content</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($eng_bookmark as $eng_bookmark_list)
                            <tr>
                                <td>{{$eng_bookmark_list->getSubject->subject_name}}</td>
                                <td>{{$eng_bookmark_list->getChapter->chapter_name}}</td>
                                <td>{{$eng_bookmark_list->getType->type_name}}</td>
                                <td>
                                    <a href="{{route('engineering_reader',['name' => $eng_bookmark_list->group, 'subject' => $eng_bookmark_list->getSubject->subject_name, 'chapter' => $eng_bookmark_list->chapter, 'type' => $eng_bookmark_list->type,  'page' => $eng_bookmark_list->page])}}"
                                        class="btn btn-success btn-sm">Open</a>
                                    <a href="{{route('eng_bookmark_delete', $eng_bookmark_list->id)}}"
                                        onclick="return confirm('are you sure?')"
                                        class="btn btn-danger btn-sm mt-2 mt-md-0">Delete</a>
                                </td>
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

@section('scripts')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#table1').DataTable();
    $('#table2').DataTable();
} );
</script>

<script>
    function HscAndAdmission(){
        document.getElementById('HscAndAdmission').style.display = "block";
        document.getElementById('engineering').style.display = "none";
    }

    function engineering(){
        document.getElementById('HscAndAdmission').style.display = "none";
        document.getElementById('engineering').style.display = "block";
    }
</script>


@endsection