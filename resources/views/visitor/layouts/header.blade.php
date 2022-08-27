<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KATTHOKRA</title>

    <!-- bootstrap cdn link  -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">


    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    @yield('styles')
</head>

<body>


    <!-- header area start  -->
    <div class="shadow sticky-top bg-white">
        <nav class="navbar navbar-expand-lg container py-4">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-success fs-3" href="{{'/'}}">KATTHOKRA</a>
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
                    <a href="{{'/login'}}" class="btn btn-success fw-bold rounded-pill px-4 py-2 shadow"
                        type="submit"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i> লগ-ইন </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- header area end  -->

    <!-- home search area start  -->

    {{-- <section class="home">
        <div class="container">
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-10 col-md-6">
                    <div class="form">
                        <i class="fa fa-search fa-bold"></i>
                        <input type="search" class="form-control form-input p-3 rounded-pill shadow"
                            placeholder="Search anything...">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="home">
        <img src="assets/images/search-bg.PNG" class="img-fluid">
        <div class="form">
            <i class="fa fa-search fa-bold"></i>
            <input type="search" class="form-control form-input p-3 rounded-pill shadow"
                placeholder="Search anything...">
        </div>
    </section>


    <!-- home search area end  -->