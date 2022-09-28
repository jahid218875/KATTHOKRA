@extends('visitor.layouts.app')

@section('content')

<!-- search section starts  -->

<section class="mb-5 container" id="search">
    <h1 class="text-center my-3 fw-bold text-dark">Search <span class="text-success">Result</span></h1>
    <div class="row">

        @foreach ($data as $content)
        <div class="col-md-12 my-3">
            <div class="card shadow border-0">
                <div class="card-header bg-success d-flex justify-content-between px-4">
                    <p class="fw-bold mt-3 text-white">{{$content->getSubject->subject_name}}</p>
                    <p class="fw-bold mt-3 text-white">{{$content->getType->type_name}}</p>
                </div>
                <div class="card-body">
                    <p class="card-text text-black-50">{!! substr(strip_tags($content->editor1), 0, 500) !!}</p>
                    <a href="#" class="btn btn-outline-success btn-sm">Read More</a>
                </div>
            </div>
        </div>
        @endforeach

        {{-- <div class="col-md-12 my-3">
            <div class="card shadow border-0">
                <div class="card-header bg-success d-flex justify-content-between px-4">
                    <p class="fw-bold mt-3 text-white">Subject Name</p>
                    <p class="fw-bold mt-3 text-white">Type Name</p>
                </div>
                <div class="card-body">
                    <p class="card-text text-black-50">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolore
                        commodi fugiat
                        illum facere laborum vitae officia aspernatur quisquam blanditiis culpa atque assumenda,
                        similique adipisci omnis illo necessitatibus suscipit itaque nobis. Lorem ipsum, dolor sit amet
                        consectetur adipisicing elit. Dolore commodi fugiat
                        illum facere laborum vitae officia aspernatur quisquam blanditiis culpa atque assumenda,
                        similique adipisci omnis illo necessitatibus suscipit itaque nobis</p>
                    <a href="#" class="btn btn-outline-success btn-sm">Read More</a>
                </div>
            </div>
        </div> --}}
    </div>
</section>

<!-- contact section starts  -->

<section class="contact px-3 pb-5">

    <h1 class="text-center fw-bold pt-5 pb-3 ">প্রশ্ন <span class="text-success"> করুন</span></h1>

    <div class="row">
        <div class="col-md-12 px-5">
            <p class="text-center">যা খুঁজছেন তা পাচ্ছেন না? প্রশ্ন করুন।</p>
        </div>

        <div class="col-md-6 mt-5 mx-auto">
            <form action="" method="post">
                <span>Select Level</span>
                <select name="" id="" class="box text-black-50 shadow" maxlength="50">
                    <option>Select Level</option>
                    <option value="">HSC ও ADMISSION</option>
                    <option value="">প্রকৌশলবিদ্যা</option>
                </select>
                <span>প্রশ্নের ছবি</span>
                <input type="file" required placeholder="Enter your email" maxlength="50" name="email"
                    class="box text-black-50 shadow">
                <span>প্রশ্ন লিখুন</span>
                <textarea name="message" placeholder="প্রশ্ন লিখুন" class="box shadow text-black-50" id="" cols="5"
                    rows="5"></textarea>
                <input type="submit" value="পাঠিয়ে দিন" class="btn btn-success fw-bold rounded-pill px-4 py-2  shadow"
                    name="send">
            </form>
        </div>

    </div>

</section>

<!-- search section ends -->

@endsection