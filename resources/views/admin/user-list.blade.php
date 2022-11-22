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
                    <h3>User List</h3>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section mt-5">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Level</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($user_list as $user)
                            <tr>
                                <td>{{$user->name}}</td>

                                @if (!is_numeric($user->email))
                                <td>{{$user->email}}</td>
                                @else
                                <td>{{$user->email_phone}}</td>
                                @endif

                                @if (is_numeric($user->email_phone))
                                <td>{{$user->email_phone}}</td>
                                @else
                                <td>{{$user->email}}</td>
                                @endif

                                <td>{{$user->level}}</td>

                                <td>
                                    <a href="{{ route('admin.user_delete', $user->id)}}"
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