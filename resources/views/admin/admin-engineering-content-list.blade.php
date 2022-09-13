@extends('admin.layouts.app')

@section('content')

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

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
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Hsc and Admission Content List</h3>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Chapter Name</th>
                                <th>Type</th>
                                <th>Editor Name</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($engineering_content as $engineering_content_list)
                            <tr>
                                <td>{{$engineering_content_list->getSubject->subject_name}}</td>
                                <td>{{$engineering_content_list->getChapter->chapter_name}}</td>
                                <td>{{$engineering_content_list->getType->type_name}}</td>
                                <td>{{$engineering_content_list->editor_name}}</td>
                                <td>{{$engineering_content_list->status}}</td>
                                <td>
                                    <a href="{{ route('admin.engineering_content_edit', $engineering_content_list->id)}}"
                                        onclick="return confirm('are you sure?')" class="badge bg-success">Edit</a>
                                    <a href="{{ route('admin.engineering_content_delete', $engineering_content_list->id)}}"
                                        onclick="return confirm('are you sure?')" class="badge bg-danger">Delete</a>
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