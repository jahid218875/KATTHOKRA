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
                    'Oops...!',
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

                @if($subscription->type == 'HSC')
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">HSC & Admission Subscription</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post"
                                    action="{{ route('admin.subscription_update', $subscription->id)}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>Type Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="type" required>
                                                    <option value="HSC">HSC and Admission</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Group Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="subs_item" required>

                                                    <option>{{$subscription->subs_item}}</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="subscription_fee">Subscription Fee</label>
                                                <input type="text" id="subscription_fee" class="form-control"
                                                    placeholder="1250" name="subscription_fee" required
                                                    value="{{$subscription->subscription_fee}}">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($subscription->type == 'Engineering')
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Engineering Subscription</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post"
                                    action="{{ route('admin.subscription_update', $subscription->id)}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>Type Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="type" required>
                                                    <option value="Engineering">Engineering</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <h6>Subject Select</h6>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect" name="subs_item" required>

                                                    <option>{{$subscription->subs_item}}</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="subscription_fee">Subscription Fee</label>
                                                <input type="text" id="subscription_fee" class="form-control"
                                                    placeholder="1250" name="subscription_fee" required
                                                    value="{{$subscription->subscription_fee}}">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->

        <!-- Basic Tables start -->
        {{-- <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Paper Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paper as $paper_list)
                            <tr>
                                <td>{{$paper_list->getSubject->subject_name}}</td>
                                <td>{{$paper_list->paper_name}}</td>
                                <td>
                                    <a href="{{ route('admin.paper_delete', $paper_list->id)}}"
                                        onclick="return confirm('are you sure?')" class="badge bg-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

        </section> --}}
        <!-- Basic Tables end -->

    </div>
</div>

@endsection