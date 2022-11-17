@extends('visitor.layouts.app')

@section('styles')
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

@endsection

@section('content')

<!-- main content  -->
<section class="px-2">

    <h1 class="text-center py-4">{{$papers[0]->subject_name}}</h1>
    <input type="hidden" id="subject_id" name="subject_id" value="{{$papers[0]->id}}">
    <input type="hidden" id="group_name" name="group_name" value="{{$papers[0]->group_name}}">
    <div class="container py-4 reader mt-3 card border-0 shadow">
        <form class="row">
            @csrf
            <div class="col-md-4">
                <select id="paper" class="form-select border-0 my-1 decorated" name="paper">
                    <option value="">Select Paper</option>
                    @foreach($papers as $paper)
                    { @foreach($paper->get_paper as $gpaper)
                    <option value="{{$gpaper->id}}">{{$gpaper->paper_name}}</option>
                    @endforeach}
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select id="chapter" class="form-select border-0 my-1" name="chapter">

                </select>
            </div>
            <div class="col-md-4">
                <select id="type" class="form-select border-0 my-1" name="type">
                </select>
            </div>
            <input type="hidden" id="user_id" name="user_id" value="{{Auth()->user()->id}}">
            <div class="col-md-4">
                <button class="btn btn-success" id="changeColor">Highlight</button>

            </div>
            <div class="col-md-4">
                <button class="btn btn-success" id="bookmark">Bookmark</button>

            </div>
        </form>
    </div>
</section>

<section class="px-2">
    <div class="container my-5 card p-5 border-0 shadow">
        <div class="row">
            <div class="col-md-12" id="content">
                <div class="d-flex justify-content-center align-items-center py-3">
                    <div class="spinner-border m-5 text-success ajax-loading" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
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
    $('#changeColor').click(function(e){

    var selection = getSelectedText(); 
    selection = selection.anchorNode.parentElement.innerHTML;

    var replacement = $('<span></span>').attr({'class':'robi-colored'}).html(selection);

    var replacementHtml = $('<div>').append(replacement.clone()).remove().html();
    $('#content').html( $('#content').html().replace(selection, replacementHtml) );


    e.preventDefault();

    var subject = $('#subject_id').val();
    var paper = $('#paper').val();
    var chapter = $('#chapter').val();
    var type = $('#type').val();
    var content = selection;
    var page = $('.active').text();

    $.ajax({
        type: "POST",
        url: "{{ route('highlight') }}",
        data: {
            '_token': $('input[name=_token]').val(),
            'subject': subject,
            'paper': paper,
            'chapter': chapter,
            'type': type,
            'content': content,
            'page': page
        },
        
        success: function(data) {
        }
        
    });

});

function getSelectedText(){ 
    if(window.getSelection){ 
        return window.getSelection(); 
    } else if(document.getSelection){ 
        return document.getSelection(); 
    }
}

$('#bookmark').click(function(e){

e.preventDefault();

var group = $('#group_name').val();
var subject = $('#subject_id').val();
var paper = $('#paper').val();
var chapter = $('#chapter').val();
var type = $('#type').val();
var page = $('.active').text();


$.ajax({
    type: "POST",
    url: "{{ route('bookmark') }}",
    data: {
        '_token': $('input[name=_token]').val(),
        'group': group,
        'subject': subject,
        'paper': paper,
        'chapter': chapter,
        'type': type,
        'page': page
    },
    
    success: function(data) {
        if(data == 'success'){

            swal("Good job!", "Save Now to Read Later", "success");  
        }else{
            swal("Oops!", "Already Saved", "error");  

        }
    }  
});
});

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>


<script>
    $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search)
        let paper = searchParams.get('paper')
        let chapter = searchParams.get('chapter')
        let type = searchParams.get('type')


        if(paper || chapter || type){
            setTimeout(() => {
                $('#paper').val(paper).trigger('change');
            }, 500);
            setTimeout(() => {
                $('#chapter').val(chapter).trigger('change');
            }, 1500);
            setTimeout(() => {
                $('#type').val(type).trigger('change');
            }, 2500);
            // console.log(paper);
        }
    })
</script>

<script>
    function highlighted(paper, chapter, type, page){
        $.ajax({
            type: 'POST',
            url: "{{route('highlight_data')}}",
            data:{
                '_token': $('input[name=_token]').val(),
                paper_id: paper,
                chapter_id: chapter,
                type_id: type,
                page_id: page
            },

            success:function(data){

        $.each(data, function (key, val) {
            selection = val.content;

            var replacement = $('<span></span>').attr({'class':'robi-colored'}).html(selection);

            var replacementHtml = $('<div>').append(replacement.clone()).remove().html();
            $('#content').html( $('#content').html().replace(selection, replacementHtml) );


            });

            }
        })

    }
    $('.ajax-loading').hide();


    $("#paper").change(function(e){
  
  e.preventDefault();
  $('#type').html( '<option value="">Select Type</option>');
//   $('#content').html( '<p>Select Paper, Chapter & Type</p>');
  
 var paper = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('paper_to_chapter') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        paper_id: paper
    },
    success:function(data){
        // console.log(data);
            var chapter = [];
            data.map(function(chapters){
            chapter.push(`<option value="${chapters.id}">${chapters.chapter_name}</option>`)

        })
        $('#chapter').html( '<option value="">Select Chapter</option>' + chapter) ;
        
         
     }
  });

});

$("#chapter").change(function(e){
  
  e.preventDefault();
//   $('#content').html( '<p>Select Paper, Chapter & Type</p>');

 var chapter = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('chapter_to_type') }}",
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
 var paper = $('#paper').val();
 var chapter = $('#chapter').val();
 var type = $('#type').val();
 


 if(paper && chapter && type){
    $.ajax({
     type:'POST',
     url:"{{ route('type_to_content') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        paper_id: paper,
        chapter_id: chapter,
        type_id: type
    },

    beforeSend: function() {
        $('.ajax-loading').show();// Note the ,e that I added
    },
    success:function(data){
        // console.log(data.status);




        if (data.status == 'active'){

           
            highlighted(paper, chapter, type, 1);
            

            if(data.pricing == 'freemium'){
                var content = `<article class="blog-post">${data.editor1.substr(0, 5000)}</article>.......... <br><br> <p>সম্পূর্ণ লেখাটি পড়তে নীচের বাটনে প্রেস করে কোর্সটি কিনুন। </p><br><br>
                <a href="{{ route('subscription')}}" class="btn btn-success">কোর্সটি কিনুন</a>`;
                $('#content').html(content);
            }else{
                var content = `<article class="blog-post">${data.editor1}</article>`;
                $('#content').html(content);
            }
        
      
        if(data.editor5){
            $('.paginate').after('<li class="page-item"><a class="page-link page-num" href="#">5</a></li>');
        }

        
        if(data.editor4){
            $('.paginate').after('<li class="page-item"><a class="page-link page-num" href="#">4</a></li>');
        }
        
        if(data.editor3){
            $('.paginate').after('<li class="page-item"><a class="page-link page-num" href="#">3</a></li>');
        }

        if(data.editor2){
            $('.paginate').after('<li class="page-item"><a class="page-link page-num" href="#">2</a></li>');
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
// console.log(data);
    if(page == 1){
        var content = `<article class="blog-post">${data.editor1}</article>`;
        $('#content').html(content);
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
    highlighted(data.paper_id, data.chapter_id, data.type_id, page);
    console.log(data.paper_id, data.chapter_id, data.type_id, page);

    $('.page-item').removeClass('active');
    $(this).parent().addClass('active');
   
})


</script>


@endsection