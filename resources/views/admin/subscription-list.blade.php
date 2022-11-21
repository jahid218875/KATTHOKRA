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
                    <h3>Subscription List</h3>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->

        <section class="section">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>subscription Item</th>
                                <th>subscription Fee</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($subscription as $subscription_list)
                            <tr>
                                <td>{{$subscription_list->type}}</td>
                                <td>{{$subscription_list->subs_item}}</td>
                                <td>{{$subscription_list->subscription_fee}}</td>
                                <td>
                                    <a href="{{ route('admin.subscription_edit', $subscription_list->id)}}"
                                        onclick="return confirm('are you sure?')" class="badge bg-success">Edit</a>
                                    <a href="{{ route('admin.subscription_delete', $subscription_list->id)}}"
                                        onclick="return confirm('are you sure?')"
                                        class="badge bg-danger mt-2 mt-md-0">Delete</a>
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