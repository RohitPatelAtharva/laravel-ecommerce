@extends('Front.app')
@section('content')

    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                        <li class="breadcrumb-item">Cart</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-9 pt-4">
            <div class="container">
                <div class="row">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="messageContainer">
                        <!-- Message will be inserted here -->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                     <div class="col-md-8">
                        <div class="table-responsive">
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
                                    @if (!empty($cartContent))
                                        @foreach ($cartContent as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('admin-assets/products_img/' . $item->options->image) }}"
                                                            alt="Product Image">
                                                        <h2>{{ Illuminate\Support\Str::limit($item->name, 10) }}</h2>
                                                    </div>
                                                </td>
                                                <td id="price-{{ $item->rowId }}">Rs. {{ $item->price }}</td>
                                                <td>
                                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub"
                                                                data-rowid="{{ $item->rowId }}">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" id="qty-{{ $item->rowId }}"
                                                            class="form-control form-control-sm border-0 text-center quantity-input"
                                                            value="{{ $item->qty }}" data-rowid="{{ $item->rowId }}">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add"
                                                                data-rowid="{{ $item->rowId }}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="total-price-{{ $item->rowId }}">
                                                    Rs. {{ number_format($item->price * $item->qty, 2) }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="deleteCartItem('{{ $item->rowId }}')">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card cart-summery">
                            <div class="sub-title">
                                <h2 class="bg-white">Cart Summery</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Subtotal</div>
                                    <div id="subtotal">
                                        Rs. {{ Cart::subtotal() }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Shipping</div>
                                    <div>Rs. 20</div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div>Total</div>
                                    <div id="total">
                                        Rs. {{ Cart::subtotal() }}
                                    </div>
                                </div>
                                <div class="pt-5">
                                    <a href="login.php" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                        <div class="input-group apply-coupan mt-4">
                            <input type="text" placeholder="Coupon Code" class="form-control">
                            <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
{{-- @section('customjs')
    <script>
        //  quntity to product are here
        $('.add').click(function() {
            var qtyElement = $(this).parent().prev(); // Qty Input
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue < 10) {
                var rowId = $(this).data('id'); // Get rowId from data attribute
                var newQty = qtyValue + 1; // Increment the quantity
                qtyElement.val(newQty); // Update the input field value
                updateCart(rowId, newQty); // Update cart with incremented quantity
            }
        });

        $('.sub').click(function() {
            var qtyElement = $(this).parent().next();
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue > 1) {
                var rowId = $(this).data('id'); // Get rowId from data attribute
                var newQty = qtyValue - 1; // Decrement the quantity
                qtyElement.val(newQty); // Update the input field value
                updateCart(rowId, newQty); // Update cart with decremented quantity
            }
        });

        function updateCart(rowId, qty) {
            $.ajax({
                url: '{{ route('front.updateCart') }}',
                type: 'post',
                data: {
                    rowId: rowId,
                    qty: qty
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        // Do not redirect, just update the totals
                        updateCartSummary();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        }
        // delete cart here
        function deleteCartItem(rowId) {
            $.ajax({
                url: '{{ route('cart.deleteItem', ':rowId') }}'.replace(':rowId', rowId),
                type: 'DELETE',
                success: function(response) {
                    console.log(response);
                    // Reload the page after successful deletion
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        }
    </script>
@endsection --}}
{{-- @section('content')
    <main>
        <section class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($cartContent))
                                            @foreach ($cartContent as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <img src="{{ asset('admin-assets/products_img/' . $item->options->image) }}" alt="Product Image"> 
                                                            <h2>{{ Illuminate\Support\Str::limit($item->name, 10) }}</h2>
                                                        </div>
                                                    </td>
                                                    <td id="price-{{ $item->rowId }}">Rs. {{ $item->price }}</td>
                                                    <td>
                                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                                            <div class="input-group-btn">
                                                                <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-rowid="{{ $item->rowId }}">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" id="qty-{{ $item->rowId }}"
                                                                class="form-control form-control-sm border-0 text-center quantity-input"
                                                                value="{{ $item->qty }}" data-rowid="{{ $item->rowId }}">
                                                            <div class="input-group-btn">
                                                                <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-rowid="{{ $item->rowId }}">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id="total-price-{{ $item->rowId }}">
                                                        Rs. {{ number_format($item->price * $item->qty, 2) }}
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="deleteCartItem('{{ $item->rowId }}')">
                                                            <i class="fa fa-times"></i> 
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card cart-summery">
                            <div class="sub-title">
                                <h2 class="bg-white">Cart Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Subtotal</div>
                                    <div id="subtotal">
                                        Rs. {{ Cart::subtotal() }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <div>Shipping</div>
                                    <div>$20</div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div>Total</div>
                                    <div id="total">
                                        Rs. {{ Cart::subtotal() }}
                                    </div>
                                </div>
                                <div class="pt-5">
                                    <a href="login.php" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                        <div class="input-group apply-coupan mt-4">
                            <input type="text" placeholder="Coupon Code" class="form-control">
                            <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection --}}

@section('customjs')
    <script>
        $('.add').click(function() {
            var qtyElement = $(this).parent().prev(); // Qty Input
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue < 10) {
                var rowId = $(this).data('rowid'); // Get rowId from data attribute
                var newQty = qtyValue + 1; // Increment the quantity
                qtyElement.val(newQty); // Update the input field value
                updateCart(rowId, newQty); // Update cart with incremented quantity
            }
        });

        $('.sub').click(function() {
            var qtyElement = $(this).parent().next();
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue > 1) {
                var rowId = $(this).data('rowid'); // Get rowId from data attribute
                var newQty = qtyValue - 1; // Decrement the quantity
                qtyElement.val(newQty); // Update the input field value
                updateCart(rowId, newQty); // Update cart with decremented quantity
            }
        });

        function updateCart(rowId, qty) {
    $.ajax({
        url: '{{ route('front.updateCart') }}',
        type: 'post',
        data: {
            rowId: rowId,
            qty: qty
        },
        dataType: 'json',
        success: function(response) {
            if (response.status == true) {
                // Do not redirect, just update the totals
                updateTotalPrice(rowId);
                updateCartSummary();
            } else {
                // Show error message
                showMessage(response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error
        }
    });
}

        function updateTotalPrice(rowId) {
            var qty = parseInt($('#qty-' + rowId).val());
            var price = parseFloat($('#price-' + rowId).text().replace('Rs. ', ''));
            var total = qty * price;
            $('#total-price-' + rowId).text('Rs. ' + total.toFixed(2));
        }
        function showMessage(message, type) {
    var alertClass = 'alert-info'; // default to info style
    if (type === 'success') {
        alertClass = 'alert-success';
    } else if (type === 'error') {
        alertClass = 'alert-danger';
    }
    var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                        '<strong>' + message + '</strong>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                    '</div>';
    // Insert the message before the cart summary
    $('#cartSummary').before(alertHtml);
}



        function updateCartSummary() {
            $.ajax({
                url: '{{ route('front.getCartSummary') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var subtotal = parseFloat(response.subtotal.replace('Rs. ', '')); // Get subtotal
                    var deliveryCharge = 20; // Assuming fixed delivery charge
                    var totalAmount = subtotal + deliveryCharge; // Calculate total amount
                    $('#subtotal').text('Rs. ' + subtotal.toFixed(2));
                    $('#delivery').text('Rs. ' + deliveryCharge.toFixed(2)); // Update delivery charge
                    $('#total').text('Rs. ' + totalAmount.toFixed(2)); // Update total amount in cart summary
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        }

        // delete cart here
        function deleteCartItem(rowId) {
            $.ajax({
                url: '{{ route('cart.deleteItem', ':rowId') }}'.replace(':rowId', rowId),
                type: 'DELETE',
                success: function(response) {
                    console.log(response);
                    // Reload the page after successful deletion
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        }
    </script>
@endsection








if (selectedOption === "1") {
    $.ajax({
        url: "{{route('top.getCetegory')}}",
        type: "GET",
        success: function(response) {
            var categoryOptions = "<label for='categoryOptions'>Category:</label>" +
                "<select id='categoryOptions' class='form-control'>";
            $.each(response.categories, function(index, category) {
                categoryOptions += "<option value='" + category.id + "'>" + category.name +
                    "</option>";
            });
            categoryOptions += "</select>";
            dynamicOptionsDiv.innerHTML = categoryOptions;

            // Show dynamic options div after appending options
            dynamicOptionsDiv.style.display = "block";
        }
    });
} else if (selectedOption === "2") {
    // AJAX request for products...
} else if (selectedOption === "3") {
    // AJAX request for tags...
}






(selectedOption === "3") {
    $.ajax({
        url: "{{route('top.getTags')}}", // Server-side endpoint to fetch tags
        type: "GET",
        success: function(response) {
            // Populate tags
            var tagOptions = "<label for='tagOptions'>Tag:</label>" +
                "<select id='tagOptions' class='form-control'>";
            $.each(response.tags, function(index, tag) {
                tagOptions += "<option value='" + tag.id + "'>" + tag.name + "</option>";
            });
            tagOptions += "</select>";
            $('#dynamicOptionsDiv').append(tagOptions); // Append to dynamic options div
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log error message
        }
    });
}


(selectedOption === "2") {
    $.ajax({
        url: "{{route('top.getProducts')}}", // Server-side endpoint to fetch products
        type: "GET",
        success: function(response) {
            // Populate products
            var productOptions = "<label for='productOptions'>Product:</label>" +
                "<select id='productOptions' class='form-control'>";
            $.each(response.products, function(index, product) {
                productOptions += "<option value='" + product.id + "'>" + product.title +
                    "</option>";
            });
            productOptions += "</select>";
            $('#dynamicOptionsDiv').append(productOptions); // Append to dynamic options div
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log error message
        }
    });
}
<select class="form-control round" onchange="changeTaxFormat(this.value)" id="taxformat">

    <option value="yes" data-tformat="yes" selected="">»On</option><option value="yes" data-tformat="yes">On</option>
    <option value="inclusive" data-tformat="incl">Inclusive</option>
    <option value="off" data-tformat="off">Off</option>
    <option value="yes" data-tformat="cgst">CGST + SGST</option>
    <option value="yes" data-tformat="igst">IGST</option> <option value="inclusive" data-tformat="inclusive" data-trate="10">Custom 10% Inclusive</option> <option value="yes" data-tformat="cgst" data-trate="12">CGST 6% + SGST 6% Exclusive</option> <option value="yes" data-tformat="yes" data-trate="20">VAT 20% Exclusive</option>                                         </select>














    <input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="Any" style="width: 453.083px;">




    <select class="select2 select2-hidden-accessible" multiple="" data-placeholder="Any" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
        <option data-select2-id="11">Text only</option>
        <option data-select2-id="12">Images</option>
        <option data-select2-id="13">Video</option>
        </select>




        <div class="frmSearch col-sm-12"><label for="cst" class="caption">Search Client</label>
            <input type="text" class="form-control round" name="cst" id="customer-box" <input="" placeholder="Enter Customer Name or Mobile Number to search" autocomplete="off" style="background: none;">
            <div id="customer-box-result" style=""></div>
        </div>


        <div id="customerpanel" class="inner-cmp-pnl">
            <div class="form-group row">
                <div class="fcol-sm-12">
                    <h3 class="title">
                         Bill To <a href="#" class="btn btn-primary btn-sm round" data-toggle="modal" data-target="#addCustomer">
                            Add Client                                            </a>
                </h3></div>
            </div>
            <div class="form-group row">
                <div class="frmSearch col-sm-12"><label for="cst" class="caption">Search Client</label>
                    <input type="text" class="form-control round" name="cst" id="customer-box" <input="" placeholder="Enter Customer Name or Mobile Number to search" autocomplete="off" style="background: none;">
                    <div id="customer-box-result" style=""></div>
                </div>
            </div>
            <div id="customer">
                <div class="clientinfo">
                     Client Details                                        <hr>
                    <input type="hidden" name="customer_id" id="customer_id" value="9">
                    <div id="customer_name"><strong>Kimmie Hames </strong></div>
                </div>
                <div class="clientinfo">
                    <div id="customer_address1"><strong>0881 American Ash Center<br>Irvine</strong></div>
                </div>

                <div class="clientinfo">

                    <div id="customer_phone">Phone: <strong>949-853-3749</strong><br>Email: <strong>khames8@businesswire.com</strong></div>
                </div>
                <hr>
                <div id="customer_pass"></div>Warehouse <select id="s_warehouses" class="form-control round">
                    <option value="0">*All</option><option value="0">All</option><option value="1">Main WareHouse</option><option value="2">France</option><option value="3">China</option><option value="4">Croatia</option><option value="5">Albania</option><option value="6">Bulgaria</option><option value="7">Japan</option><option value="8">Guatemala</option><option value="9">USA</option><option value="10">UK</option><option value="11">USA</option>
                </select>
            </div>


        </div>




        <div id="customerpanel" class="inner-cmp-pnl">
            <div class="form-group row">
                <div class="fcol-sm-12">
                    <h3 class="title">
                         Bill To <a href="#" class="btn btn-primary btn-sm round" data-toggle="modal" data-target="#addCustomer">
                            Add Client                                            </a>
                </h3></div>
            </div>
            <div class="form-group row">
                <div class="frmSearch col-sm-12"><label for="cst" class="caption">Search Client</label>
                    <input type="text" class="form-control round" name="cst" id="customer-box" <input="" placeholder="Enter Customer Name or Mobile Number to search" autocomplete="off" style="background: none;">
                    <div id="customer-box-result" style=""></div>
                </div>
            </div>
            <div id="customer">
                <div class="clientinfo">
                     Client Details                                        <hr>
                    <input type="hidden" name="customer_id" id="customer_id" value="9">
                    <div id="customer_name"><strong>Kimmie Hames </strong></div>
                </div>
                <div class="clientinfo">
                    <div id="customer_address1"><strong>0881 American Ash Center<br>Irvine</strong></div>
                </div>

                <div class="clientinfo">

                    <div id="customer_phone">Phone: <strong>949-853-3749</strong><br>Email: <strong>khames8@businesswire.com</strong></div>
                </div>
                <hr>
                <div id="customer_pass"></div>Warehouse <select id="s_warehouses" class="form-control round">
                    <option value="0">*All</option><option value="0">All</option><option value="1">Main WareHouse</option><option value="2">France</option><option value="3">China</option><option value="4">Croatia</option><option value="5">Albania</option><option value="6">Bulgaria</option><option value="7">Japan</option><option value="8">Guatemala</option><option value="9">USA</option><option value="10">UK</option><option value="11">USA</option>
                </select>
            </div>


        </div><div id="customerpanel" class="inner-cmp-pnl">
            <div class="form-group row">
                <div class="fcol-sm-12">
                    <h3 class="title">
                         Bill To <a href="#" class="btn btn-primary btn-sm round" data-toggle="modal" data-target="#addCustomer">
                            Add Client                                            </a>
                </h3></div>
            </div>
            <div class="form-group row">
                <div class="frmSearch col-sm-12"><label for="cst" class="caption">Search Client</label>
                    <input type="text" class="form-control round" name="cst" id="customer-box" <input="" placeholder="Enter Customer Name or Mobile Number to search" autocomplete="off" style="background: none;">
                    <div id="customer-box-result" style=""></div>
                </div>
            </div>
            <div id="customer">
                <div class="clientinfo">
                     Client Details                                        <hr>
                    <input type="hidden" name="customer_id" id="customer_id" value="9">
                    <div id="customer_name"><strong>Kimmie Hames </strong></div>
                </div>
                <div class="clientinfo">
                    <div id="customer_address1"><strong>0881 American Ash Center<br>Irvine</strong></div>
                </div>

                <div class="clientinfo">

                    <div id="customer_phone">Phone: <strong>949-853-3749</strong><br>Email: <strong>khames8@businesswire.com</strong></div>
                </div>
                <hr>
                <div id="customer_pass"></div>Warehouse <select id="s_warehouses" class="form-control round">
                    <option value="0">*All</option><option value="0">All</option><option value="1">Main WareHouse</option><option value="2">France</option><option value="3">China</option><option value="4">Croatia</option><option value="5">Albania</option><option value="6">Bulgaria</option><option value="7">Japan</option><option value="8">Guatemala</option><option value="9">USA</option><option value="10">UK</option><option value="11">USA</option>
                </select>
            </div>


        </div>









        $(document).ready(function() {
            // Fetch products and populate the select element
            $.ajax({
                url: '{{ route('get.products') }}',
                method: 'GET',
                success: function(response) {
                    var productSelect = $('.productSelect');
                    productSelect.empty(); // Clear previous options
                    response.forEach(function(product) {
                        // Create an option element for each product
                        var option = $('<option></option>').attr('value', product.id).text(product.title);
                        productSelect.append(option); // Append the option to the select element
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching products:', error);
                }
            });
        });





        public function getBill()
        {
            $order = Order::with('orderItems')
                                 ->latest('created_at')
                                 ->first();
        
             
                        
        
            // If no order found, handle the scenario gracefully
            // if ( $order->isEmpty()) {
            //     return redirect()->back()->with('error', 'No order items found.');
            // }
           
        
            // Pass the invoice data to the view
            return view('admin.invoice.invoiceBill', compact('order'));
        }












        $(document).ready(function() {
            // Function to fetch products and populate the select element
            function fetchProductsAndPopulateSelect(selectElement) {
                $.ajax({
                    url: '{{ route("get.products") }}',
                    method: 'GET',
                    success: function(response) {
                        selectElement.empty(); // Clear previous options
                        // Append the "Select product" option first
                        selectElement.append('<option value="">Select product</option>');
                        // Append the options for each product
                        response.forEach(function(product) {
                            var option = $('<option></option>').attr('value', product.id).text(product.title);
                            option.data('price', product.price); // Store product price
                            option.data('quantity', product.qty); // Store product quantity
                            selectElement.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching products:', error);
                    }
                });
            }
        
            fetchProductsAndPopulateSelect($('.productSelect'));
        
            // Call fetchProductsAndPopulateSelect when clicking the "Add Row" button
            $(document).on('click', '#addproduct', function() {
                var newRow = `
                    <tr>
                        <td>
                            <select name="selectedProduct" class="form-control productSelect">
                                <option value="">Select product</option>
                                <!-- Product options will be populated dynamically -->
                            </select>
                        </td>
                        <td><input type="text" class="form-control productQuantity" value="1" name="new_Qty"></td>
                        <td><input type="text" class="form-control productPrice" readonly></td>
                        <td><input readonly type="text" class="form-control" value="18%"></td>
                        <td><input type="text" class="form-control discount" value="0"></td>
                        <td><span class="currenty">Rs </span><strong><span class="amount">0.00</span></strong></td>
                        <td class="text-center"><button type="button" class="btn btn-danger remove-product"><i class="fa fa-trash"></i></button></td>
                    </tr>
                `;
                $('#invoiceForm tbody tr:last').before(newRow);
        
                // Fetch products and populate the newly added row's select element
                fetchProductsAndPopulateSelect($('#invoiceForm tbody tr:last').prev().find('.productSelect'));
            });
        
            // Handle change event when a product is selected
            $(document).on('change', '.productSelect', function() {
                var selectedOption = $(this).find(':selected');
                var price = selectedOption.data('price');
                var quantity = selectedOption.data('quantity'); // Get the quantity of the selected product
        
                // Update the price input field with the selected product's price
                var row = $(this).closest('tr');
                row.find('.productPrice').val(price);
        
                // Display default quantity of 1
                row.find('.productQuantity').val(1);
        
                // Update the row amount based on the new quantity and price
                updateRowAmount(row);
            });
        
            $(document).on('input', '.productQuantity, .discount', function() {
                var row = $(this).closest('tr');
                updateRowAmount(row);
            });
        
            // Handle click event for remove product button
            $(document).on('click', '.remove-product', function() {
                $(this).closest('tr').remove();
                updateTotals();
            });
        
            // Function to update row amount
            function updateRowAmount(row) {
                var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
                var price = parseFloat(row.find('.productPrice').val()) || 0;
                var discountPercent = parseFloat(row.find('.discount').val()) || 0;
        
                // Get the available quantity of the selected product
                var availableQuantity = parseFloat(row.find('.productSelect :selected').data('quantity')) || 0;
        
                // Display an alert if the user input exceeds the available quantity
                if (quantity > availableQuantity) {
                    alert('Quantity cannot exceed available quantity: ' + availableQuantity);
                    // Reset quantity to available quantity
                    row.find('.productQuantity').val(availableQuantity);
                    quantity = availableQuantity; // Update quantity value
                }
        
                // Calculate the amount before discount
                var amountBeforeDiscount = quantity * price;
        
                // Calculate the discount amount
                var discountAmount = (amountBeforeDiscount * discountPercent) / 100;
        
                // Calculate the discounted amount
                var discountedAmount = amountBeforeDiscount - discountAmount;
        
                // Calculate GST (18%)
                var tax = 0.18 * discountedAmount;
        
                // Calculate total amount including GST
                var amount = discountedAmount + tax;
        
                row.find('.amount').text(amount.toFixed(2));
        
                updateTotals();
            }
        
            // Function to update totals
            function updateTotals() {
                var totalTax = 0;
                var totalDiscount = 0;
                var grandTotal = 0;
        
                $('#invoiceForm tbody tr').each(function() {
                    var row = $(this);
                    var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
                    var price = parseFloat(row.find('.productPrice').val()) || 0;
                    var discount = parseFloat(row.find('.discount').val()) || 0;
        
                    // Calculate the amount before discount
                    var amountBeforeDiscount = quantity * price;
        
                    // Apply discount
                    var discountedAmount = amountBeforeDiscount - discount;
        
                    // Calculate GST (18%)
                    var tax = 0.18 * discountedAmount;
        
                    // Calculate total amount including GST
                    var amount = discountedAmount + tax;
        
                    totalTax += tax;
                    totalDiscount += discount;
                    grandTotal += amount;
                });
        
                $('#totalTax').text(totalTax.toFixed(2));
                $('#totalDiscount').text(totalDiscount.toFixed(2));
                $('#invoiceyoghtml').val(grandTotal.toFixed(2));
            }
        });



        $(newRow).insertBefore('#invoiceForm tbody .last-item-row');









        


















        $(document).ready(function() {
            // Function to fetch products and populate the select element
            function fetchProductsAndPopulateSelect(selectElement) {
                $.ajax({
                    url: '{{ route('get.products') }}',
                    method: 'GET',
                    success: function(response) {
                        selectElement.empty(); // Clear previous options
                        // Append the "Select product" option first
                        selectElement.append('<option value="">Select product</option>');
                        // Append the options for each product
                        response.forEach(function(product) {
                            var option = $('<option></option>').attr('value', product.id).text(
                                product.title);
                            option.data('price', product.price); // Store product price
                            option.data('quantity', product.qty); // Store product quantity
                            selectElement.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching products:', error);
                    }
                });
            }

            // Call fetchProductsAndPopulateSelect for the initial row
            fetchProductsAndPopulateSelect($('.productSelect'));

            // Keep track of the last inserted row
            let lastInsertedRow = $('#invoiceForm tbody tr:first');

            // Call fetchProductsAndPopulateSelect when clicking the "Add Row" button
            $(document).on('click', '#addproduct', function() {
                var newRow = `
            <tr>
                <td>
                    <select name="selectedProduct" class="form-control productSelect">
                        <option value="">Select product</option>
                        <!-- Product options will be populated dynamically -->
                    </select>
                </td>
                <td><input type="text" class="form-control productQuantity" value="1" name="new_Qty"></td>
                <td><input type="text" class="form-control productPrice" readonly></td>
                <td><input readonly type="text" class="form-control" value="18%"></td>
                <td><input type="text" class="form-control discount" value="0"></td>
                <td><span class="currenty">Rs </span><strong><span class="amount">0.00</span></strong></td>
                <td class="text-center"><button type="button" class="btn btn-danger remove-product"><i class="fa fa-trash"></i></button></td>
            </tr>
        `;
                // Insert the new row after the last inserted row
                $(newRow).insertAfter(lastInsertedRow);

                // Update lastInsertedRow to the newly added row
                lastInsertedRow = lastInsertedRow.next();

                // Fetch products and populate the newly added row's select element
                fetchProductsAndPopulateSelect(lastInsertedRow.find('.productSelect'));
            });

            // Handle change event when a product is selected
            $(document).on('change', '.productSelect', function() {
                var selectedOption = $(this).find(':selected');
                var price = selectedOption.data('price');
                var quantity = selectedOption.data('quantity'); // Get the quantity of the selected product

                // Update the price input field with the selected product's price
                var row = $(this).closest('tr');
                row.find('.productPrice').val(price);

                // Display default quantity of 1
                row.find('.productQuantity').val(1);

                // Update the row amount based on the new quantity and price
                updateRowAmount(row);
            });

            $(document).on('input', '.productQuantity, .discount', function() {
                var row = $(this).closest('tr');
                updateRowAmount(row);
            });

            // Handle click event for remove product button
            $(document).on('click', '.remove-product', function() {
                var row = $(this).closest('tr');
                // Update lastInsertedRow if the removed row was the last inserted
                if (row.is(lastInsertedRow)) {
                    lastInsertedRow = row.prev();
                }
                row.remove();
                updateTotals();
            });

            // Function to update row amount
            function updateRowAmount(row) {
                var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
                var price = parseFloat(row.find('.productPrice').val()) || 0;
                var discountPercent = parseFloat(row.find('.discount').val()) || 0;

                // Get the available quantity of the selected product
                var availableQuantity = parseFloat(row.find('.productSelect :selected').data('quantity')) || 0;

                // Display an alert if the user input exceeds the available quantity
                if (quantity > availableQuantity) {
                    alert('Quantity cannot exceed available quantity: ' + availableQuantity);
                    // Reset quantity to available quantity
                    row.find('.productQuantity').val(availableQuantity);
                    quantity = availableQuantity; // Update quantity value
                }

                // Calculate the amount before discount
                var amountBeforeDiscount = quantity * price;

                // Calculate the discount amount
                var discountAmount = (amountBeforeDiscount * discountPercent) / 100;

                // Calculate the discounted amount
                var discountedAmount = amountBeforeDiscount - discountAmount;

                // Calculate GST (18%)
                var tax = 0.18 * discountedAmount;

                // Calculate total amount including GST
                var amount = discountedAmount + tax;

                row.find('.amount').text(amount.toFixed(2));

                updateTotals();
            }

            // Function to update totals
            function updateTotals() {
                var totalTax = 0;
                var totalDiscount = 0;
                var grandTotal = 0;

                $('#invoiceForm tbody tr').each(function() {
                    var row = $(this);
                    var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
                    var price = parseFloat(row.find('.productPrice').val()) || 0;
                    var discount = parseFloat(row.find('.discount').val()) || 0;

                    // Calculate the amount before discount
                    var amountBeforeDiscount = quantity * price;

                    // Apply discount
                    var discountedAmount = amountBeforeDiscount - discount;

                    // Calculate GST (18%)
                    var tax = 0.18 * discountedAmount;

                    // Calculate total amount including GST
                    var amount = discountedAmount + tax;

                    totalTax += tax;
                    totalDiscount += discount;
                    grandTotal += amount;
                });

                $('#totalTax').text(totalTax.toFixed(2));
                $('#totalDiscount').text(totalDiscount.toFixed(2));
                $('#invoiceyoghtml').val(grandTotal.toFixed(2));
            }
        });









































        <form id="invoiceForm" action="{{route('store.order')}}"   method="POST" >
            @csrf
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label for="searchInput">Search client</label>
                            <div class="input-group">
                                <input type="search" class="form-control" id="searchInput" placeholder="Search...">

                            </div>
                            <div id="results" class="result-container"></div>
                            <div class="customer_detail">
                                <label for="client">Client Detail</label>
                                <p id="clientName"></p>
                                <p id="clientAddress"></p>
                                <p><span>Phone</span>: <span id="clientPhone"></span></p>
                                <p><span>Email</span>: <span id="clientEmail"></span></p>
                                <p id="clientCountry"></p>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-md-9 mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="apply_discount">
                                    <label for="taxformat">Tax</label>
                                    <div class="input-group">
                                        <select class="form-control round" id="taxformat">
                                            <option value="yes" data-tformat="yes" selected>»On</option>
                                            <option value="inclusive" data-tformat="incl">Inclusive</option>
                                            <option value="off" data-tformat="off">Off</option>
                                            <option value="yes" data-tformat="cgst">CGST + SGST</option>
                                            <option value="yes" data-tformat="igst">IGST</option>
                                            <option value="inclusive" data-tformat="inclusive" data-trate="10">Custom 10%
                                                Inclusive</option>
                                            <option selected value="yes" data-tformat="cgst" data-trate="12">CGST 9% + SGST 9%
                                                Exclusive</option>
                                            <option value="yes" data-tformat="yes" data-trate="20">VAT 20% Exclusive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="apply_discount">
                                    <label for="invoiceDate">Invoice Date</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="invoiceDate" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="apply_discount">
                                    <label for="dueDate">Due Date</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="dueDate" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        
            <section type="2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 card">
                            <table class="table-responsive tfr my_stripe">
                                <thead class="bg-info">
                                    <tr class="item_header bg-gradient-directional-blue white">
                                        <th width="30%" class="text-center">Item Name</th>
                                        <th width="8%" class="text-center">Quantity</th>
                                        <th width="10%" class="text-center">Rate</th>
                                        <th width="10%" class="text-center">Tax(%)</th>
                                        <th width="7%" class="text-center">Discount</th>
                                        <th width="10%" class="text-center">Amount (Rs)</th>
                                        <th width="5%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="selectedProduct[]" class="form-control productSelect">
                                                <option value="">Select product</option>
                                                <!-- Product options will be populated dynamically -->
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control productQuantity" value="1" name="new_Qty[]"></td>
                                        <td><input type="text" class="form-control productPrice" readonly></td>
                                        <td><input readonly type="text" class="form-control" value="18%"></td>
                                        <td><input type="text" class="form-control discount" value="0"></td>
                                        <td><span class="currenty">Rs </span><strong><span class="amount">0.00</span></strong></td>
                                        <td class="text-center"><button type="button" class="btn btn-danger remove-product"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                    <tr class="last-item-row sub_c">
                                        <td class="add-row">
                                            <button type="button" class="btn btn-success" id="addproduct">
                                                <i class="fa fa-plus-square"></i> Add Row
                                            </button>
                                        </td>
                                        <td colspan="6"></td>
                                    </tr>
                                    <tr class="sub_c">
                                        <td colspan="5" class="reverse_align"><strong>Total Tax</strong></td>
                                        <td align="left" colspan="2">
                                            <span class="currenty lightMode">Rs</span>
                                            <span id="totalTax" class="lightMode">0.00</span>
                                        </td>
                                    </tr>
                                    <tr class="sub_c">
                                        <td colspan="5" class="reverse_align"><strong>Total Discount</strong></td>
                                        <td align="left" colspan="2">
                                            <span class="currenty lightMode">Rs</span>
                                            <span id="totalDiscount" class="lightMode">0.00</span>
                                        </td>
                                    </tr>
                                    <tr class="sub_c">
                                        <td colspan="5" class="reverse_align"><strong>Extra Discount</strong></td>
                                        <td align="left" colspan="2">
                                            <input type="text" class="form-control form-control-sm discVal" id="extraDiscount" value="0" name="extraDiscount">
                                            <input type="hidden" name="Finaldiscount" id="after_disc" value="0">
                                            ( Rs <span id="disc_final">0</span> )
                                        </td>
                                    </tr>
                                    <tr class="sub_c">
                                        <td colspan="2"><br>Payment Currency for your client <small>based on live market</small>
                                            <select name="payment_mode" class="selectpicker form-control">
                                                <option value="cash">Cash</option>
                                                <option value="ATM/DEBIT/CREDIT">ATM/DEBIT/CREDIT</option>
                                                <option value="Net Banking">Net Banking</option>
                                                <option value="UPI">UPI</option>
                                            </select>
                                        </td>
                                        <td colspan="3" class="reverse_align"><strong>Grand Total (<span class="currenty lightMode">Rs</span>)</strong></td>
                                        <td align="left" colspan="2"><input type="text" name="grandtotal" class="form-control" id="invoiceyoghtml" readonly></td>
                                    </tr>
                                    <tr class="sub_c">
                                        <td colspan="2">Payment Terms
                                            <select name="pterms" class="selectpicker form-control">
                                                <option value="1">Paid</option>
                                                <option value="0">Unpaid</option>
                                            </select>
                                        </td>
                                        <td class="reverse_align" colspan="6"><button type="submit" class="btn btn-success sub-btn btn-lg" id="submit-data">Generate Invoice</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </form>



        <form action="{{route('view-pdf')}}" method="post" target="_blank">
            @csrf
            <button class="btn-lg btn-success"></button>
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
                                        {{-- <tr>
                                            <td colspan="5"></td>
                                        </tr> --}}
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










        <form action="{{route('download-PDF')}}" method="post" target="_blank">
            @csrf
            <button class="btn-lg btn-success"></button>
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
                                        {{-- <tr>
                                            <td colspan="5"></td>
                                        </tr> --}}
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








        try{// Create a new order
            $order = new Order();
            $order->user_id = $request->client_id; // Assuming you have the client_id
            $order->discount = $request->extraDiscount;
            $order->grand_total = $request->grandtotal;
            
            $order->first_name = $request->client_name;
            $order->email = $request->client_email;
            $order->mobile = $request->client_phone;
            $order->address = $request->client_address;
            $order->city = $request->client_city;
            $order->zip = $request->client_zip;
         
            $order->save(); 
            foreach ($request->selectedProduct as $index => $productId) {
                $quantity = $request->new_Qty[$index];
                $discount = floatval($request->discount[$index]);
                $product = Product::find($productId);  
            
                // Retrieve the discount value from the request
                
            
        
                // Calculate the amount before discount
                $amountBeforeDiscount = (($product->price * $quantity)+($product->price * $quantity)*0.18);
                
                // Calculate the discount amount
                $discountAmount = ($amountBeforeDiscount * $discount) / 100;
                 
                // Calculate the discounted amount
                $discountedAmount = $amountBeforeDiscount - $discountAmount;
                
                // Calculate tax
                // $tax =  $discountedAmount;
                
                // Calculate the total amount
                $totalAmount = $discountedAmount;
            
                // Round the total amount to 2 decimal places
                $totalAmount = round($totalAmount, 2);
            
                // Create and save the order item
                $orderItem = new Order_item();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $productId;
                $orderItem->name = $product->title;
                $orderItem->qty = $quantity;
                $orderItem->price = $product->price;
                $orderItem->total = $totalAmount;    
                $orderItem->save();
            }





















            {{-- ugfygyffguyjhjhjh --}}



            <form id="OrderForm" name="OrderForm" action="" method="post">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="sub-title">
                                <h2>Shipping Address</h2>
                            </div>
                            <div class="card shadow-lg border-0">
                                <div class="card-body checkout-form">
                                    <div class="address-card">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="selected_address_1" name="selected_address" class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="selected_address_1"></label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0 mr-2">
                                                        ROHIT PATEL
                                                    </h5>
                                                    <span class="badge badge-home">HOME</span>
                                                </div>
                                                <p class="mb-0">
                                                    Rajatalab, odar<br>
                                                    Varanasi, Uttar Pradesh - 221311
                                                </p>
                                                <p class="mb-0">
                                                    <strong>Mobile:</strong> 9696573419
                                                </p>
                                                <p class="mb-0 text-muted">
                                                    • Pay on Delivery available
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-outline-danger btn-sm" data-action="remove">Remove</button>
                                                <button class="btn btn-outline-primary btn-sm" data-action="showModal">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="sub-title">
                                <h2>Order Summary</h2>
                            </div>
                            <div class="card cart-summary">
                                <div class="card-body">
                                    @if (!empty($cartItems))
                                    @foreach ($cartItems as $item)
                                    <div class="d-flex justify-content-between pb-2">
                                        <div class="h6">{{ Illuminate\Support\Str::limit($item->title, 20) }} x
                                            {{ $item->quantity }}</div>
                                        <div class="h6">Rs. {{ $item->price * $item->quantity }}</div>
                                    </div>
                                    @endforeach
                                    @endif
            
                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Subtotal</strong></div>
                                        <div class="h6"><strong>Rs. {{ $subtotal }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Shipping</strong></div>
                                        <div class="h6"><strong>Rs. 20</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5 text-success"><strong>Total</strong></div>
                                        <div class="h5 text-success"><strong>Rs. {{ $total }}</strong></div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="card payment-form mt-3">
                                <div class="card-body">
                                    <h3 class="card-title h5 mb-3">Payment Method</h3>
                                    <div class="d-flex">
                                        <div class="form-check text-center">
                                            <input checked type="radio" name="payment_method" value="cod" id="payment_method_one">
                                            <label for="payment_method_one">COD</label>
                                        </div>
                                        <div class="form-check text-center">
                                            <input type="radio" name="payment_method" value="upi" id="payment_method_upi">
                                            <label for="payment_method_upi">UPI</label>
                                        </div>
                                        <div class="form-check text-center">
                                            <input type="radio" name="payment_method" value="atm_debit" id="payment_method_two">
                                            <label for="payment_method_two">ATM/Debit</label>
                                        </div>
                                    </div>
            
                                    <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                                        <div class="mb-3">
                                            <label for="card_number" class="mb-2">Card Number</label>
                                            <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="expiry_date" class="mb-2">Expiry Date</label>
                                                <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cvv_code" class="mb-2">CVV Code</label>
                                                <input type="text" name="cvv_code" id="cvv_code" placeholder="123" class="form-control">
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="pt-4">
                                        <button type="submit" class="btn btn-dark btn-block w-100">Pay Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>















            {{-- <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" name="first_name" id="first_name" class="form-control"
                                                    placeholder="First Name"
                                                    value="{{(!empty($customerAddress)) ? $customerAddress->first_name : '' }} ">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" name="last_name" id="last_name" class="form-control"
                                                    placeholder="Last Name" value="{{(!empty($customerAddress)) ? $customerAddress->last_name: '' }}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Email" value="{{(!empty($customerAddress)) ? $customerAddress->email: '' }}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <select name="country" id="country" class="form-control">
                                                    <option value="">Select a Country</option>
                                                    @if (!empty($countries))
                                                        @foreach ($countries as $country)
                                                        <option {{ (!empty($customerAddress) && $customerAddress->countries_id == $country->id) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{(!empty($customerAddress)) ? $customerAddress->address :''}}</textarea>
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="appartment" id="appartment" class="form-control"
                                                    placeholder="Apartment, suite, unit, etc. (optional)" value="{{(!empty($customerAddress)) ? $customerAddress->apartment :''}}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="city" id="city" class="form-control"
                                                    placeholder="City" value="{{(!empty($customerAddress)) ? $customerAddress->city :''}}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="state" id="state" class="form-control"
                                                    placeholder="State" value="{{(!empty($customerAddress)) ? $customerAddress->state :''}}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="zip" id="zip" class="form-control"
                                                    placeholder="Zip" value="{{(!empty($customerAddress)) ? $customerAddress->zip :''}}">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="mobile" id="mobile" class="form-control"
                                                    placeholder="Mobile No." value="{{(!empty($customerAddress)) ? $customerAddress->mobile :''}}">
                                                <p></p>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="note" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div> --}}
