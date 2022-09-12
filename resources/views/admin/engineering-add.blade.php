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
                            <h4 class="card-title">Engineering Subject Add</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('admin.subject_process')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>Group Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="group_name" required>
                                                    <option value="">Select....</option>
                                                    <option>Science</option>
                                                    <option>Humanities</option>
                                                    <option>Business Studies</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="subject_name">Subject Name</label>
                                                <input type="text" id="subject_name" class="form-control"
                                                    placeholder="Subject Name" name="subject_name" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="subject_image">Image Upload</label>
                                                <p>Image Size 5000 * 7000 or 500 * 700</p>
                                                <input type="file" id="subject_image" class="form-control"
                                                    name="subject_image" required>
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
                                <th>Group Name</th>
                                <th>Subject Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subject as $sub_list)
                            <tr>
                                <td>{{$sub_list->group_name}}</td>
                                <td>{{$sub_list->subject_name}}</td>
                                <td>
                                    <a href="{{ route('admin.subject_edit', $sub_list->id)}}"
                                        onclick="return confirm('are you sure?')" class="badge bg-success">Edit</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.subject_delete', $sub_list->id)}}"
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