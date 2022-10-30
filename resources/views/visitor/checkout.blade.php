@extends('visitor.layouts.app')

@section('content')




<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                @if(session('success'))
                <script>
                    Swal.fire(
                        'Good job!',
                        '{{ session('success') }}',
                        'success'
                        )
                </script>
                @endif
                <form class="row g-3" action="{{ route('premium_user') }}" method="POST">
                    @csrf

                    <div class="col-md-7">
                        <div class="card p-5 border-0 shadow">
                            <h3 class="text-center py-3">Billing Information</h3>
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            @if (!is_numeric(Auth()->user()->email))
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{Auth()->user()->email}}" readonly>
                            </div>
                            @else
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{Auth()->user()->email_phone}}" readonly>
                            </div>
                            @endif


                            @if (is_numeric(Auth()->user()->email))
                            <div class="col-md-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="{{Auth()->user()->email}}" readonly>
                            </div>
                            @else
                            <div class="col-md-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone"
                                    value="{{Auth()->user()->email_phone}}" name="phone" readonly>
                            </div>
                            @endif

                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="col-md-12">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                            </div>
                            <div class="col-md-12">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-md-12">
                                <label for="country" class="form-label">Country</label>
                                <select id="country" class="form-select" name="country" required>
                                    <option selected>Bangladesh</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="PaymentType" class="form-label">Payment Type</label>
                                <select id="PaymentType" name="PaymentType" class="form-select" required>
                                    <option selected>Select Payment Type</option>
                                    <option>Bkash</option>
                                    <option>Nagad</option>
                                    <option>Rocket</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="PaymentNumber" class="form-label">Payment Mobile Number</label>
                                <input type="text" class="form-control" id="PaymentNumber" name="PaymentNumber"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <label for="transaction_id" class="form-label">Transaction Id</label>
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="additinalinformation" class="form-label">Additional Information</label>
                                <textarea class="form-control" id="additinalinformation" rows="5"
                                    name="message"></textarea>
                            </div>


                            <input type="hidden" name="course" value="{{ implode(',', session()->get('ids')) }}">
                            {{-- <div class="col-12">
                                <button type="submit"
                                    class="btn btn-success rounded-pill px-3 py-2 shadow">Submit</button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card p-5 border-0 shadow">
                            <h4 class="text-center py-3">Your Order</h4>

                            <div class="d-flex justify-content-between">
                                <p class="fw-bold">Course</p>
                                <p class="fw-bold">Price</p>
                            </div>
                            @foreach (session()->get('courses') as $course)
                            <div class="d-flex justify-content-between">
                                <p>{{$course->subs_item}}</p>
                                <p>{{$course->subscription_fee}}</p>
                            </div>
                            @endforeach

                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="fw-bold">Sub Total </p>
                                <p class="fw-bold"><span>{{session()->get('total')}}</span> Tk</p>
                            </div>
                            <br><br>
                            <h3 class="text-center">Total Price = {{session()->get('total')}} Tk</h3>
                            <br><br>

                            <input type="submit" value="Submit" class="btn btn-success px-3 py-2 shadow fw-bold">
                            {{-- <button type="submit" class="btn btn-success px-3 py-2 shadow fw-bold">Submit</button>
                            --}}


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection