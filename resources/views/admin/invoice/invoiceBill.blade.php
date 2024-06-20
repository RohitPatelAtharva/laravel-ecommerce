<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Bill</title>
   
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">

    
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
    .exclude-print {
            display: none;

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
        border: 1px solid #03080e;
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
    .exclude-print {
            display: none;

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
    <section class="exclude-print">
        <div class="cord">
            <div class="container my-3">
                <div class="row">

                    <div class="">
                        <div class="title-action">
                            <a href="edit?id=23" class="btn btn-warning mb-1"><i class="fa fa-pencil"></i> Edit
                                Invoice</a>
                            <a href="#part_payment" data-toggle="modal" data-remote="false" data-type="reminder"
                                class="btn btn-large btn-info mb-1" title="Partial Payment"><span
                                    class="fa fa-money"></span> Make
                                Payment </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-facebook dropdown-toggle mb-1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-envelope-o"></span> Email
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#sendEmail" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendbill" data-type="notification">Invoice Notification</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#sendEmail" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendbill" data-type="reminder">Payment Reminder</a>
                                    <a href="#sendEmail" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendbill" data-type="received">Payment Received</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#sendEmail" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendbill" data-type="overdue">Payment Overdue</a><a
                                        href="#sendEmail" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendbill" data-type="refund">Refund Generated</a>
                                </div>
                            </div>
                            <!-- SMS -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-blue dropdown-toggle mb-1" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-mobile"></span> SMS
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#sendSMS" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendsms" data-type="notification">Invoice Notification</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#sendSMS" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendsms" data-type="reminder">Payment Reminder</a>
                                    <a href="#sendSMS" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendsms" data-type="received">Payment Received</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#sendSMS" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendsms" data-type="overdue">Payment Overdue</a><a
                                        href="#sendSMS" data-toggle="modal" data-remote="false"
                                        class="dropdown-item sendsms" data-type="refund">Refund Generated</a>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success mb-1 btn-min-width dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fa fa-print"></i> Print </button>
                                        <div class="dropdown-menu">
                                            <button type="button" class="dropdown-item" onclick="printInvoice()">Print</button>
                                            <div class="dropdown-divider"></div>
                                            <button type="button" class="dropdown-item" onclick="submitForm()">PDF Download</button>
                                        </div>
                            </div>
                            <a href="#" class="btn btn-blue-grey mb-1"><i class="fa fa-globe"></i> Preview </a>
                            <a href="#" data-toggle="modal" data-remote="false"
                                class="btn btn-large btn-cyan mb-1" title="Change Status"><span
                                    class="fa fa-retweet"></span> Change Status</a>
                            <a href="#cancel-bill" class="btn btn-danger mb-1" id="cancel-bill"><i
                                    class="fa fa-minus-circle"></i> Cancel </a>
                            <div class="btn-group ">
                                <button type="button" class="btn btn-primary mb-1 btn-min-width dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="icon-anchor"></i> Extra </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Delivery
                                        Note</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Proforma
                                        Invoice</a>
                                </div>
                            </div>
                            <div class="btn-group ">
                                <button type="button" class="btn btn-vimeo mb-1 btn-md dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="fa fa-print"></i> POS Print </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">PDF Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <form action="{{route('viewPDF')}}"  method="post" target="_blank" id="invoice-generated">
            @csrf
            <section>
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
        
            </section>
        </form>
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/custombox@4.0.3/dist/custombox.min.js"></script>
    <script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/demo.js') }}"></script>
    

    <script>
        function printInvoice() {
        
        console.log("Print invoice function called");
        
        window.print(); 
    }

   

    function submitForm() {
    console.log("Form submitted");
    document.getElementById('invoice-generated').action = "{{route('download-PDF')}}";   
    document.getElementById('invoice-generated').submit();  
}

    
    $.ajax({
    url: "{{ route('download-PDF') }}",  
    type:'post',
    data: $('#invoice-generated').serialize(), 
    success: function(response) {
        console.log("PDF downloaded successfully");
         
    },
    error: function(xhr, status, error) {
        console.error("Error downloading PDF", error);
         
    }
});

    </script>

</body>

</html>
