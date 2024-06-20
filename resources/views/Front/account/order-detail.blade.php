@extends('Front.app')
@section('content')

    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">

            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('Front.account.common.sidebar')
                    </div>
                    <div class="col-md-9">

                        <div class="card">
                            <div class="card-header pt-3">
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <h1 class="h5 mb-3">Shipping Address</h1>
                                        <address>
                                            <strong>{{ $order->first_name . ' ' . $order->last_name }}</strong><br>
                                            {{ $order->address }}<br>
                                            {{ $order->city }},{{ $order->zip }}<br>
                                            Phone: {{ $order->mobile }}<br>
                                            Email: {{ $order->email }}
                                        </address>
                                        <strong>Shipped Date</strong>
                                        <time datetime="2019-10-01">
                                            @if (!empty($order->shipped_date))
                                                {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}
                                            @else
                                                n/a
                                            @endif
                                        </time>
                                    </div>



                                    <div class="col-sm-4 invoice-col">
                                        {{-- <b>Invoice #007612</b><br> --}}
                                        <br>
                                        <b>Order ID:</b> {{ $order->id }}<br>
                                        <b>Total:</b>{{ $order->grand_total }}<br>
                                        <b>Status:</b>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-danger">Pending</span>
                                        @elseif($order->status == 'placed')
                                            <span class="badge" style="background-color: cornflowerblue">Placed</span>
                                        @elseif($order->status == 'shipped')
                                            <span class="badge bg-info">Shipped</span>
                                        @elseif($order->status == 'delivered')
                                            <span class="badge bg-success">deliverd</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge bg-danger">cancelled</span>
                                        @endif

                                        <br>

                                        @if ($order->status != 'cancelled' && $order->status != 'delivered')
                                            <!-- Track Order Button -->
                                            <a href="{{ route('trackOrder', $order->id) }}"
                                                class="badge bg-warning text-white my-2">Track order</a><br>

                                            <!-- Cancel Order Button -->
                                            @if ($order->status == 'pending')
                                                <a href="{{ route('orders.showCancelForm', $order->id) }}">
                                                    <span class="badge bg-danger badge-sm mx-2">Cancel</span>
                                                </a>
                                            @endif
                                        @endif



                                    </div>

                                    <div class="col-sm-4">
                                        {{-- <h1 class="h5 mb-3">Track Order <a href=""> <span
                                                  @if ($order->status == 'pending')
                                                  class="badge bg-danger">Cancel</span></a></h1>
                                                  @endif

                                        @if ($order->status == 'pending')
                                            @include('Front.myaccount.steps.pending')
                                        @elseif($order->status == 'placed')
                                            @include('Front.myaccount.steps.dispatched')
                                        @elseif($order->status == 'shipped')
                                            @include('Front.myaccount.steps.shipped')
                                        
                                        @elseif($order->status == 'delivered')
                                            @include('Front.myaccount.steps.delivered')
                                        @elseif($order->status == 'cancelled')
                                        @include('Front.myaccount.steps.processed')
                                             
                                        @endif --}}
                                        <h6 class="mt-0 mb-3 h5">Order Total</h6>

                                        <!-- List group -->
                                        <ul>
                                            <li class="list-group-item d-flex">
                                                <span>Subtotal</span>
                                                <span class="ms-auto">Rs . {{ $subtotal }}</span>
                                            </li>
                                            <li class="list-group-item d-flex">
                                                <span>Tax</span>
                                                <span class="ms-auto"> Rs. 0.00</span>
                                            </li>
                                            <li class="list-group-item d-flex">
                                                <span>Shipping</span>
                                                <span class="ms-auto">Rs. 20</span>
                                            </li>
                                            <li class="list-group-item d-flex fs-lg fw-bold">
                                                <span>Total</span>
                                                <span class="ms-auto">Rs. {{ $gtotal }}</span>
                                            </li>
                                        </ul>


                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-body table-responsive p-3">
                                <table class="table table-striped">
                                    <thead>
    
                                        <tr>
                                            <th>Product</th>
                                            <th width="100">Price</th>
                                            <th width="100">Qty</th>
                                            <th width="100">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItems as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>Rs. {{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>Rs. {{ number_format($item->total, 2) }}</td>
                                            </tr>
                                        @endforeach
    
                                        <tr>
                                            <th colspan="3" class="text-right">Subtotal:</th>
                                            <td>Rs. {{ number_format($order->subtotal, 2) }}</td>
                                        </tr>
    
                                        <tr>
                                            <th colspan="3" class="text-right">Shipping:</th>
                                            <td>Rs. 20.00</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Grand Total:</th>
                                            <td>Rs. {{ number_format($order->grand_total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>
                        <div class="card">
                            <div class="card-header">
                                @if (isset($order->id))
                                    <h2 class="h5 mb-0 pt-2 pb-2">Order: {{ $order->id }}</h2>
                                @endif
                            </div>

                            <div class="card-body pb-0">
                                <!-- Info -->
                                <div class="card card-sm">
                                    <div class="card-body bg-light mb-3">
                                        <div class="row">
                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Order No:</h6>
                                                <!-- Text -->
                                                <p class="mb-lg-0 fs-sm fw-bold">
                                                    {{ $order->id }}
                                                </p>
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                                <!-- Text -->
                                                <p class="mb-lg-0 fs-sm fw-bold">
                                                    <time datetime="2019-10-01">
                                                        @if (!empty($order->shipped_date))
                                                            {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}
                                                        @else
                                                            n/a
                                                        @endif
                                                    </time>
                                                </p>
                                            </div>
                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Status:</h6>
                                                <!-- Text -->
                                                <p class="mb-0 fs-sm fw-bold">
                                                    @if ($order->status == 'pending')
                                                        <span class="badge bg-danger">Pending</span>
                                                    @elseif($order->status == 'shipped')
                                                        <span class="badge bg-info">Shipped</span>
                                                    @elseif($order->status == 'delivered')
                                                        <span class="badge bg-success">deliverd</span>
                                                    @elseif($order->status == 'cancelled')
                                                        <span class="badge bg-danger">cancelled</span>
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="col-6 col-lg-3">
                                                <!-- Heading -->
                                                <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                                <!-- Text -->
                                                <p class="mb-0 fs-sm fw-bold">
                                                    {{ $order->grand_total }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer p-3">

                                <!-- Heading -->
                                <h6 class="mb-7 h5 mt-4">Order Items ({{ $orderItemsCount }})</h6>

                                <!-- Divider -->
                                <hr class="my-3">

                                <!-- List group -->
                                <ul>
                                    @foreach ($orderItems as $item)
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-4 col-md-3 col-xl-2">
                                                    <!-- Image -->
                                                    <a href="product.html">
                                                        <img src="{{ asset('admin-assets/products_img/' . $item->image) }}"
                                                            alt="Product Image" class="img-fluid">
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- Title -->
                                                    <p class="mb-4 fs-sm fw-bold">
                                                        <a class="text-body product-name" href="product.html">
                                                            {{ Illuminate\Support\Str::limit($item->name, 30) }} x
                                                            {{ $item->qty }}
                                                        </a>
                                                        <span class="text-muted text-primary">Rs.
                                                            {{ $item->total }}</span>
                                                    </p>
                                                </div>


                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- <div class="card card-lg mb-5 mt-3">
                            <div class="card-body">
                                <!-- Heading -->
                                <h6 class="mt-0 mb-3 h5">Order Total</h6>

                                <!-- List group -->
                                <ul>
                                    <li class="list-group-item d-flex">
                                        <span>Subtotal</span>
                                        <span class="ms-auto">Rs . {{ $subtotal }}</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <span>Tax</span>
                                        <span class="ms-auto"> Rs. 0.00</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <span>Shipping</span>
                                        <span class="ms-auto">Rs. 20</span>
                                    </li>
                                    <li class="list-group-item d-flex fs-lg fw-bold">
                                        <span>Total</span>
                                        <span class="ms-auto">Rs. {{ $gtotal }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
