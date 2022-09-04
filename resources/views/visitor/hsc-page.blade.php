@extends('visitor.layouts.app')

@section('content')

<!-- HSC & ADMISSION section starts  -->

<section class="mb-5 container" id="HSC&ADMISSION">
    <h1 class="text-center my-5 fw-bold">HSC ও <span class="text-success">ADMISSION</span></h1>
    <div class="row">
        <div class="col">
            <a href="{{route('group', 'science')}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/science.png" class="card-img-top" alt="...">
                    {{-- <div class="card-body">
                        <h5 class="card-title text-center text-dark">science</h5>
                    </div> --}}
                </div>
            </a>
        </div>
        {{-- <div class="col">
            <a href="{{route('group', 'humanities')}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/course-5.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">মানবিক</h5>
                    </div>
                </div>
            </a>
        </div> --}}
        {{-- <div class="col">
            <a href="{{route('group', 'commerce')}}">
                <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                    <img src="assets/images/homg-img.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark">ব্যবসায় শিক্ষা</h5>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>
</section>

<!-- HSC & ADMISSION section ends -->

@endsection