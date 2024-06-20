@extends('Front.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{route('Front.shop')}}">Shop</a></li>
                        <li class="breadcrumb-item">Checkout</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-9 pt-4">
            <div class="container">
                <form id="OrderForm" name="OrderForm" action="" method="post">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="sub-title">
                                <h2>Shipping Address</h2>
                            </div>
                            <div class="card shadow-lg border-0">
                                <div class="card-body checkout-form">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" name="first_name" id="first_name" class="form-control"
                                                    placeholder="First Name"
                                                    value="{{(!empty($customerAddress)) ? $customerAddress->first_name : '' }} ">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" name="last_name" id="last_name" class="form-control"
                                                    placeholder="Last Name" value="{{(!empty($customerAddress)) ? $customerAddress->last_name: '' }}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Email" value="{{(!empty($customerAddress)) ? $customerAddress->email: '' }}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <select name="country" id="country" class="form-control">
                                                    <option value="">Select a Country</option>
                                                    @if (!empty($countries))
                                                        @foreach ($countries as $country)
                                                        <option {{ (!empty($customerAddress) && $customerAddress->countries_id == $country->id) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{(!empty($customerAddress)) ? $customerAddress->address :''}}</textarea>
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="appartment" id="appartment" class="form-control"
                                                    placeholder="Apartment, suite, unit, etc. (optional)" value="{{(!empty($customerAddress)) ? $customerAddress->apartment :''}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="city" id="city" class="form-control"
                                                    placeholder="City" value="{{(!empty($customerAddress)) ? $customerAddress->city :''}}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="state" id="state" class="form-control"
                                                    placeholder="State" value="{{(!empty($customerAddress)) ? $customerAddress->state :''}}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="zip" id="zip" class="form-control"
                                                    placeholder="Zip" value="{{(!empty($customerAddress)) ? $customerAddress->zip :''}}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="mobile" id="mobile" class="form-control"
                                                    placeholder="Mobile No." value="{{(!empty($customerAddress)) ? $customerAddress->mobile :''}}">
                                                <p></p>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="note" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sub-title">
                                <h2>Order Summery</h3>
                            </div>
                            <div class="card cart-summery">
                                <div class="card-body">
                                    @if (!empty($cartItems))
                                        @foreach ($cartItems as $item)
                                            <div class="d-flex justify-content-between pb-2">
                                                <div class="h6">{{ Illuminate\Support\Str::limit($item->title, 20) }} x
                                                    {{ $item->quantity }}</div>
                                                <div class="h6">Rs .{{ $item->price * $item->quantity }}</div>
                                            </div>
                                        @endforeach
                                    @endif



                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Subtotal</strong></div>
                                        <div class="h6"><strong>Rs. {{ $subtotal }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Shipping</strong></div>
                                        <div class="h6"><strong>Rs. 20</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5 text-success"><strong>Total</strong></div>
                                        <div class="h5 text-success"><strong>Rs. {{ $total }}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card payment-form ">

                                <h3 class="card-title h5 mb-3">Payment Method</h3>
                                <div class="d-flex">
                                    <div class="form-check text-center">
                                        <input checked type="radio" name="payment_method" value="cod"
                                            id="payment_method_one">
                                        <label for="payment_method_one">COD</label>
                                    </div>
                                    <div class="form-check  text-center">
                                        <input type="radio" name="payment_method" value="upi"
                                            id="payment_method_upi">
                                        <label for="payment_method_upi">UPI</label>
                                    </div>
                                    <div class="form-check text-center">
                                        <input type="radio" name="payment_method" value="atm_debit"
                                            id="payment_method_two">
                                        <label for="payment_method_two">ATM/Debit</label>
                                    </div>
                                </div>

                                <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                                    <div class="mb-3">
                                        <label for="card_number" class="mb-2">Card Number</label>
                                        <input type="text" name="card_number" id="card_number"
                                            placeholder="Valid Card Number" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="expiry_date" class="mb-2">Expiry Date</label>
                                            <input type="text" name="expiry_date" id="expiry_date"
                                                placeholder="MM/YYYY" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cvv_code" class="mb-2 ">CVV Code</label>
                                            <input type="text" name="cvv_code" id="cvv_code" placeholder="123"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="pt-4">
                                    <button type="submit" href="#" class="btn-dark btn btn-block w-100">Pay
                                        Now</button>
                                </div>
                                <!-- CREDIT CARD FORM ENDS HERE -->

                            </div>

                        </div>
                    </div>
                </form>
        </section>
    </main>
@endsection

@section('customjs')
    <script>
        $('#payment_method_one').click(function() {
            if ($(this).is(":checked") == true) {
                $('#card-payment-form').addClass('d-none');
            }
        });
        $('#payment_method_two').click(function() {
            if ($(this).is(":checked") == true) {
                $("#card-payment-form").removeClass('d-none');
            }
        });
        $("#OrderForm").submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            $("button[type='submit']").prop('disabled', true);
            // AJAX request to process the checkout
            $.ajax({
                url: '{{ route('front.processCheckout') }}',
                type: 'post',
                data: $(this).serializeArray(), // Serialize form data
                dataType: 'json',
                success: function(response) {
                    // Re-enable submit button
                    $("button[type='submit']").prop('disabled', false);

                    // Handle success response
                    if (response.status === false) {

                        $('.invalid-feedback').remove();

                        // Display validation errors
                        $.each(response.errors, function(key, value) {
                            $('#' + key).addClass('is-invalid').after(
                                '<p class="invalid-feedback">' + value[0] + '</p>');
                        });
                    } else {
                        // Redirect to thank you page with order ID
                        var orderId = response.orderId;
                        window.location.href =
                            "{{ route('front.thankyou', ['orderId' => ':orderId']) }}".replace(
                                ':orderId', orderId);
                    }
                }
            });
        });
    </script>
@endsection
