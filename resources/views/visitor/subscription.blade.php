@extends('visitor.layouts.app')

@section('content')




@if(session('success'))
<script>
    Swal.fire(
    'Good job!',
    '{{ session('success') }}',
    'success'
    )
</script>
@elseif(session('error'))
<script>
    Swal.fire(
    'Ooops....!',
    '{{ session('error') }}',
    'error'
    )
</script>
@endif



<div class="container py-5">
    <div class="card p-5 border-0 shadow">

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="row" action="{{route('checkout_data')}}" method="post">
            @csrf
            @if (@$sub_hsc[0])
            <div class="col-md-6">
                <h4 class="mt-3">Hsc and Admission</h4><br>
                @foreach ($sub_hsc as $item)
                @if ($item->type == 'HSC')
                <div class="form-check">
                    <input class="form-check-input sub_check" type="checkbox" value="{{$item->id}}" id="{{$item->id}}"
                        name="course[]">
                    <label class="form-check-label" for="{{$item->id}}">
                        {{$item->subs_item}} - {{$item->subscription_fee}} Tk
                    </label>
                </div>
                @endif
                @endforeach
            </div>
            @endif

            @if (@$sub_eng[0])
            <div class="col-md-6">
                <h4 class="mt-3">Engineering</h4><br>
                @foreach ($sub_eng as $item)
                @if ($item->type == 'Engineering')
                <div class="form-check">
                    <input class="form-check-input sub_check" type="checkbox" value="{{$item->id}}" id="{{$item->id}}"
                        name="course[]">
                    <label class="form-check-label" for="{{$item->id}}">
                        {{$item->subs_item}} - {{$item->subscription_fee}} Tk
                    </label>
                </div>
                @endif
                @endforeach
            </div>
            @endif

            <div class="row mt-5">
                <div class="col-md-12 my-auto">
                    <h5>Total Price: <span id="total_price">0.00</span> Tk</h5>
                </div>
                <div class="col-md-12 my-auto">
                    <button class="btn btn-success rounded-pill px-3 py-2 shadow mt-3" type="submit"><i
                            class="fa-solid fa-cart-shopping me-2"></i> Checkout </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script>
    var course = []
    $("input:checkbox[name=course]:checked").each(function(){
        course.push($(this).val());
        alert(course)
});
</script>

<script>
    $(".sub_check").change(function(e){
  
  e.preventDefault();


  if($(this).is(':checked')){
    var sub_check = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('subscription_total') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        sub_id: sub_check
    },

        success:function(data){

            var total = $('#total_price').text();
            var totalPrice = parseFloat(total) + parseFloat(data.subscription_fee);
            $('#total_price').text(totalPrice);
        }
  });
  }else{
    var sub_check = $(this).val();

  $.ajax({
     type:'POST',
     url:"{{ route('subscription_total') }}",
     data:{
        '_token': $('input[name=_token]').val(),
        sub_id: sub_check
    },

        success:function(data){

            var total = $('#total_price').text();
            var totalPrice = parseFloat(total) - parseFloat(data.subscription_fee);
            $('#total_price').text(totalPrice);
        }
  });
  }
});
</script>

@endsection