@extends('visitor.layouts.app')

@section('content')

<!-- main content  -->
<section class="px-2">
    <div class="container py-4 reader mt-3 card border-0 shadow">
        <form class="row">
            @csrf
            <div class="col-6 col-md-6">
                <select id="chapter" class="form-select border-0 my-1" name="chapter">
                    <option value="">Select chapter</option>
                    @foreach($chapters as $chapter)
                    { @foreach($chapter->get_chapter as $gchapter)
                    <option value="{{$gchapter->id}}">{{$gchapter->chapter_name}}</option>
                    @endforeach}
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-6">
                <select id="type" class="form-select border-0 my-1" name="type">

                </select>
            </div>
        </form>
    </div>
</section>

<section class="px-2">
    <div class="container my-5 card p-5 border-0 shadow">
        <div class="row">
            <div class="col-md-12" id="content">

            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item paginate active"><a class="page-link" href="#">1</a></li>


                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</section>

@endsection


@section('scripts')

<script>
    $("#chapter").change(function(e){
  
  e.preventDefault();
  $('#content').html( '<p>Select Chapter & Type</p>');

 var chapter = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('engineering_chapter_to_type') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        chapter_id: chapter
    },

        success:function(data){

            var type = [];
            data.map(function(types){
            type.push(`<option value="${types.id}">${types.type_name}</option>`)

        })
        $('#type').html( '<option value="">Select Type</option>' + type) ;
        
         
     }
  });

});

$("#type").change(function(e){
  
  e.preventDefault();
 var chapter = $('#chapter').val();
 var type = $('#type').val();

 if(chapter && type){
    $.ajax({
     type:'POST',
     url:"{{ route('engineering_type_to_content') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        chapter_id: chapter,
        type_id: type
    },
    success:function(data){
        // console.log(data.status);
        if (data.status == 'active'){
            var content = `<article class="blog-post">${data.editor1}</article>`;
        $('#content').html(content) ;
        
      
        if(data.editor5){
            $('.paginate').after('<li class="page-item"><a class="page-link" href="#">5</a></li>');
        }

        
        if(data.editor4){
            $('.paginate').after('<li class="page-item"><a class="page-link" href="#">4</a></li>');
        }
        
        if(data.editor3){
            $('.paginate').after('<li class="page-item"><a class="page-link" href="#">3</a></li>');
        }

        if(data.editor2){
            $('.paginate').after('<li class="page-item"><a class="page-link" href="#">2</a></li>');
        }
        getData(data);
        }else{
            var content = `<article class="blog-post">Empty Content</article>`;
        $('#content').html(content) ;
        }
        
    }
});

}
});

var data;
function getData(response){
    data = response
}

$('.pagination').on('click', '.page-link', function(){
    var page = $(this).text();

    if(page == 1){
        var content = `<article class="blog-post">${data.editor1}</article>`;
        $('#content').html(content) ;
    }


    if(page == 2){
        $('#content').html(`<article class="blog-post">${data.editor2}</article>`);
    }else if(page == 3){
        $('#content').html(`<article class="blog-post">${data.editor3}</article>`);
    }else if(page == 4){
        $('#content').html(`<article class="blog-post">${data.editor4}</article>`);
    }else if(page == 5){
        $('#content').html(`<article class="blog-post">${data.editor5}</article>`);
    }


    $('.page-item').removeClass('active');
    $(this).parent().addClass('active');
   
})


</script>


@endsection