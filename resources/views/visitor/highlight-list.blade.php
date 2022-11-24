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
                    <h3 class="text-center mt-5">Highlight List</h3><br><br>
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

                            @foreach($highlight as $highlight_list)
                            <tr>
                                <td>{{$highlight_list->getSubject->subject_name}}</td>
                                <td>{{$highlight_list->getPaper->paper_name}}</td>
                                <td>{{$highlight_list->getChapter->chapter_name}}</td>
                                <td>{{$highlight_list->getType->type_name}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop{{$highlight_list->id}}">
                                        View
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{$highlight_list->id}}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="{{$highlight_list->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="{{$highlight_list->id}}">
                                                        {{$highlight_list->getSubject->subject_name}}
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{html_entity_decode($highlight_list->content)}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('highlight_delete', $highlight_list->id)}}"
                                        onclick="return confirm('are you sure?')"
                                        class="btn btn-danger mt-2 mt-md-0">Delete</a>
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

                            @foreach($EngineeringHighlight as $eng_highlight_list)
                            <tr>
                                <td>{{$eng_highlight_list->getSubject->subject_name}}</td>
                                <td>{{$eng_highlight_list->getChapter->chapter_name}}</td>
                                <td>{{$eng_highlight_list->getType->type_name}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop{{$eng_highlight_list->id}}">
                                        View
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{$eng_highlight_list->id}}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="{{$eng_highlight_list->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="{{$eng_highlight_list->id}}">
                                                        {{$eng_highlight_list->getSubject->subject_name}}
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{html_entity_decode($eng_highlight_list->content)}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('eng_highlight_delete', $eng_highlight_list->id)}}"
                                        onclick="return confirm('are you sure?')"
                                        class="btn btn-danger mt-2 mt-md-0">Delete</a>
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