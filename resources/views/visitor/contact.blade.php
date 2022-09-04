@extends('visitor.layouts.app')

@section('content')

<!-- contact section starts  -->

<section class="contact px-3 pb-5">

    <h1 class="text-center fw-bold py-5">আপনার<span class="text-success"> গঠনমূলক পরামর্শ</span></h1>

    <div class="row">
        <h4 class="text-center fw-bold">পরামর্শ ও সহযোগিতা</h4>
        <hr style="width: 180px; margin:auto; color: #157347; padding-bottom: 20px;">
        <div class="col-md-12 px-5">
            <p class="text-center">আপনার কি কোন বিষয়ে সহযোগিতা প্রয়োজন ? অথবা আমাদের জন্য আপনার কোন পরামর্শ ? আমাদের
                সেবা বিষয়ক যেকোন
                জিজ্ঞাসা, মন্তব্য অথবা পরামর্শ থাকলে নিঃসংকোচে জানাতে পারেন। আপনাদের প্রতিক্রিয়াই আমাদের অনুপ্রেরণা।
            </p>
        </div>

        <div class=" col-md-6">
            <img src="assets/images/contact-img.svg">
        </div>

        <div class="col-md-6 mt-5">
            <form action="" method="post">
                <span>আপনার নাম</span>
                <input type="text" required placeholder="পুরো নাম" maxlength="50" name="name"
                    class="box shadow text-black-50">
                <span>আপনার email</span>
                <input type="email" required placeholder="Enter your email" maxlength="50" name="email"
                    class="box text-black-50 shadow">
                <span>আপনার বার্তা</span>
                <textarea name="message" class="box shadow" id="" cols="5" rows="5"></textarea>
                <input type="submit" value="পাঠিয়ে দিন" class="btn btn-success fw-bold rounded-pill px-4 py-2  shadow"
                    name="send">
            </form>
        </div>

    </div>

</section>

<!-- contact section ends -->

@endsection