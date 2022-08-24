@extends('visitor.layouts.app')

@section('content')
<!-- about section starts  -->
<section class="about py-4">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <img src="assets/images/about-img.svg" class="w-75">
            </div>

            <div class="col-md-6 my-auto">
                <h3 class="fs-2 text-center fw-bold">আমাদের <span class="text-success">গল্প</span></h3>
                <p class="fs-6 text-black-50 text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Cumque
                    quibusdam magni
                    error, aut enim
                    rerum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
                    quibusdam magni
                    error, aut enim
                    rerum?Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Cumque
                    quibusdam magni
                    error, aut enim
                    rerum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
                    quibusdam magni
                    error, aut enim
                    rerum?Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Cumque
                    quibusdam magni
                    error, aut enim
                    rerum? Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
                    quibusdam magni
                    error, aut enim
                    rerum?
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
            <a href="{{'/science'}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/course-3.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">বিজ্ঞান</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{'/arts'}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/course-5.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">মানবিক</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{'/commerce'}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/homg-img.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">ব্যবসায় শিক্ষা</h5>
                    </div>
                </div>
            </a>
        </div>
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
                    <img src="assets/images/hsc2023.jpg" class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="#">
                    <img src="assets/images/hsc2023.jpg" class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="#">
                    <img src="assets/images/hsc2023.jpg" class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="#">
                    <img src="assets/images/hsc2023.jpg" class="card-img-top" alt="...">
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

<section class="teachers container-fluid pb-5">

    <h1 class="text-center py-5 fw-bold">যাদের আন্তরিক প্রচেষ্টায়<span class="text-success"> আমাদের পথচলা</span>
    </h1>

    <div class="row owl-carousel owl-theme two">

        <div class="col item slide">
            <img src="assets/images/tutor-1.png" alt="">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="col item slide">
            <img src="assets/images/tutor-2.png" alt="">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="col item slide">
            <img src="assets/images/tutor-3.png" alt="">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="col item slide">
            <img src="assets/images/tutor-4.png" alt="">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="col item slide">
            <img src="assets/images/tutor-5.png" alt="">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="col item slide">
            <img src="assets/images/tutor-6.png" alt="">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>john deo</h3>
        </div>

    </div>

</section>

<!-- teachers section ends -->


<!-- reviews section starts  -->

<section class="reviews pb-5 px-3">

    <h1 class="text-center fw-bold mt-5">জ্ঞান পিপাসুদের<span class="text-success"> অভিমত</span></h1>

    <div class="row owl-carousel owl-theme three reviews-slider">

        <div class="col item slide shadow mt-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum necessitatibus atque fuga delectus
                numquam consequatur velit autem distinctio possimus culpa!</p>
            <div class="user">
                <img src="assets/images/pic-1.png" alt="">
                <div class="user-info">
                    <h3>john deo</h3>
                    <p class="subject">chemistry</p>
                </div>
            </div>
        </div>

        <div class="col item slide shadow mt-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum necessitatibus atque fuga delectus
                numquam consequatur velit autem distinctio possimus culpa!</p>
            <div class="user">
                <img src="assets/images/pic-2.png" alt="">
                <div class="user-info">
                    <h3>john deo</h3>
                    <p class="subject">chemistry</p>
                </div>
            </div>
        </div>

        <div class="col item slide shadow mt-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum necessitatibus atque fuga delectus
                numquam consequatur velit autem distinctio possimus culpa!</p>
            <div class="user">
                <img src="assets/images/pic-3.png" alt="">
                <div class="user-info">
                    <h3>john deo</h3>
                    <p class="subject">chemistry</p>
                </div>
            </div>
        </div>

        <div class="col item slide shadow mt-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum necessitatibus atque fuga delectus
                numquam consequatur velit autem distinctio possimus culpa!</p>
            <div class="user">
                <img src="assets/images/pic-4.png" alt="">
                <div class="user-info">
                    <h3>john deo</h3>
                    <p class="subject">chemistry</p>
                </div>
            </div>
        </div>

        <div class="col item slide shadow mt-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum necessitatibus atque fuga delectus
                numquam consequatur velit autem distinctio possimus culpa!</p>
            <div class="user">
                <img src="assets/images/pic-5.png" alt="">
                <div class="user-info">
                    <h3>john deo</h3>
                    <p class="subject">chemistry</p>
                </div>
            </div>
        </div>

        <div class="col item slide shadow mt-5">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum necessitatibus atque fuga delectus
                numquam consequatur velit autem distinctio possimus culpa!</p>
            <div class="user">
                <img src="assets/images/pic-6.png" alt="">
                <div class="user-info">
                    <h3>john deo</h3>
                    <p class="subject">chemistry</p>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- reviews section ends -->

<!-- contact section starts  -->

<section class="contact px-3 pb-5">

    <h1 class="text-center fw-bold py-5">আপনার<span class="text-success"> গঠনমূলক পরামর্শ</span></h1>

    <div class="row">

        <div class=" col-md-6">
            <img src="assets/images/contact-img.svg">
        </div>

        <div class="col-md-6">
            <form action="" method="post">
                <span>your name</span>
                <input type="text" required placeholder="Enter your full name" maxlength="50" name="name"
                    class="box shadow text-black-50">
                <span>your email</span>
                <input type="email" required placeholder="Enter your valied email" maxlength="50" name="email"
                    class="box text-black-50 shadow">
                <span>Your Message</span>
                <textarea name="message" class="box shadow" id="" cols="5" rows="5"></textarea>
                <span>select gender</span>
                <div class="radio">
                    <input type="radio" name="gender" value="male" id="male" class=" shadow">
                    <label for="male">male</label>
                    <input type="radio" name="gender" value="female" id="female" class=" shadow">
                    <label for="female">female</label>
                </div>
                <input type="submit" value="পাঠিয়ে দিন" class="btn btn-success fw-bold rounded-pill px-4 py-2  shadow"
                    name="send">
            </form>
        </div>

    </div>

</section>

<!-- contact section ends -->

@endsection