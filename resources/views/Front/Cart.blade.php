@extends('Front.app')
@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('Front.shop')}}">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-9 pt-4">
        <div class="container">
            @if ($cartItems->isEmpty())
            <div class="alert alert-info text-center text-primary" role="alert">
                 <h1>Your cart is empty.</h1>
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" fill="#6c757d">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M17.68 14.26l-1.78 5.34c-.05.15-.2.25-.37.25H8.45c-.17 0-.32-.1-.37-.25l-1.78-5.34L4 7h15zM9.95 18h4.1l1.2-3.6H8.75l1.2 3.6zm7.6-9H6.45l-.59-1.76L5.25 5H3v2h1.59l1.78 5.34c.05.15.2.26.37.26h6.5c.18 0 .33-.11.38-.26L17.41 11H22V9h-2.25l-1.06-3.18L17.55 9zM6 6l-.71-2.13L4.25 3h15.5l-.04.12L18 6H6z"/>
                </svg>
            </div>
            @else
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive opacity">
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr id="cart-item-{{ $item->id }}">
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('admin-assets/products_img/' . $item->image) }}"
                                                alt="Product Image">
                                            <h2>{{ Illuminate\Support\Str::limit($item->name, 10) }}</h2>
                                        </div>
                                    </td>
                                    <td id="price-{{ $item->id }}">Rs. {{ $item->price }}</td>
                                    <td>
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub"
                                                    onclick="updateCart('{{ $item->id }}', 'subtract')">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm border-0 text-center quantity-input"
                                                id="quantity-{{ $item->id }}" value="{{ $item->quantity }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add"
                                                    onclick="updateCart('{{ $item->id }}', 'add')">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td id="total-price-{{ $item->id }}">
                                        @php
                                        $total[$item->id] = number_format($item->price * $item->quantity, 2);
                                        @endphp
                                        Rs. {{ $total[$item->id] }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="deleteCartItem('{{ $item->id }}')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card cart-summery opacity">
                        <div class="sub-title">
                            <h2 class="bg-white">Cart Summary</h2>
                        </div>
                        @php
                        $totalQuantity = 0;
                        foreach ($cartItems as $item) {
                        $totalQuantity += $item->quantity;
                        } @endphp
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2">
                                <div>Subtotal <span id="total-quantity">({{ $totalQuantity }} items) </span></div>
                                <div id="subtotal">
                                    @if (!empty($total))
                                    Rs. {{ number_format(array_sum($total), 2) }}
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div>Shipping</div>
                                <div>Rs. 20</div>
                            </div>
                            <div class="d-flex justify-content-between summery-end">
                                <div>Total</div>
                                <div id="total">
                                    @if (!empty($total))
                                    Rs. {{ number_format(array_sum($total) + 20, 2) }}
                                    @endif
                                </div>
                            </div>
                            <div class="pt-5">
                                <a href="{{ route('front.checkout') }}"
                                    class="btn-dark btn btn-block w-100">Proceed to
                                    Checkout</a>
                            </div>
                        </div>
                    </div>
                    <div class="input-group apply-coupan mt-4">
                        <input type="text" placeholder="Coupon Code" class="form-control">
                        <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</main>
@endsection

@section('customjs')
    <script>
        function updateCart(itemId, action) {
            var maxQuantity = 10;
            var quantityElement = $('#quantity-' + itemId);
            var currentQuantity = parseInt(quantityElement.val());
            var newQuantity = action === 'add' ? Math.min(currentQuantity + 1, maxQuantity) : Math.max(currentQuantity - 1,
                1);
            if (newQuantity < 1) {
                newQuantity = 1;
            }
            quantityElement.val(newQuantity);
            $('.opacity').css('opacity', '0.5');

            $.ajax({
                url: '{{ route('front.updateCart') }}',
                type: 'POST',
                data: {
                    productId: itemId,
                    quantity: newQuantity
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        if (response.totalPrice) {
                            updateTotalPrice(itemId, response.totalPrice);
                            updateCartSummary(); // Call to update subtotal and total prices
                        } else {
                            console.error('Total price not found in response.');
                        }
                    } else {
                        quantityElement.val(currentQuantity);
                        alert(response.message);
                    }
                    setTimeout(function() {
                        $('.opacity').css('opacity', '1');
                    }, 30);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateTotalPrice(itemId, totalPrice) {
            // Assuming you have an element where the total price is displayed with the ID 'total-price-itemId'
            var totalElement = $('#total-price-' + itemId);

            // Update the total price element with the new total price
            totalElement.text('Rs. ' + totalPrice.toFixed(2)); // Assuming totalPrice is in rupees and formatted correctly

        }

        function updateCartSummary() {
            $.ajax({
                url: '{{ route('front.cartSummary') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#subtotal').text('Rs. ' + response.subtotal.toFixed(2)); // Update subtotal element
                    $('#total').text('Rs. ' + response.total.toFixed(2)); // Update total element
                    $('#total-quantity').text('(' + response.totalQuantity + 'items)');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        }


        function deleteCartItem(productId) {
            $.ajax({
                url: '{{ route('cart.delete', ':productId') }}'.replace(':productId', productId),
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Remove the cart item element from the page
                        $('#cart-item-' + productId).fadeOut(400, function() {
                            $(this).remove(); // Remove the element after fading out
                            // Update cart summary after deleting the item
                            updateCartSummary();
                        });
                    } else {
                        console.error('Error deleting cart item:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    // You can handle errors here, such as displaying an error message to the user
                }
            });
        }
    </script>
@endsection
