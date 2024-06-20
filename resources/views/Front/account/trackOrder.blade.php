@extends('Front.app ')
@section('content')
<style>
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: #455A64;
        padding-left: 0;
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        position: relative;
    }

    #progressbar li {
        list-style-type: none;
        font-size: 13px;
        width: 33.33%;
        position: relative;
        font-weight: 400;
        color: #455A64 !important;
        text-align: center;
    }

    #progressbar li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #455A64;
        border-radius: 50%;
        margin: auto;
        color: #fff;
        width: 29px;
        height: 29px;
        z-index: 1;
    }

    #progressbar li:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background: #455A64;
        top: 50%;
        left: 0;
        z-index: 0;
        transform: translateY(-50%);
    }

    #progressbar li:first-child:after {
        left: 50%;
        width: 50%;
    }

    #progressbar li:last-child:after {
        width: 50%;
        left: 0%;
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #4bb8a9;
    }

    #progressbar #step1:before {
        content: "1";
    }

    #progressbar #step2:before {
        content: "2";
    }

    #progressbar #step3:before {
        content: "3";
    }

    #progressbar li.active:last-child:after {
        background: #4bb8a9;
    }
</style>

<main>
    <h1 class="h5 my-3 text-center text-info">Track Order <a href="{{ route('orders.showCancelForm', $order->id) }}"> <span
                                                  @if ($order->status == 'pending')
                                                  class="badge bg-danger badge-sm mx-2">Cancel</span></a></h1>
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
                                             
                                        @endif
</main>
@endsection