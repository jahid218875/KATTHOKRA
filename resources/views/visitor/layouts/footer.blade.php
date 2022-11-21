<!-- footer  -->

{{-- <footer class="footer">

    <section class="p-5">
        <div class="row my-5">
            <div class="col-md-12 py-5">
                <img src="{{asset('assets/images/logo.png')}}" style="width: 150px" alt="logo">
            </div>
            <div class="col-md-6">
                <a href="#">পরামর্শ ও সহযোগিতা</a>
                <br><a href="">আমাদের সম্পর্কে জানুন</a>
            </div>
            <div class="col-md-6">
                <a href="#">যোগাযোগ</a>
                <br><a href="mailto:community@katthokra.com">community@katthokra.com</a>
            </div>
        </div>

        <div class="share">
            <a href="#" class="fab fa-facebook-f shadow"></a>
            <a href="#" class="fab fa-twitter shadow"></a>
            <a href="#" class="fab fa-linkedin shadow"></a>
            <a href="#" class="fab fa-instagram shadow"></a>
            <a href="#" class="fab fa-youtube shadow"></a>
        </div>

        <div class="credit">স্বত্ব &copy; 2022 কাঠঠোকরা কর্তৃক সর্বস্বত্ব সংরক্ষিত</div>

    </section>

</footer> --}}

<!-- Remove the container if you want to extend the Footer to full width. -->

<!-- Footer -->
<footer class="container-fluid text-center text-lg-start text-dark p-0" style="background-color: #ECEFF1">
    <!-- Section: Social media -->
    <div class="d-flex justify-content-between p-4 text-white bg-success">
        <!-- Left -->
        <div class="me-5">
            <span>সামাজিক নেটওয়ার্কগুলিতে আমাদের সাথে সংযুক্ত হন:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="text-white me-4">
                <i class="fab fa-github"></i>
            </a>
        </div>
        <!-- Right -->
    </div>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->

                    <br><img src="{{asset('assets/images/logo.png')}}" style="width: 150px" alt="logo">
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                {{-- <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold">বিষয়</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #7c4dff; height: 2px" />
                    <p>
                        <a href="#!" class="text-dark">বিজ্ঞান</a>
                    </p>
                    <p>
                        <a href="#!" class="text-dark">বিজ্ঞান</a>
                    </p>
                    <p>
                        <a href="#!" class="text-dark">বিজ্ঞান</a>
                    </p>
                    <p>
                        <a href="#!" class="text-dark">বিজ্ঞান</a>
                    </p>
                </div> --}}
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold">প্রয়োজনীয় পেইজ </h6>
                    <hr class="mb-4 mt-0 d-block mx-auto"
                        style="width: 130px; background-color: #7c4dff; height: 2px" />
                    <p>
                        <a href="{{route('contact')}}" class="text-dark">পরামর্শ ও সহযোগিতা</a>
                    </p>
                    <p>
                        <a href="{{route('about')}}" class="text-dark">আমাদের সম্পর্কে জানুন</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold">যোগাযোগ</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 80px; background-color: #7c4dff; height: 2px" />
                    {{-- <p><i class="fas fa-home mr-3"></i> বাংলাদেশ প্রকৌশল বিশ্ববিদ্যালয়</p> --}}
                    <p><i class="fas fa-envelope mr-3"></i> <a href="mailto:community@katthokra.com"
                            class="text-dark text-lowercase">community@katthokra.com</a></p>
                    {{-- <p><i class="fas fa-phone mr-3"></i> + 880 1234 56788</p>
                    <p><i class="fas fa-print mr-3"></i> + 880 1234 56788</p> --}}
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        স্বত্ব &copy; 2022 <a href="{{'/'}}" class="fw-bold text-success">কাঠঠোকরা</a> কর্তৃক সর্বস্বত্ব সংরক্ষিত:
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
<!-- End of .container -->

<!-- footer section ends -->






<!-- owl carousel JS  -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}" defer></script>


<!-- bootstrap cdn link  -->

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" defer></script>


<!-- Main js  -->
<script src="{{asset('assets/js/main.js')}}" defer></script>

<script>
    document.querySelector('meta[name="theme-color"]').setAttribute('content',  '#157347');

</script>


@yield('scripts')

</body>

</html>