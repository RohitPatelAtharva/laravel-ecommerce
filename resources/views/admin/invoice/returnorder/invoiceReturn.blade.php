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

        <div id="testmodal" class="modal fade">
            <div class="modal-dialog custom-modal-width">
                <div class="modal-content">
                    <div class="modal-header bg-navy text-white">
                        <h5 class="modal-title">Add Customer</h5>
                        <button type="button" class="close text-white" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
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


        <section>
            <div class="container">
                <h2 class="text-maroon py-2">Customer Stock Return</h2>
                <div class="row">
                    <div class="col-md-3 mb-2">

                        <div id="results" class="result-container"></div>
                        <div class="customer_detail">

                            <h2>Bill To</h2>
                            <p id="clientName">{{ $order->first_name }}</p>
                            <p id="clientAddress">{{ $order->address }}</p>
                            <p><span>Phone</span>: <span id="clientPhone">{{ $order->mobile }}</span></p>
                            <p><span>Email</span>: <span id="clientEmail">{{ $order->email }}</span></p>
                            <p id="clientCountry">{{ $order->countries }}</p>
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
                                            <option value="inclusive" data-tformat="inclusive" data-trate="10">Custom
                                                10%
                                                Inclusive</option>
                                            <option selected value="yes" data-tformat="cgst" data-trate="12">CGST
                                                9% +
                                                SGST 9% Exclusive</option>
                                            <option value="yes" data-tformat="yes" data-trate="20">VAT 20%
                                                Exclusive
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

            </div>
        </section>

        <section type="2">
            <div class="container-fluid">
                <form action="{{ route('return.order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <table id="invoiceForm" class="table-responsive tfr my_stripe">
                        <thead class="bg-fuchsia">
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
                            @foreach ($orderItems as $item)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="items[{{ $loop->index }}][item_name]" value="{{ $item->name }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control productQuantity" name="items[{{ $loop->index }}][quantity]" value="{{ $item->qty }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control productPrice" name="items[{{ $loop->index }}][rate]" value="{{ $item->price }}" readonly>
                                </td>
                                <td>
                                    <input readonly type="text" class="form-control" value="18%">
                                </td>
                                <td>
                                    <input type="text" class="form-control discount" name="items[{{ $loop->index }}][discount]" value="{{ $item->discount }}">
                                </td>
                                <td>
                                    <span class="currenty">Rs </span><strong><span class="amount">{{ $item->totalAmount }}</span></strong>
                                    <input type="hidden" name="items[{{ $loop->index }}][amount]" value="{{ $item->totalAmount }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger removeRow">Remove</button>
                                </td>
                                <input type="hidden" name="items[{{ $loop->index }}][product_id]" value="{{ $item->product_id }}">
                            </tr>
                            @endforeach
                            <tr class="sub_c">
                                <td colspan="5" class="reverse_align"><strong>Total Tax</strong></td>
                                <td align="left" colspan="2">
                                    <span class="currenty lightMode">Rs</span>
                                    <span id="totalTax" class="lightMode">0.00</span>
                                    <input type="hidden" name="totalTax" id="totalTaxInput" value="0.00">
                                </td>
                            </tr>
                            <tr class="sub_c">
                                <td colspan="5" class="reverse_align"><strong>Total Discount</strong></td>
                                <td align="left" colspan="2">
                                    <span class="currenty lightMode">Rs</span>
                                    <span id="totalDiscount" class="lightMode">0.00</span>
                                    <input type="hidden" name="totalDiscount" id="totalDiscountInput" value="0.00">
                                </td>
                            </tr>
                            <tr class="sub_c">
                                <td colspan="5" class="reverse_align"><strong>Subtotal</strong></td>
                                <td align="left" colspan="2">
                                    <span class="currenty lightMode">Rs</span>
                                    <span id="subtotal" class="lightMode">0.00</span>
                                    <input type="hidden" name="subtotal" id="subtotalInput" value="0.00">
                                </td>
                            </tr>
                            <tr class="sub_c">
                                <td colspan="5" class="reverse_align"><strong>Extra Discount</strong></td>
                                <td align="left" colspan="2">
                                    <input type="text" class="form-control form-control-sm discVal" id="extraDiscount" value="0" name="extraDiscount">
                                </td>
                            </tr>
                            <tr class="sub_c">
                                <td colspan="5" class="reverse_align"><strong>Grand Total</strong></td>
                                <td align="left" colspan="2">
                                    <span class="currenty lightMode">Rs</span>
                                    <span id="grandTotal" class="lightMode">0.00</span>
                                    <input type="hidden" name="grandTotal" id="grandTotalInput" value="0.00">
                                </td>
                            </tr>
                            <tr class="sub_c">
                                <td colspan="2">Payment Terms
                                    <select name="pterms" class="selectpicker form-control">
                                        <option value="1">Paid</option>
                                        <option value="0">Unpaid</option>
                                    </select>
                                </td>
                                <td class="reverse_align" colspan="6">
                                    <button type="submit" class="btn btn-success sub-btn btn-lg" id="submit-data">Generate Invoice</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
    </div>
    </div>
    </section>


    </div>
@endsection

@section('customjs')
    <script>
$(document).ready(function() {
    function updateRowAmount(row) {
        var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
        var price = parseFloat(row.find('.productPrice').val()) || 0;
        var discountPercent = parseFloat(row.find('.discount').val()) || 0;

        var amountBeforeDiscount = price * quantity;
        var discountAmount = (amountBeforeDiscount * discountPercent) / 100;
        var discountedAmount = amountBeforeDiscount - discountAmount;
        var tax = 0.18 * discountedAmount;
        var totalAmount = discountedAmount + tax;

        row.find('.amount').text(totalAmount.toFixed(2));
        row.find('input[name$="[amount]"]').val(totalAmount.toFixed(2)); // Update hidden input value
        updateTotals();
    }

    function updateTotals() {
        var subtotal = 0;
        var totalDiscount = 0;
        var totalTax = 0;

        $('#invoiceForm tbody tr').each(function() {
            var row = $(this);
            var quantity = parseFloat(row.find('.productQuantity').val()) || 0;
            var price = parseFloat(row.find('.productPrice').val()) || 0;
            var discountPercent = parseFloat(row.find('.discount').val()) || 0;

            var amountBeforeDiscount = price * quantity;
            var discountAmount = (amountBeforeDiscount * discountPercent) / 100;
            var discountedAmount = amountBeforeDiscount - discountAmount;
            var tax = 0.18 * discountedAmount;
            var totalAmount = discountedAmount + tax;

            subtotal += totalAmount;
            totalDiscount += discountAmount;
            totalTax += tax;

            row.find('.amount').text(totalAmount.toFixed(2));
            row.find('input[name$="[amount]"]').val(totalAmount.toFixed(2)); // Update hidden input value
        });

        var extraDiscount = parseFloat($('#extraDiscount').val()) || 0;
        var grandTotal = subtotal - extraDiscount; // Adjust grand total calculation

        $('#subtotal').text(subtotal.toFixed(2));
        $('#totalTax').text(totalTax.toFixed(2));
        $('#totalDiscount').text(totalDiscount.toFixed(2));
        $('#grandTotal').text(grandTotal.toFixed(2));
        
        // Update grand total input value with backend data
        $('#grandTotalInput').val(grandTotal.toFixed(2)); 

        $('#subtotalInput').val(subtotal.toFixed(2));
        $('#totalTaxInput').val(totalTax.toFixed(2));
        $('#totalDiscountInput').val(totalDiscount.toFixed(2));
    }

    $(document).on('input', '.productQuantity, .productPrice, .discount', function() {
        var row = $(this).closest('tr');
        updateRowAmount(row);
    });

    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
        updateTotals();
    });

    $('#extraDiscount').on('input', function() {
        updateTotals();
    });

    // Initial calculation if necessary
    updateTotals();
});
    </script>
@endsection
