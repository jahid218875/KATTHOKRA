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
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section my-5">
            <div class="card">
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
        <!-- Basic Tables end -->
    </div>
</div>

@endsection

@section('scripts')

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#table1').DataTable();
} );
</script>


@endsection