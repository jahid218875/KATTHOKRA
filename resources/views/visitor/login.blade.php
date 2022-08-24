@extends('visitor.layouts.app')
@section('content')
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 py-5">
                <h5 class="text-center fw-bold py-5">ঘরে বসে পড়াশোনার সহজ সমাধান</h5>
                <form class="mx-auto" style="width: 400px">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label fw-bold">মোবাইল নাম্বার/ইমেইল</label>
                        <input type="email" class="form-control py-3 login-input border-0" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text text-end"><a href="#">Change Number</a></div>
                    </div>
                    <div class="mb-3">
                        <label for="otpText" class="form-label fw-bold">ফোনে পাঠানো OTP নিচে লিখুন
                        </label>
                        <input type="email" class="form-control  py-3 login-input border-0" id="otpText"
                            aria-describedby="otplHelp">
                        <div id="otplHelp" class="form-text">আপনি কোডটি পাননি? <a href="#">আবার পাঠান</a></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label fw-bold">পাসওয়ার্ড</label>
                        <input type="password" class="form-control  py-3 login-input border-0"
                            id="exampleInputPassword1">
                    </div>
                    <button class="btn btn-success fw-bold py-3 mt-3" style="width: 100%;" type="submit"><i
                            class="fa-solid fa-arrow-right-to-bracket me-2"></i> এগিয়ে যান </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection