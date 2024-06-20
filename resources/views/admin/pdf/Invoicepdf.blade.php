{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Bill</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/custombox@4.0.3/dist/custombox.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .btn-success {
            border-color: #10C888 !important;
            background-color: #16D39A !important;
            color: #FFFFFF;
        }

        .btn-blue-grey {
            border-color: #455A64 !important;
            background-color: #607D8B !important;
            color: #FFFFFF;
        }

        .btn-danger {
            border-color: #FF6275 !important;
            background-color: #FF7588 !important;
            color: #FFFFFF;
        }

        .btn-cyan {
            border-color: #0097A7 !important;
            background-color: #00BCD4 !important;
            color: #FFFFFF;
        }

        .btn-blue {
            border-color: #1976D2 !important;
            background-color: #2196F3 !important;
            color: #FFFFFF;
        }

        .btn-facebook {
            background-color: #3b5998;
            color: #fff;
            background-color: #3b5998;
            border-color: #fff;
        }

        .btn-vimeo {
            background-color: #1ab7ea;
            color: #fff;
            background-color: #1ab7ea;
            border-color: #fff;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }
        @media print {
            
        .exclude-print {
            display: none;

        }
    }

        /* Your custom styles */
        .btn-success {
            border-color: #10C888 !important;
            background-color: #16D39A !important;
            color: #FFFFFF;
        }
       
    </style>
</head>

<body>
    
   <form action="" method="post" target="_blank">
    @csrf
    
    <section>
        <div class="container">
            <div id="invoice-content" class="row mt-2">
                <div class="col-MD-6 col-sm-12 text-xs-center text-md-left">
                    <p></p>
                    <img src="{{ asset('images\Green_White_Minimalist_Aesthetic_Plant_and_Flower_Shop_Logo-removebg-preview (1).png') }}"
                        class="img-responsive p- m-b-" style="max-height: 200px;">
                    <p class="ml-2">E-comerce Shopping</p>
                </div>
                <div class="col-sm-6 col-sm-12 text-xs-center text-md-right">
                    <h2>INVOICE</h2>
                    <p class="pb-1"> SRN 1009</p>
                    <p class="pb-1">Reference:</p>
                    <ul class="px-0 list-unstyled">
                        <li>Gross Amount</li>
                        <li class="lead text-bold-800">$ 798.40</li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                    <div class="col-sm-12 text-xs-center text-md-left">
                        <p class="text-muted"> Bill To</p>
                    </div>
                    <ul class="px-0 list-unstyled">
                        <li class="text-bold-800"><a href="#"><strong class="invoice_a">{{ $orderData['order']['first_name'] }}</strong></a></li>
                        <li>{{ $orderData['order']['address'] }}</li>
                        <li>{{ $orderData['order']['city'] }}</li>
                        <li>{{ $orderData['order']['zip'] }}</li>
                        <li>{{ $orderData['order']['mobile'] }}</li>
                        <li>{{ $orderData['order']['email'] }}</li>
                    </ul>
                </div>
                <div class="offset-md-3 col-md-3 col-sm-12 text-xs-center text-md-left">
                    <p><span class="text-muted">Invoice Date :</span> 24-05-2024</p>
                    <p><span class="text-muted">Due Date :</span> 24-05-2024</p>
                    <p><span class="text-muted">Terms :</span> Payment On Receipt</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div id="invoice-content" class="pt-2">
                <div class="row">
                    <div class="table-responsive col-sm-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th class="text-xs-left">Rate</th>
                                    <th class="text-xs-left">Qty</th>
                                    <th class="text-xs-left">Tax</th>
                                    <th class="text-xs-left"> Discount</th>
                                    <th class="text-xs-left">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderData['orderItems'] as $index => $orderItem)
                                <tr>
                                    <td scope="row">{{ $index + 1 }}</td>
                                    <td>{{ Illuminate\Support\Str::limit($orderItem['name'], 20) }}</td>
                                    <td>Rs. {{ $orderItem['price'] }}</td>
                                    <td>{{ $orderItem['qty'] }}</td>
                                    <td>18%</td>
                                    <td>{{ intval($orderItem['discount']) }}%</td>
                                    <td>Rs. {{ $orderItem['total'] }}</td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <p></p>
                <div class="row">
                    <div class="col-md-7 col-sm-12 text-xs-center text-md-left">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="lead">Payment Status:
                                    <u><strong id="pstatus">{{ $orderData['order']['status'] }}</strong></u>
                                </p>
                                <p class="lead">Payment Method: <u><strong id="pmethod">Cash</strong></u>
                                </p>
                                <p class="lead mt-1"><br>Note:</p>
                                <code></code>
                                <img src="{{ asset('images/Blue_Simple_Lines_Circular_Monogram_Badge_Logo-removebg-preview.png') }}"
                                    alt="stamp" class="img-responsive p-1 m-b-2" style="max-height: 300px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <p class="lead">Summary</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Total Tax</td>
                                        <td class="text-xs-right"> Rs. {{ $orderData['order']['total_tax'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Discount</td>
                                        <td class="text-xs-right"> Rs. {{ $orderData['order']['discount'] }}</td>
                                    </tr>
                                    <tr>
                                        <td> Shipping</td>
                                        <td class="text-xs-right">$ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td> Sub Total</td>
                                        <td class="text-xs-right">Rs. {{ $orderData['order']['subtotal'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold-800">Total</td>
                                        <td class="text-bold-800 text-xs-right">Rs. {{ $orderData['order']['grand_total'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment status</td>
                                        <td class="pink text-xs-right">
                                            (-) <span id="paymade">{{ $orderData['order']['status'] }}</span></td>
                                    </tr>
                                    <tr class="bg-grey bg-lighten-4">
                                        <td class="text-bold-800">Balance Due</td>
                                        <td class="text-bold-800 text-xs-right"> <span id="paydue">$ 389.74</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-xs-center">
                            <p>Authorized person</p>
                            <img src="{{ asset('images/signature.jpg') }}" alt="signature" class="height-100">
                            <h6>(BusinessOwner)</h6>
                            <p class="text-muted">Business Owner</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/custombox@4.0.3/dist/custombox.min.js"></script>
    <script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>
    

 
 
 
    
</body>
</html> --}}