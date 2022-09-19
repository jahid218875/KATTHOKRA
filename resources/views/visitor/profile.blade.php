@extends('visitor.layouts.app')

@section('content')

<!-- profile section starts  -->

<section class="mb-5 container" id="profile">
    <h1 class="text-center my-5 fw-bold">Profile</h1>
    <div class="row">
        <div class="col-md-12 py-5">

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


            <form action="{{ route('profile_update') }}" method="POST" class="mx-auto login-form"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label fw-bold">Your Name</label>
                    <input type="text" name="name" value="{{$user->name}}"
                        class="form-control form-control-lg login-input border-0" id="exampleInputEmail1"
                        aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="otpText" class="form-label fw-bold">Level</label>
                    <select id="inputState" name="level"
                        class="form-select border-0 my-1 login-input form-control-lg py-3" required>
                        <option {{$user->level == 'HSC/Admission' ? 'selected' : ''}}>HSC/Admission</option>
                        <option {{$user->level == 'University' ? 'selected' : ''}}>University</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputinstitution1" class="form-label fw-bold">Institution</label>
                    <input type="text" name="institution" class="form-control  form-control-lg login-input border-0"
                        id="exampleInputinstitution1" required value="{{$user->Institution}}">
                </div>


                {{-- <div class="mb-3">
                    <label for="exampleInputinstitution1" class="form-label fw-bold">{{$user->email == 'email' ? 'Email'
                        : 'Phone Number'}}</label>
                    <input type="text" name="email" class="form-control  form-control-lg login-input border-0"
                        id="exampleInputinstitution1" required value="{{$user->email}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputinstitution1" class="form-label fw-bold">{{$user->email_phone == 'email' ?
                        'Email'
                        : 'Phone Number'}}</label>
                    <input type="text" name="email_phone" class="form-control  form-control-lg login-input border-0"
                        id="exampleInputinstitution1" required value="{{$user->email_phone}}">
                </div> --}}

                <div class="mb-3">
                    <label for="exampleInputinstitution1" class="form-label fw-bold">Upload Image</label>
                    <input type="file" name="image" class="form-control form-control-lg login-input border-0 fs-6"
                        id="exampleInputinstitution1">
                </div>
                <button class="btn btn-success fw-bold py-3 mt-3" style="width: 100%;" type="submit"><i
                        class="fa-solid fa-arrow-right-to-bracket me-2"></i>Update</button>
            </form>
        </div>
    </div>
</section>

<!-- profile section ends -->

@endsection