@extends('visitor.layouts.app')

@section('content')

<!-- search section starts  -->

<section class="mb-5 container" id="search">
    <h1 class="text-center my-3 fw-bold text-dark">Search <span class="text-success">Result</span></h1>
    <div class="d-flex justify-content-center">
        <button class="btn btn-outline-success me-2" onclick="HscAndAdmission()">Hsc and Admission</button>
        <button class="btn btn-outline-success" onclick="engineering()">Engineering</button>
    </div>
    <div class="row" id="HscAndAdmission">
        <h3 class="text-center pt-5 mb-3">Hsc and Admission</h3>
        @foreach ($HscAndAdmission as $content)
        <div class="col-md-12 my-3">
            <div class="card shadow border-0">
                <div class="card-header bg-success d-flex justify-content-between px-4">
                    <p class="fw-bold mt-3 text-white">{{$content->getSubject->subject_name}}</p>
                    <p class="fw-bold mt-3 text-white">{{$content->getType->type_name}}</p>
                </div>
                <div class="card-body">
                    <p class="card-text text-black-50">{!! substr(strip_tags($content->editor1), 0, 500) !!}</p>
                    <a href="{{route('reader',['name' => $content->getSubject->group_name, 'subject' => $content->getSubject->subject_name, 'paper' => $content->paper_id, 'chapter' => $content->chapter_id, 'type' => $content->type_id])}}"
                        class="btn btn-outline-success btn-sm">Read More</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="row" id="engineering">
        <h3 class="text-center pt-5 mb-3">প্রকৌশলবিদ্যা</h3>
        @foreach ($EngineeringContent as $content)
        <div class="col-md-12 my-3">
            <div class="card shadow border-0">
                <div class="card-header bg-success d-flex justify-content-between px-4">
                    <p class="fw-bold mt-3 text-white">{{$content->getSubject->subject_name}}</p>
                    <p class="fw-bold mt-3 text-white">{{$content->getType->type_name}}</p>
                </div>
                <div class="card-body">
                    <p class="card-text text-black-50">{!! substr(strip_tags($content->editor1), 0, 500) !!}</p>
                    <a href="{{route('engineering_reader',['name' => $content->getSubject->group_name, 'subject' => $content->getSubject->subject_name, 'chapter' => $content->chapter_id, 'type' => $content->type_id])}}"
                        class="btn btn-outline-success btn-sm">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
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
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('search_form')}}" method="post" enctype="multipart/form-data">
                @csrf
                <span>Select Level</span>
                <select name="level" class="box text-black-50 shadow" maxlength="50" required>
                    <option value="">Select Level</option>
                    <option value="HSC ও ADMISSION">HSC ও ADMISSION</option>
                    <option value="প্রকৌশলবিদ্যা">প্রকৌশলবিদ্যা</option>
                </select>
                <span>প্রশ্নের ছবি</span>
                <input type="file" name="image" class="box text-black-50 shadow">
                <span>প্রশ্ন লিখুন</span>
                <textarea name="my_message" placeholder="প্রশ্ন লিখুন" class="box shadow text-black-50" id="" cols="5"
                    rows="5" required></textarea>
                <input type="submit" value="পাঠিয়ে দিন" class="btn btn-success fw-bold rounded-pill px-4 py-2  shadow"
                    name="send">
            </form>
        </div>

    </div>

</section>

<!-- search section ends -->

@endsection

@section('scripts')

<script>
    function HscAndAdmission(){
        document.getElementById('HscAndAdmission').style.display = "block";
        document.getElementById('engineering').style.display = "none";
    }

    function engineering(){
        document.getElementById('HscAndAdmission').style.display = "none";
        document.getElementById('engineering').style.display = "block";
    }
</script>


@endsection