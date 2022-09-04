<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>কাঠঠোকরা- মাতৃভাষায় উচ্চশিক্ষার একমাত্র প্লাটফর্ম</title>

    <!-- bootstrap cdn link  -->

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">


    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    @yield('styles')
</head>

<body>


    <!-- header area start  -->
    <div class="shadow sticky-top bg-white">
        <nav class="navbar navbar-expand-lg container">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-success fs-3" href="{{'/'}}"><img
                        src="{{asset('assets/images/logo.png')}}" style="width: 150px" class="py-2"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-bold fs-5 menu-hover" aria-current="page" href="{{'/'}}">নীড়পাতা</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold fs-5 menu-hover" href="#HSC&ADMISSION">HSC ও ADMISSION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold fs-5 menu-hover" href="#প্রকৌশলবিদ্যা">প্রকৌশলবিদ্যা</a>
                        </li>
                    </ul>
                    {{-- <div class="btn-group" role="group">
                        <div type="button" class=" dropdown-toggle me-3" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            বাংলা / Eng
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">বাংলা</a></li>
                            <li><a class="dropdown-item" href="#">English</a></li>
                        </ul>
                    </div> --}}

                    @if(Auth::check())
                    {{-- {{ 'Your LoggedIn...' }} --}}
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
                            <img src="assets/images/pic-1.png" class="rounded-circle w-25">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 1</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 2</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 3</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 4</a></li>
                        </ul>
                    </div>
                </div>
                @else
                <a href="{{'/login'}}" class="btn btn-success fw-bold rounded-pill px-4 py-2 shadow" type="submit"><i
                        class="fa-solid fa-arrow-right-to-bracket me-2"></i> লগ-ইন </a>
                @endif
            </div>
    </div>
    </nav>
    </div>

    <!-- header area end  -->

    <!-- home search area start  -->

    <div class="container-fluid cards">
        <div class="d-flex justify-content-center">
            <div class="input-field"> <input placeholder="খোঁজ করুন" class="form-control shadow home-search" /> <button
                    class="btn1"><i class="fa fa-search"></i></button> </div>
        </div>
    </div>


    <!-- home search area end  -->