@extends('Front.app ')
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
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table">

                                        <tbody>
                                            <tr>
                                                @if ($groupedOrders->isNotEmpty())
                                                    @foreach ($groupedOrders as $orderId => $orders)
                                            <tr>
                                                <!-- Display Products in the Order -->
                                                <td colspan="5">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Product Image</th>
                                                                <th>Product Name</th>
                                                                <th>Quantity</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr>
                                                                    <td> <a
                                                                            href="{{route('account.orderDetail', $orderId)}}">
                                                                            <img src="{{asset('admin-assets/products_img/'.$order->product_image) }}"
                                                                                alt="..." class="img-fluid"
                                                                                style="width:100px">
                                                                        </a>
                                                                    </td>
                                                                    <td>{{ Illuminate\Support\Str::limit($order->item_name, 50, '...') }}
                                                                    </td>
                                                                    <td>{{ $order->qty }}</td>
                                                                    <td>Rs.{{$order->item_price}}</td>
                                                                    <td>Rs.{{$order->item_total}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <!-- Display Order Details -->
                                                <td colspan="5">
                                                    <strong>Order ID:</strong> {{ $orderId }} <br>
                                                    <strong>Order Date:</strong>
                                                    @if ($orders->first()->created_at instanceof \DateTime)
                                                        {{ $orders->first()->created_at->format('Y-m-d') }}
                                                    @else
                                                        {{\Carbon\Carbon::parse($orders->first()->created_at)->format('Y-m-d') }}
                                                    @endif
                                                    <br>
                                                    <strong>Status:</strong>
                                                    @php
                                                        $status = $orders->first()->status;
                                                        $badgeClass  = '';

                                                        switch ($status) {
                                                            case 'shipped':
                                                                $badgeClass = 'bg-info';
                                                                break;
                                                            case 'delivered':
                                                                $badgeClass = 'bg-success';
                                                                break;
                                                            case 'placed':
                                                                $badgeStyle =
                                                                    'style="background-color:cornflowerblue"';
                                                                break;
                                                            case 'cancelled':
                                                                $badgeClass ='bg-warning';
                                                                break;
                                                            default:
                                                                $badgeClass ='bg-danger';
                                                                break;
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}"  >{{ ucfirst($status) }}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
