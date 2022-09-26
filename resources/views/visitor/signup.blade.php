@extends('visitor.layouts.app')
@section('content')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 py-5">
                <form action="{{ route('signupData') }}" method="POST" class="mx-auto login-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label fw-bold">Your Name</label>
                        <input type="text" name="name" placeholder="Enter Your Name"
                            class="form-control form-control-lg login-input border-0" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                        {{-- <div id="emailHelp" class="form-text text-end"><a href="#">Change Number</a></div> --}}
                    </div>
                    <div class="mb-3">
                        <label for="otpText" class="form-label fw-bold">Level</label>
                        <select id="inputState" name="level"
                            class="form-select border-0 my-1 login-input form-control-lg py-3" required>
                            <option selected class="aaaa">HSC/Admission</option>
                            <option>University</option>
                        </select>
                        {{-- <div id="otplHelp" class="form-text">আপনি কোডটি পাননি? <a href="#">আবার পাঠান</a></div>
                        --}}
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputinstitution1" class="form-label fw-bold">Institution</label>
                        <input type="text" name="institution" class="form-control  form-control-lg login-input border-0"
                            id="exampleInputinstitution1" required>
                    </div>


                    @if(is_int(Auth()->user()->email))
                    <div class="mb-3">
                        <label for="exampleInputinstitution1" class="form-label fw-bold">Phone Number</label>
                        <input type="text" name="email_phone" placeholder="017xxxxxxxx"
                            class="form-control  form-control-lg login-input border-0" id="exampleInputinstitution1"
                            required>
                    </div>

                    @else
                    <div class="mb-3">
                        <label for="exampleInputinstitution1" class="form-label fw-bold">Email</label>
                        <input type="text" name="email_phone" placeholder="abcd@gmail.com"
                            class="form-control  form-control-lg login-input border-0" id="exampleInputinstitution1"
                            required>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="exampleInputinstitution1" class="form-label fw-bold">Upload Image</label>
                        <input type="file" name="image" class="form-control form-control-lg login-input border-0 fs-6"
                            id="exampleInputinstitution1">
                    </div>
                    <button class="btn btn-success fw-bold py-3 mt-3" style="width: 100%;" type="submit"><i
                            class="fa-solid fa-arrow-right-to-bracket me-2"></i> এগিয়ে যান </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection