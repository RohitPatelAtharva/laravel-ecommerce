@extends('admin.layouts.app')
@section('content')
    <style>
        .custom-modal-width {
            max-width: 80%;
            /* Adjust the percentage as needed */
        }

        .bg-navy {
            background-color: rgb(0, 0, 250);
        }

        .form-control {
            border-radius: 0% !important;
        }

        input::placeholder {
            color: #c6d4e4 !important;
            /* Change placeholder text color */
            font-style: italic;
            /* Italicize placeholder text */
            font-size: 16px;
            /* Change font size */
        }

        label {
            font-style: initial;
        }

        .customer_detail p {
            line-height: 4px
        }

        label {
            margin-left: 12px
        }

        select.form-control.option:hover {
            background-color: blue !important;
            color: white;
            /* Optional: Change the text color to make it more readable */
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        table {
            border-collapse: collapse;
        }

        .table td,
        .table th {
            padding: 0.1rem;
        }

        .reverse_align {
            text-align: right;
        }

        .tfr td {
            padding: 10px;
        }

        .btn-success {
            border-color: #10C888 !important;
            background-color: #16D39A !important;
            color: #FFFFFF;
        }
    </style>


    <div class="card">
        <h1 class="ml-4 text-info">Bill to
            <a href="#" id="element" class="btn btn-sm bg-info rounded-0 show-modal">Add Client</a>
        </h1>

        <div id="testmodal" class="modal fade">
            <div class="modal-dialog custom-modal-width">
                <div class="modal-content">
                    <div class="modal-header bg-navy text-white">
                        <h5 class="modal-title">Add Customer</h5>
                        <button type="button" class="close text-white" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="" method="post" id="billingAddress" name="billingAddress">
                                <div class="row">

                                    <div class="col-md-6">
                                        <h5>Billing Address</h5>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Name" id="b_name"
                                                name="b_name">
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Email" id="b_email"
                                                name="b_email">
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Phone" id="phone"
                                                name="b_phone">
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address" id="address"
                                                name="b_address">

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Country"
                                                        id="country" name="b_country">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="City"
                                                        id="city" name="b_city">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="PostBox"
                                                        id="b_zip" name="b_zip">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Company"
                                                        id="company" name="b_company">
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <h5>Shipping Address</h5>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Name" id="s_name"
                                                name="s_name">
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Email" id="s_email"
                                                name="s_email">
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Phone" id="s_phone"
                                                name="s_phone">
                                            <p></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address" id="address"
                                                name="s_address">
                                            <p></p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Country"
                                                        id="country" name="s_country">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="City"
                                                        id="city" name="s_city">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="PostBox"
                                                        id="zip" name="s_zip">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Company"
                                                        id="company" name="s_company">
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="testmodal-1" class="modal fade">
            <div class="modal-dialog custom-modal-width">
                <div class="modal-content">
                    <div class="modal-header bg-danger  text-white">
                        <h4 class="modal-title">Confirmation</h4>
                        <button type="button" class="close text-white" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to save changes you made to the document before closing?</p>
                        <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <form id="invoiceForm" method="POST" name="invoiceForm">
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
                                <input type="hidden" name="client_id" id="client_id" value="">
                                <input type="hidden" name="client_name" id="client_name" value="">
                                <input type="hidden" name="client_email" id="client_email" value="">
                                <input type="hidden" name="client_phone" id="client_phone" value="">
                                <input type="hidden" name="client_address" id="client_address" value="">
                                <input type="hidden" name="client_country" id="client_country" value="">
                                <input type="hidden" name="client_city" id="client_city" value="">
                                <input type="hidden" name="client_zip" id="client_zip" value="">
                                <label for="client">Client Detail</label>
                                <p id="clientName"></p>
                                <p id="clientAddress"></p>
                                <p><span>Phone</span>: <span id="clientPhone"></span></p>
                                <p><span>Email</span>: <span id="clientEmail"></span></p>
                                <p id="clientCountry"></p>
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
                                                <option selected value="yes" data-tformat="cgst" data-trate="12">CGST 9% +
                                                    SGST 9% Exclusive</option>
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
                                <div class="col-md-4 my-2">
                                    <div class="input-group-addon"><span class="icon-bookmark-o" aria-hidden="true"></span></div>
                                    @if($agents->isNotEmpty())
                                    <select id="agent" name="agent_id" class="form-control">
                                        <option value="">-- Select Referral --</option>
                                        @foreach ($agents as $agent)
                                        <option   value="{{ $agent->id }}">{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                    @endif
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

                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control productQuantity" value="1"
                                                name="new_Qty[]"></td>
                                        <td><input type="text" class="form-control productPrice" readonly></td>
                                        <td><input readonly type="text" class="form-control" value="18%"></td>
                                        <td><input type="text" class="form-control discount" value="0"
                                                name="discount[]"></td>
                                        <td><span class="currenty">Rs </span><strong><span
                                                    class="amount">0.00</span></strong></td>
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
                                        <input type="hidden" name="totalDiscount" id="totalDiscountInput"
                                            value="0.00">
                                        <td align="left" colspan="2">
                                            <span class="currenty lightMode">Rs</span>
                                            <span id="totalDiscount" class="lightMode">0.00</span>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="totalTax" id="totalTaxInput" value="0.00">
                                    <input type="hidden" name="subtotal" id="subtotalInput" value="0.00">
                                    <tr class="sub_c">
                                        <td colspan="5" class="reverse_align"><strong>Extra Discount</strong></td>
                                        <td align="left" colspan="2">
                                            <input type="text" class="form-control form-control-sm discVal"
                                                id="extraDiscount" value="0" name="extraDiscount">
                                            <input type="hidden" name="Finaldiscount" id="after_disc" value="0">
                                            ( Rs <span id="disc_final">0</span> )
                                        </td>
                                    </tr>
                                    <tr class="sub_c">
                                        <td colspan="2"><br>Payment Currency for your client <small>based on live
                                                market</small>
                                            <select name="payment_mode" class="selectpicker form-control">
                                                <option value="cash">Cash</option>
                                                <option value="ATM/DEBIT/CREDIT">ATM/DEBIT/CREDIT</option>
                                                <option value="Net Banking">Net Banking</option>
                                                <option value="UPI">UPI</option>
                                            </select>
                                        </td>
                                        <td colspan="3" class="reverse_align"><strong>Grand Total (<span
                                                    class="currenty lightMode">Rs</span>)</strong></td>
                                        <td align="left" colspan="2"><input type="text" name="grandtotal"
                                                class="form-control" id="invoiceyoghtml" readonly></td>
                                    </tr>
                                    <tr class="sub_c">
                                        <td colspan="2">Payment Terms
                                            <select name="pterms" class="selectpicker form-control">
                                                <option value="1">Paid</option>
                                                <option value="0">Unpaid</option>
                                            </select>
                                        </td>
                                        <td class="reverse_align" colspan="6"><button type="submit"
                                                class="btn btn-success sub-btn btn-lg" id="submit-data">Generate
                                                Invoice</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </form>


    </div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function() {
            var show_btn = $('.show-modal');
            var show_btn = $('.show-modal');
            //$("#testmodal").modal('show');

            show_btn.click(function() {
                $("#testmodal").modal('show');
            })
        });

        $(function() {
            $('#element').on('click', function(e) {
                Custombox.open({
                    target: '#testmodal-1',
                    effect: 'fadein'
                });
                e.preventDefault();
            });
        });


        $(document).ready(function() {
            $("#billingAddress").submit(function(event) {
                event.preventDefault();
                var element = $(this);
                console.log('hello');
                $.ajax({
                    url: '{{ route('billing.address') }}',
                    type: 'post',
                    data: element.serializeArray(),
                    dataType: 'json',
                    success: function(response) {
                        $("button[type=submit]").prop('disabled', false);
                        if (response["status"] == true) {
                            window.location.href = "{{ route('pages.index') }}";
                            $("#b_name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                            $("#s_name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                            $("#b_email").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                            $("#s_email").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                            $("#b_phone").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                            $("#s_phone").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        } else {
                            var errors = response['errors'];
                            if (errors['b_name']) {
                                $("#b_name").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['b_name']);
                            } else {
                                $("#b_name").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }
                            if (errors['s_name']) {
                                $("#s_name").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['s_name']);
                            } else {
                                $("#s_name").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }
                            if (errors['b_email']) {
                                $("#b_email").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['b_email']);
                            } else {
                                $("#b_email").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }
                            if (errors['s_email']) {
                                $("#s_email").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['s_email']);
                            } else {
                                $("#s_email").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }
                            if (errors['b_phone']) {
                                $("#b_phone").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['b_phone']);
                            } else {
                                $("#b_phone").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }
                            if (errors['s_phone']) {
                                $("#s_phone").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback').html(errors['s_phone']);
                            } else {
                                $("#s_phone").removeClass('is-invalid').siblings('p')
                                    .removeClass('invalid-feedback').html("");
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        $("button[type=submit]").prop('disabled', false);
                        console.error(xhr.responseText);
                        // Handle error
                    }
                });
            });
        });




        $(document).ready(function() {
            // Client search input event
            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val();
                if (searchTerm.length > 0) {
                    $.ajax({
                        url: '{{ route('get.searchBillingAddresses') }}',
                        method: 'GET',
                        data: {
                            term: searchTerm
                        },
                        success: function(response) {
                            var results = $('#results');
                            results.empty(); // Clear previous results
                            response.forEach(function(client) {
                                var item = $('<div class="result-item"></div>').text(
                                    client.name);
                                item.data('client', client);
                                results.append(item);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });

            // Update client details when a result item is clicked
            $(document).on('click', '.result-item', function() {
                var client = $(this).data('client');
                $('#clientName').text(client.name);
                $('#clientAddress').text(client.address);
                $('#clientPhone').text(client.phone_number);
                $('#clientEmail').text(client.email);

                $('#clientCountry').text(client.city);

                // Set the client_id and other details in hidden input fields
                $('#client_id').val(client.id);
                $('#client_name').val(client.name);
                $('#client_email').val(client.email);
                $('#client_phone').val(client.phone_number);
                $('#client_address').val(client.address);

                $('#client_city').val(client.city);
                $('#client_zip').val(client.zip);

                $('#results').empty();
            });

            // Function to fetch products and populate the select element
            function fetchProductsAndPopulateSelect(selectElement) {
                $.ajax({
                    url: '{{ route('get.productsdata') }}',
                    method: 'GET',
                    success: function(response) {
                        selectElement.empty(); // Clear previous options
                        selectElement.append('<option value="">Select product</option>');
                        response.forEach(function(products) {
                            var option = $('<option></option>').attr('value', products.id).text(
                                products.title);
                            option.data('price', products.price); // Store product price
                            option.data('quantity', products.qty); // Store product quantity
                            selectElement.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching products:', error);
                    }
                });
            }

            // Initial fetch for the first product row
            fetchProductsAndPopulateSelect($('.productSelect'));

            // Keep track of the last inserted row
            let lastInsertedRow = $('#invoiceForm tbody tr:first');

            // Add new product row
            $(document).on('click', '#addproduct', function() {
                var newRow = `
            <tr>
                <td>
                    <select name="selectedProduct[]" class="form-control productSelect">
                        <option value="">Select product</option>
                    </select>
                </td>
                <td><input type="text" class="form-control productQuantity" value="1" name="new_Qty[]"></td>
                <td><input type="text" class="form-control productPrice" readonly></td>
                <td><input readonly type="text" class="form-control" value="18%"></td>
                <td><input type="text" class="form-control discount" name="discount[]" value="0"></td>
                <td><span class="currenty">Rs </span><strong><span class="amount">0.00</span></strong></td>
                <td class="text-center"><button type="button" class="btn btn-danger remove-product"><i class="fa fa-trash"></i></button></td>
            </tr>
        `;
                $(newRow).insertAfter(lastInsertedRow);
                lastInsertedRow = lastInsertedRow.next();
                fetchProductsAndPopulateSelect(lastInsertedRow.find('.productSelect'));
            });

            // Update row amount when product selection or quantity changes
            $(document).on('change', '.productSelect', function() {
                var selectedOption = $(this).find(':selected');
                var price = selectedOption.data('price');
                var quantity = selectedOption.data('quantity');
                var row = $(this).closest('tr');
                row.find('.productPrice').val(price);
                row.find('.productQuantity').val(1); // Default quantity to 1
                updateRowAmount(row);
            });

            $(document).on('input', '.productQuantity, .discount', function() {
                var row = $(this).closest('tr');
                updateRowAmount(row);
            });

            // Remove product row
            $(document).on('click', '.remove-product', function() {
                var row = $(this).closest('tr');
                if (row.is(lastInsertedRow)) {
                    lastInsertedRow = row.prev();
                }
                row.remove();
                updateTotals();
            });

            // Update row amount
            function updateRowAmount(row) {
                var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
                var price = parseFloat(row.find('.productPrice').val()) || 0;
                var discountPercent = parseFloat(row.find('.discount').val()) || 0;
                var availableQuantity = parseFloat(row.find('.productSelect :selected').data('quantity')) || 0;

                if (quantity > availableQuantity) {
                    alert('Quantity cannot exceed available quantity: ' + availableQuantity);
                    row.find('.productQuantity').val(availableQuantity);
                    quantity = availableQuantity;
                }

                var amountBeforeDiscount = quantity * price;
                var discountAmount = (amountBeforeDiscount * discountPercent) / 100;
                var discountedAmount = amountBeforeDiscount - discountAmount;
                var tax = 0.18 * discountedAmount;
                var amount = discountedAmount + tax;

                row.find('.amount').text(amount.toFixed(2));
                updateTotals();
            }

            // Update totals
            function updateTotals() {
                var totalTax = 0;
                var totalDiscount = 0;
                var subtotal = 0;

                $('#invoiceForm tbody tr').each(function() {
                    var row = $(this);
                    var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
                    var price = parseFloat(row.find('.productPrice').val()) || 0;
                    var discountPercent = parseFloat(row.find('.discount').val()) || 0;

                    var amountBeforeDiscount = quantity * price;
                    var discountAmount = (amountBeforeDiscount * discountPercent) / 100;
                    var discountedAmount = amountBeforeDiscount - discountAmount;
                    var tax = 0.18 * discountedAmount;
                    var amount = discountedAmount + tax;

                    totalTax += tax;
                    totalDiscount += discountAmount;
                    subtotal += amountBeforeDiscount;

                    row.find('.amount').text(amount.toFixed(2));
                });

                var grandtotal = subtotal + totalTax - totalDiscount;

                $('#totalTax').text(totalTax.toFixed(2));
                $('#totalDiscount').text(totalDiscount.toFixed(2));
                $('#subtotal').text(subtotal.toFixed(2));
                $('#invoiceyoghtml').val(grandtotal.toFixed(2)); // Update grand total input field

                // Update hidden inputs
                $('#totalTaxInput').val(totalTax.toFixed(2));
                $('#totalDiscountInput').val(totalDiscount.toFixed(2));
                $('#subtotalInput').val(subtotal.toFixed(2));
            }
            // Form submission
            $('#invoiceForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Ensure totals are updated before submitting
                updateTotals();

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: '{{ route('store.invoice') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Invoice generated successfully');
                        window.location.href = '{{ route('getBill') }}';
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert(
                            'An error occurred while generating the invoice. Please try again later.'
                        );
                    }
                });
            });
        });
    </script>
@endsection
