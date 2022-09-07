@extends('visitor.layouts.app')

@section('content')
<!-- about section starts  -->
<section class="about py-4">
    <div class="container">
        <div class="row">

            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="assets/images/about-img.svg" loading="lazy" class="w-100 img-fluid">
            </div>

            <div class="col-md-6 my-auto">
                <h3 class="fs-2 text-center fw-bold">আমাদের <span class="text-success">গল্প</span></h3><br>
                <p class="fs-6 text-black-50 text-center">"যে জাতির জ্ঞানের ভাণ্ডার শূণ্য সে জাতি ধনের ভাঁড়েও ভবানী"-
                    প্রমথ চৌধুরির এ কথা আমরা সকলে পড়লেও অধিকাংশই উপলব্ধি করিনা, কারণ ঐ যে - নম্বরটাই মুখ্য জ্ঞান নয়।
                    উচ্চমাধ্যমিক পর্যন্ত ভাল ইউনিভার্সিটিতে ভর্তি হবার মোহে শিক্ষার্থীরা কিছুটা বিদ্যার্জন করলেও
                    উচ্চশিক্ষা (University Level) পর্যায়ে আমাদের শিক্ষার্থীদের সিংহভাগই কেবল ভাল গ্রেড পেতে আগ্রহী।
                    এর অন্যতম কারণ বিদেশি ভাষায় উচ্চশিক্ষা! একে তো অল্প সময়, উপরন্তু বিদেশি ভাষা; বুঝে পড়তে গেলে ভাল
                    গ্রেড আসবে না সমীকরণটা খুব সরল!
                    ইন্টারনেটের যুগে কোন বিষয় বুঝতে না পারলে "গুগল করা" ই যে প্রথম পদক্ষেপ এ কথা সকলের জানা। কিন্তু সেই
                    সার্চের ফলাফল যে মাতৃভাষায় আসে না এ কথাও স্বচ্ছ কাচের মত পরিষ্কার!
                    উচ্চশিক্ষা ক্ষেত্রে মাতৃভাষায় পর্যাপ্ত কনটেন্ট (Reading Material এবং Video Content) সরবরাহ করা এবং
                    সার্চের ফলাফল মাতৃভাষায় নিয়ে আসার নিমিত্তেই আমাদের জন্ম! এটাই আমাদের একমাত্র লক্ষ্য এবং উদ্দেশ্য!
                </p>
            </div>

        </div>
    </div>
</section>

<!-- about section ends -->


<!-- HSC & ADMISSION section starts  -->

<section class="mb-5 container" id="HSC&ADMISSION">
    <h1 class="text-center my-5 fw-bold">HSC ও <span class="text-success">ADMISSION</span></h1>
    <div class="row">
        <div class="col">
            <a href="{{route('group', 'science')}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/science.png" loading="lazy" class="card-img-top" alt="...">
                    {{-- <div class="card-body">
                        <h5 class="card-title text-center text-dark">science</h5>
                    </div> --}}
                </div>
            </a>
        </div>
        {{-- <div class="col">
            <a href="{{route('group', 'humanities')}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/course-5.svg" loading="lazy" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">মানবিক</h5>
                    </div>
                </div>
            </a>
        </div> --}}
        {{-- <div class="col">
            <a href="{{route('group', 'commerce')}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/homg-img.svg" loading="lazy" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">ব্যবসায় শিক্ষা</h5>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>
</section>

<!-- HSC & ADMISSION section ends -->

<!-- প্রকৌশলবিদ্যা section starts  -->

<section class="mb-5 container" id="প্রকৌশলবিদ্যা">
    <h1 class="text-center my-5 fw-bold">প্রকৌশলবিদ্যা</h1>
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="#">
                    <img src="assets/images/laplace.png" loading="lazy" class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="#">
                    <img src="assets/images/laplace.png" loading="lazy" class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="#">
                    <img src="assets/images/laplace.png" loading="lazy" class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="#">
                    <img src="assets/images/laplace.png" loading="lazy" class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        <div class="col-12 pt-5 d-flex justify-content-center"><a href="{{'/engineering'}}"
                class="btn btn-success fw-bold rounded-pill px-4 py-2" type="submit"><i
                    class="fa-solid fa-list me-2"></i> সকল বিষয় </a></div>
    </div>
</section>

<!-- প্রকৌশলবিদ্যা section ends -->


<!-- teachers section starts  -->

<section class="teachers container-fluid pb-5 px-0 m-0">

    <h1 class="text-center py-5 fw-bold">যাদের আন্তরিক প্রচেষ্টায়<span class="text-success"> আমাদের পথচলা</span>
    </h1>

    <div class="row owl-carousel owl-theme two p-0 m-0">

        @foreach ($teachers as $teacher)

        <div class="col item slide">
            <img src="{{asset('uploads/' . $teacher->image)}}" loading="lazy" alt="">
            <div class="share">
                <a href="{{$teacher->facebook}}" class="fab fa-facebook-f"></a>
                <a href="{{$teacher->twitter}}" class="fab fa-twitter"></a>
                <a href="mailto:{{$teacher->email}}" class="fa-solid fa-envelope"></a>
                <a href="{{$teacher->linkedin}}" class="fab fa-linkedin"></a>
            </div>
            <h3>{{$teacher->name}}</h3>
        </div>

        @endforeach

    </div>

</section>

<!-- teachers section ends -->


<!-- reviews section starts  -->

<section class="reviews pb-5 px-0 m-0">

    <h1 class="text-center fw-bold mt-5">ব্যবহারকারীদের <span class="text-success">মতামত ও পরামর্শ</span></h1>

    <div class="row owl-carousel owl-theme three reviews-slider p-0 m-0">

        @foreach($reviews as $review)
        <div class="col item slide shadow mt-5">
            <p>{{$review->review}}</p>
            <div class="user">
                <img src="{{asset('uploads/' . $review->image)}}" loading="lazy" alt="">
                <div class="user-info">
                    <h3>{{$review->name}}</h3>
                    <p class="subject">{{$review->university_name}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>

<!-- reviews section ends -->

@endsection