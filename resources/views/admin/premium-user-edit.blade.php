@extends('admin.layouts.app')

@section('content')




<div id="main">
    <div class="row">
        <div class="col">
            @if(session('success'))
            <script>
                Swal.fire(
                        'Good job!',
                        '{{ session('success') }}',
                        'success'
                        )
            </script>
            @endif
            <form action="{{ route('admin.premium_update', $premium_user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="card p-5 border-0 shadow">
                    <h3 class="text-center py-3">Premium User</h3>
                    <div class="col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$premium_user->name}}"
                            readonly>
                    </div>

                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{$premium_user->email}}" readonly>
                    </div>


                    <div class="col-md-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" value="{{$premium_user->phone}}" name="phone"
                            readonly>
                    </div>

                    <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{$premium_user->address}}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="zipCode" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zipCode" name="zipCode"
                            value="{{$premium_user->zipCode}}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{$premium_user->city}}"
                            readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="country" class="form-label">Country</label>
                        <select id="country" class="form-select" name="country" readonly>
                            <option selected>{{$premium_user->country}}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="PaymentType" class="form-label">Payment Type</label>
                        <select id="PaymentType" name="PaymentType" class="form-select" readonly>
                            <option selected>{{$premium_user->PaymentType}}</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="PaymentNumber" class="form-label">Payment Mobile Number</label>
                        <input type="text" class="form-control" id="PaymentNumber" name="PaymentNumber"
                            value="{{$premium_user->PaymentNumber}}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="transaction_id" class="form-label">Transaction Id</label>
                        <input type="text" class="form-control" id="transaction_id" name="transaction_id"
                            value="{{$premium_user->transaction_id}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="additinalinformation" class="form-label">Additional Information</label>
                        <textarea class="form-control" id="additinalinformation" rows="5" name="message"
                            readonly>{{$premium_user->message}}</textarea>
                    </div>


                    {{-- <input type="hidden" name="course" value="{{ implode(',', session()->get('ids')) }}"> --}}

                    <br>
                    <h6>Subscription Courses</h6>

                    <ol>
                        @foreach ($courses as $course)

                        <li>{{$course->subs_item . ' - ' .$course->subscription_fee}}</li>

                        @endforeach
                    </ol>
                    <h6>Total Price = <span>{{$total}}</span></h6>
                    <div class="col-md-12">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option {{$premium_user->status == 'pending' ? 'selected' : ''}}>pending</option>
                            <option {{$premium_user->status == 'approve' ? 'selected' : ''}}>approve</option>
                        </select>
                    </div>

                    <br>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success px-3 py-2 shadow">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection