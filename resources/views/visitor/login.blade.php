@extends('visitor.layouts.app')
@section('content')
<div>
    <div class="container-fluid">
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
                @elseif(session('error'))
                <script>
                    Swal.fire(
                    'Ooops....!',
                    '{{ session('error') }}',
                    'error'
                    )
                </script>
                @endif

                <h5 class="text-center fw-bold py-5">গুছিয়ে পড়াশোনার সহজ সমাধান
                    {{-- success session laravel --}}
                    @if(session('success'))
                    <script>
                        Swal.fire(
                        'Good job!',
                        '{{ session('success') }}',
                        'success'
                        )
                    </script>
                    @endif
                </h5>
                {{-- error session laravel --}}

                <form class="mx-auto login-form" method="post" action="{{route('loginSubmit')}}">
                    @csrf
                    <div class="mb-3 emails">
                        <label for="exampleInputEmail1" class="form-label fw-bold">মোবাইল নাম্বার/ইমেইল</label>
                        <input type="email" name="email" class="form-control py-3 login-input border-0 text-lowercase"
                            id="email" aria-describedby="emailHelp" placeholder="017xxxxxxxx">
                        <a href="{{route('forgot')}}" class="text-end">
                            <p class="mt-2">পাসওয়ার্ড ভুলে গিয়েছেন?</p>
                        </a>
                        {{-- <div id="emailHelp" class="form-text text-end"><a href="#">Change Number</a></div> --}}
                    </div>
                    <div class="otp"></div>
                    <div class="password"></div>
                    <div class="more"></div>

                    <button class="btn btn-success fw-bold py-3 mt-3 login" type="submit" style="width: 100%;"><i
                            class="fa-solid fa-arrow-right-to-bracket me-2"></i> এগিয়ে যান </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection




@section('scripts')

<script>
    $('.login').click(function (e) {
	e.preventDefault();

    console.log($('#email').val())
    console.log($('#otpText').val())
    console.log($('#password').val())


    if(
        $('#email').val() !== undefined && 
        $('#password').val() !== undefined
    ){
        if($('#password').val() == ''){
            alert('must input password');
            return;
        }
        $(this).attr('disabled', true);
        $('form').submit();   
    }


    if(
        $('#email').val() !== undefined && 
        $('#otpText').val() !== undefined && 
        $('#password').val() !== undefined
    ){
        //ajax
        $('form').submit();   
    }else if(
        $('#email').val() !== '' && 
        $('#otpText').val() !== undefined && 
        $('#password').val() === undefined
    ){
        //ajax
        $.ajax({
            url: "{{ route('loginSubmit') }}",
            type: 'POST',
            data: {
                '_token': $('input[name=_token]').val(),
                'email': $('#email').val(),
                'otp': $('#otpText').val(),
            },
            success: function (data) {
                if (data.status == 'set passsword') {
                    $('.password').html(`<div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label fw-bold">পাসওয়ার্ড</label>
                        <input type="password" name="password" class="form-control py-3 login-input border-0"
                            id="password" required>
                            <input class="mt-2" type="checkbox" onclick="myFunction()"> Show Password
                    </div>`);
                } else {
                    Swal.fire(
                    'Ooops....!',
                    'Invalid Otp Code',
                    'error'
                    )
                }
            }
        })        

    }else if($('#email').val() !== ''){
        //ajax
        $.ajax({
            url: "{{ route('loginSubmit') }}",
            type: 'POST',
            data: {
                '_token': $('input[name=_token]').val(),
                'email': $('#email').val(),
            },
            success: function (data) {
                if (data.status == 'otp') {
                    $('.otp').html(`<div class="mb-3">
                        <label for="otpText" class="form-label fw-bold">ফোনে পাঠানো OTP নিচে লিখুন
                        </label>
                        <input type="number" name="otp" class="form-control  py-3 login-input border-0" id="otpText"
                            aria-describedby="otplHelp" required>
                        <div id="otplHelp" class="form-text">Inbox এ কোন মেইল পাননি? দয়া করে Spam এ খোঁজ করুন।</div>
                    </div>`);
                }else{
                    $('.password').html(`<div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label fw-bold">পাসওয়ার্ড</label>
                        <input type="password" name="password" class="form-control py-3 login-input border-0"
                            id="password" required>
                            <input class="mt-2" type="checkbox" onclick="myFunction()"> Show Password
                    </div>`);
                }
            }
        })
    }
})


    function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>

@endsection