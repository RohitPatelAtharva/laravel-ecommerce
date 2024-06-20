@extends('Front.app')
@section('content')
<style>
    

        .card {
            margin: 20px;
        }
        .product-details {
            display: flex;
            align-items: center;
        }
        .product-thumbnail {
            background: rgb(229, 241, 255);
            height: 85px;
            width: 64px;
            border-radius: 2px;
            overflow: hidden;
        }
        .product-thumbnail img {
            width: 100%;
        }
        .product-info {
            margin-left: 15px;
        }
        .product-info .price {
            font-weight: 400;
        }
        .product-info .market-price {
            text-decoration: line-through;
            color: gray;
        }
        .icon-rupee {
            font-size: 14px;
        }
        .radio-wrapper {
            margin-bottom: 10px;
        }
        .radio-wrapper input {
            margin-right: 10px;
        }
</style>
<div class="container col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="product-details">
                <div class="product-thumbnail">
                    {{-- <img src="{{ $order->product_image_url }}" alt="Product Image"> --}}
                </div>
                <div class="product-info">
                    {{-- <h5 class="product-name">{{ $order->product_name }}</h5>
                    <p class="product-size">Size: {{ $order->product_size }}</p> --}}
                    <p class="product-price">
                        {{-- <span class="icon-rupee">₹</span><span class="price">{{ $order->product_price }}</span> --}}
                        {{-- <span class="market-price"><span class="icon-rupee">₹</span>{{ $order->product_market_price }}</span> --}}
                        {{-- <span class="discount">Saved <span class="icon-rupee">₹</span>{{ $order->product_market_price - $order->product_price }}</span> --}}
                    </p>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <h5>Reason for cancellation</h5>
                <p>Please tell us the correct reason for cancellation. This information is only used to improve our service</p>
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    @foreach(['Incorrect size ordered', 'Product not required anymore', 'Cash Issue', 'Ordered By Mistake', 'Wants to change style/color', 'Delayed Delivery Cancellation', 'Duplicate Order'] as $reason)
                        <label class="radio-wrapper">
                            <input type="radio" name="reason" value="{{ $reason }}"> {{ $reason }}
                        </label><br>
                    @endforeach
                    <textarea class="form-control" name="comments" placeholder="Additional Comments" rows="3"></textarea>
                    <button type="submit" class="btn btn-danger mt-3">Submit Cancellation</button>
                </form>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Refund Details</h6>
                    <p>₹ 0</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 