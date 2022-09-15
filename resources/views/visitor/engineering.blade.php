@extends('visitor.layouts.app')

@section('content')

<!-- প্রকৌশলবিদ্যা section starts  -->

<section class="mb-5 container" id="প্রকৌশলবিদ্যা">
    <h1 class="text-center my-5 fw-bold">প্রকৌশলবিদ্যা</h1>
    <div class="row">
        @foreach($engineering as $engineering_sub)
        <div class="col-6 col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover">
                <a href="{{ route('engineering_reader', $engineering_sub->subject_name)}}">
                    <img src="{{asset('uploads/' . $engineering_sub->subject_image)}}" loading="lazy"
                        class="card-img-top" alt="...">
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- প্রকৌশলবিদ্যা section ends -->

@endsection