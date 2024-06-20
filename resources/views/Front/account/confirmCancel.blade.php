@extends('Front.app')
@section('content')
<style>
    .card-custom {
            border: none;
            background-color: #f8f9fa;
        }
        .card-custom-header {
            background-color: #fff;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .card-custom-body {
            padding: 20px;
        }
        .icon-check {
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
        }
        .btn-done {
            background-color: #ff3366;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
        }
        .product-thumbnail {
            width: 60px;
            height: 60px;
        }
        .product-info {
            display: flex;
            align-items: center;
        }
        .product-details {
            margin-left: 15px;
        }
        .alert-custom {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #dee2e6;
            padding: 10px;
            margin-top: 10px;
        }
        .alert-custom svg {
            margin-right: 10px;
        }
 
</style>
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a>
                        </li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-custom">
                            <div class="card-custom-header text-center">
                                <img src="https://myntraweb.blob.core.windows.net/selfserveui/assets/images/done.png" alt="doneImage" class="icon-check">
                                <h4 class="font-weight-bold">Order Cancelled</h4>
                            </div>
                            <div class="card-custom-body">
                                <h5 class="font-weight-bold">{{$canceledItemCount}} is cancelled</h5>
                                <div class="product-info mt-3 p-3 bg-light rounded">
                                    <img src="https://assets.myntassets.com/f_webp,dpr_1,q_10,w_200,c_limit,fl_progressive/assets/images/25099890/2023/9/21/b887a28b-419b-434e-8a3c-2af57d14ae561695300421585QuaceYellowRiceFairyStringLights1.jpg" class="product-thumbnail rounded" alt="Product Image">
                                    <div class="product-details">
                                        <h6 class="font-weight-bold mb-0">Quace</h6>
                                        <p class="mb-0">Yellow Rice Fairy String Lights</p>
                                    </div>
                                </div>
                                <div class="alert alert-custom mt-4">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" color="#03A685"><path d="M16.78 9.7a.75.75 0 00-1.06-1.06l-5.14 5.13-2.3-2.3a.75.75 0 10-1.06 1.06l2.83 2.83a.75.75 0 001.06 0l5.67-5.66z" fill="#03A685"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.476 2 2 6.476 2 12s4.476 10 10 10 10-4.476 10-10S17.524 2 12 2zM3.5 12c0-4.696 3.804-8.5 8.5-8.5s8.5 3.804 8.5 8.5-3.804 8.5-8.5 8.5A8.498 8.498 0 013.5 12z" fill="#03A685"></path></svg>
                                    <div>
                                        <strong>REFUND DETAILS</strong>
                                        <p class="mb-0">A refund is not applicable on this order as it is a Pay on delivery order</p>
                                    </div>
                                </div>
                                <div class="alert alert-custom mt-4">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" color="#03A685"><path d="M16.78 9.7a.75.75 0 00-1.06-1.06l-5.14 5.13-2.3-2.3a.75.75 0 10-1.06 1.06l2.83 2.83a.75.75 0 001.06 0l5.67-5.66z" fill="#03A685"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.476 2 2 6.476 2 12s4.476 10 10 10 10-4.476 10-10S17.524 2 12 2zM3.5 12c0-4.696 3.804-8.5 8.5-8.5s8.5 3.804 8.5 8.5-3.804 8.5-8.5 8.5A8.498 8.498 0 013.5 12z" fill="#03A685"></path></svg>
                                    <div>
                                        <strong>PLEASE NOTE</strong>
                                        <p class="mb-0">You will receive an email/sms confirming the cancellation of order shortly.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p-3">
                                <button class="btn btn-done">DONE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         
    </main>
@endsection
 