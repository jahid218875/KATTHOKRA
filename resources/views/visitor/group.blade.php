@extends('visitor.layouts.app')
@section('content')

<!-- main section  -->

<section class="mb-5 container-fluid">
    @if(request()->path() == 'group/science')
    <h1 class="text-center my-5 fw-bold">বিজ্ঞান</h1>
    <?php $group = 'Science'; ?>
    @elseif(request()->path() == 'group/humanities')
    <h1 class="text-center my-5 fw-bold">মানবিক</h1>
    <?php $group = 'Humanities'; ?>
    @elseif(request()->path() == 'group/commerce')
    <h1 class="text-center my-5 fw-bold">ব্যবসায় শিক্ষা</h1>
    <?php $group = 'Commerce'; ?>

    @endif
    <div class="row">
        @foreach($subject as $subject_list)
        <div class="col-md-3">
            <div class="card shadow my-3 border-0 mx-auto card-hover" style="width: 18rem;">
                <a href="{{ route('reader', ['name' => $group, 'subject' => $subject_list->subject_name])}}">
                    <img src="{{asset('uploads/' . $subject_list->subject_image)}}" class="card-img-top img-fluid"
                        alt="...">
                </a>
                {{-- <div class="card-body">
                    <h5 class="card-title text-center">ফিজিক্স</h5>
                </div> --}}
            </div>
        </div>
        @endforeach
    </div>
    </div>
</section>
@endsection