<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#FF0000">
    <title>কাঠঠোকরা- মাতৃভাষায় উচ্চশিক্ষার একমাত্র প্লাটফর্ম</title>

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">

    <!-- bootstrap cdn link  -->

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">


    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- custom css file link -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    @yield('styles')
</head>

<body>


    <!-- header area start  -->
    <div class="shadow sticky-top bg-white">
        <nav class="navbar navbar-expand-lg container">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-success" href="{{'/'}}"><img
                        src="{{asset('assets/images/logo.png')}}" style="width: 120px" class="py-1"></a>
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
                            <a class="nav-link fw-bold fs-5 menu-hover"
                                href="{{ request()->routeIs('home') ? '#HSC&ADMISSION' : route('hsc_admission')}}">HSC ও
                                ADMISSION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold fs-5 menu-hover"
                                href="{{ request()->routeIs('home') ? '#প্রকৌশলবিদ্যা' : route('engineering')}}">প্রকৌশলবিদ্যা</a>
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
                    {{-- {{$user = Auth::user('image');}} --}}
                    <li class="nav-item dropdown list-group">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false"><img src="{{asset('images/' . auth()->user()->image )}}"
                                class="rounded-circle" style="width: 50px; height: 50px;"></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                            {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li> --}}
                        </ul>
                    </li>
                </div>
                @else
                <a href="{{'/login'}}" class="btn btn-success rounded-pill px-3 py-2 shadow me-2" type="submit"><i
                        class="fa-solid fa-user-plus me-2"></i> সাইন আপ </a>
                <a href="{{'/login'}}" class="btn btn-success rounded-pill px-3 py-2 shadow" type="submit"><i
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
            <form class="input-field"> <input placeholder="খোঁজ করুন" class="form-control shadow home-search" /> <button
                    type="submit" class="btn1"><i class="fa fa-search"></i></button> </form>
        </div>
    </div>


    <!-- home search area end  -->