@extends('admin.layouts.app')
@section('content')

    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6 text-right">

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button class="bg-light" type="button"
                                onclick="window.location.href='{{ route('order.index') }}'">Reset</button>
                        </div>
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">Order#</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>

                                <th>Status</th>
                                <th>Ammount</th>
                                <th>Action</th>
                                <th>Date Purchased</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isNotEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><a href="{{ route('order.detail', $order->id) }}">{{ $order->id }}</a></td>
                                        <td>{{ isset($order->user_id) ? $order->user_name : $order->client_name }}</td>
                                        <td>{{ isset($order->user_id) ? $order->user_email : $order->client_email }}</td>
                                        <td>{{ $order->mobile }}</td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-danger">Pending</span>
                                            @elseif($order->status == 'shipped')
                                                <span class="badge bg-info">Shipped</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge bg-success">deliverd</span>
                                            @elseif($order->status == 'cancelled')
                                                <span class="badge bg-danger">cancelled</span>
                                            @endif



                                            {{-- <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                               </svg>
                               @else

                               <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path> --}}
                                            {{-- </svg> --}}



                                        </td>
                                        <td>
                                            Rs. {{ number_format($order->grand_total, 2) }}

                                        </td>
                                        @if ($order->status != 'cancelled' && $order->client_id != null)
                                            <td><a href="{{ route('return.order', $order->id) }}"
                                                    class="badge bg-primary text-white my-2">Return Order</a></td>
                                        @else
                                            <td>
                                                <span  class="info-box-icon bg-danger elevation-1 "><i class="fas fa-thumbs-up "  ></i></span> 
                                            </td>
                                        @endif
                                        <td>
                                            {{ \carbon\Carbon::parse($order->created_at)->format('d,M,Y') }}

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td rowspan="5">Recosds Not found</td>
                                </tr>
                            @endif






                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $orders->links() }}
                    {{-- <ul class="pagination pagination m-0 float-right">
                 <li class="page-item"><a class="page-link" href="#">«</a></li>
                 <li class="page-item"><a class="page-link" href="#">1</a></li>
                 <li class="page-item"><a class="page-link" href="#">2</a></li>
                 <li class="page-item"><a class="page-link" href="#">3</a></li>
                 <li class="page-item"><a class="page-link" href="#">»</a></li>
               </ul> --}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>

@endsection
