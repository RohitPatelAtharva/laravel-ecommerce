<!DOCTYPE html>
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
    body {
        font-size: 14px; /* Increase the font size for body */
        width: 100% !important;
        font-size: 20px !important;
    }
    .invoice-box {
        max-width: 100% !important;
        margin: auto;
        padding: 20px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }
    .invoice-title {
        font-size: 3em !important; /* Increase the font size for invoice title */
        font-weight: bold;
        margin-bottom: 20px;
    }
    .table th, .table td {
        border: 1px solid #dee2e6;
        vertical-align: middle;
    }
    .table th {
        background-color: #f8f9fa;
    }
    .total {
        font-size: 1.5em; /* Increase the font size for total */
        font-weight: bold;
    }
    .text-right {
        text-align: right;
    }
    /* Adjust other styles as needed */
}


        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .invoice-header {
            margin-bottom: 20px;
        }
        .invoice-title {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="row invoice-header" >
            <div class="col-sm-6" id="invoice-header">
                <img src="{{ asset('images/Green_White_Minimalist_Aesthetic_Plant_and_Flower_Shop_Logo-removebg-preview (1).png') }}"
                     class="img-responsive" style="max-height: 150px;">
                <p class="ml-2">E-commerce Shopping</p>
            </div>
            <div class="col-sm-6 text-right">
                <h1 class="invoice-title">INVOICE</h1>
                <p>SRN 1009</p>
                <p>Reference:</p>
                <ul class="list-unstyled">
                    <li>Gross Amount</li>
                    <li class="lead text-bold-800">$ 798.40</li>
                </ul>
            </div>
        </div>

        <div class="row invoice-details">
            <div class="col-sm-6">
                <h5>Bill To:</h5>
                <ul class="list-unstyled">
                    <li class="text-bold-800"><a href="#"><strong
                        class="invoice_a">{{ $orderData['order']['first_name'] }}</strong></a></li>
            <li>{{ $orderData['order']['address'] }}</li>
            <li>{{ $orderData['order']['city'] }}</li>
            <li>{{ $orderData['order']['zip'] }}</li>
            <li>{{ $orderData['order']['mobile'] }}</li>
            <li>{{ $orderData['order']['email'] }}</li>
                </ul>
            </div>
            <div class="col-sm-6 text-right">
                <h5>Invoice Details:</h5>
                <p><span class="text-muted">Invoice Date:</span> 24-05-2024</p>
                <p><span class="text-muted">Due Date:</span> 24-05-2024</p>
                <p><span class="text-muted">Terms:</span> Payment On Receipt</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th class="text-right">Rate</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Tax</th>
                        <th class="text-right">Discount</th>
                        <th class="text-right">Amount</th>
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

        <div class="row invoice-summary">
            <div class="col-sm-7 text-center text-md-left">
                <div>
                    <p class="lead">Payment Status:
                        <u><strong id="pstatus">{{ $orderData['order']['status'] }}</strong></u>
                    </p>
                    <p class="lead">Payment Method: <u><strong id="pmethod">Cash</strong></u></p>
                    <p class="lead mt-1"><br>Note:</p>
                    <img src="{{ asset('images/Blue_Simple_Lines_Circular_Monogram_Badge_Logo-removebg-preview.png') }}" alt="stamp"
                         class="img-responsive p-1 m-b-2" style="max-height: 200px;">
                </div>
            </div>
            <div class="col-sm-5">
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
                                <td class="text-bold-800 text-xs-right">Rs.
                                    {{ $orderData['order']['grand_total'] }}</td>
                            </tr>
                            <tr>
                                <td>Payment status</td>
                                <td class="pink text-xs-right">
                                    (-) <span id="paymade">{{ $orderData['order']['status'] }}</span>
                                </td>
                            </tr>
                            <tr class="bg-grey bg-lighten-4">
                                <td class="text-bold-800">Balance Due</td>
                                <td class="text-bold-800 text-xs-right"> <span id="paydue">$
                                        389.74</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <p>Authorized person</p>
                    <img src="{{ asset('images/signature.jpg') }}" alt="signature" class="height-100">
                    <h6>(Business Owner)</h6>
                    <p class="text-muted">Business Owner</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
