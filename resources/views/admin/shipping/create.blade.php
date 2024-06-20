@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping Management</h1>
                    @include('admin.message')
                    <div id="successMessage"></div>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="
                    {{ route('categories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action=" " method="post" name="shippingForm" id="shippingForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">

                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select a Country</option>
                                        @if ($countries->isNotEmpty())
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                            <option value="rest_of_world">Rest of world</option>
                                        @endif
                                    </select>
                                    <p></p>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Amount">
                                    <p></p>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <button class="btn btn-primary">Create</button>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>


            </form>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Action</th>

                                </tr>
                                @if ($shippingCharges->isNotEmpty())
                                    @foreach ($shippingCharges as $shippingCharge)
                                        <tr id="elementToDelete_{{ $shippingCharge->id }}">
                                            <th>{{ $shippingCharge->id }}</th>
                                            <th>
                                                {{ $shippingCharge->countries_id == 'rest_of_world' ? 'Rest of the World' : $shippingCharge->name }}
                                            </th>
                                            <th>Rs. {{ $shippingCharge->amount }}</th>
                                            <th class="ml-2"><a
                                                    href="{{ route('shipping.edit', $shippingCharge->id) }}"><svg
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        width="24" height="24">
                                                        <path d="M0 0h24v24H0z" fill="none" />
                                                        <path fill="#007bff"
                                                            d="M14.29 5.71a1 1 0 0 1 0 1.41l-8 8a1 1 0 0 1-1.41-1.41l8-8a1 1 0 0 1 1.41 0zm5.29-.71a1 1 0 0 1 1.41 1.41l-12 12a1 1 0 0 1-1.41-1.41l12-12a1 1 0 0 1 0 0zM19 10.41l-1.29 1.29a1 1 0 0 1-1.41-1.41L17.59 9H15v2.59l5.3 5.3c.2.2.45.3.7.3s.5-.1.7-.3c.39-.4.39-1.01 0-1.4zM3 17v4a1 1 0 0 0 1 1h4a1 1 0 0 0 .8-.4l11-12a1 1 0 0 0 .21-.32l1.3-3.24A1 1 0 0 0 20 6H6a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h.09l3.24-1.3a1 1 0 0 0 .32-.21l12-11a1 1 0 0 0 .4-.8V3a1 1 0 0 0-1-1H8a1 1 0 0 0-.7.29L3.29 6A1 1 0 0 0 3 7v10a1 1 0 0 0 1 1z" />
                                                    </svg></a>
                                                <a href="javascript:void(0);"
                                                    onclick="deleteRecord({{ $shippingCharge->id }});"><svg
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        width="24" height="24">
                                                        <path d="M0 0h24v24H0z" fill="none" />
                                                        <path fill="#ff0000"
                                                            d="M20 7V6a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v1H2v2h1v11a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9h1V7h-3zM9 18H8v-6h1v6zm2 0h-1v-6h1v6zm2 0h-1v-6h1v6zm3 0h-1v-6h1v6z" />
                                                    </svg></a>
                                            </th>

                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>


@endsection

@section('customjs')
    <script>
        $("#shippingForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route("shipping.store") }}',
                type: 'post',
                data: element.serializeArray(), // Serialize form data
                dataType: 'json',
                success: function(response) {
                    $("buttoom[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {
                        window.location.href = "{{ route('shipping.create') }}";
                    } else {
                        var errors = response['errors'];
                        if (errors['country']) {
                            $("#country").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['country']);
                        } else {
                            $("#country").addClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                        if (errors['amount']) {
                            $("#amount").addClass('is-invalid').siblings('p')
                                .addClass('invalid-feedback').html(errors['amount']);
                        } else {
                            $("#amount").addClass('is-invalid').siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    console.log('something went wrong');
                }
            });
        })

        function deleteRecord(id) {
            var url = '{{ route('shipping.delete', 'ID') }}';
            var newUrl = url.replace('ID', id);
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: newUrl,
                    type: 'DELETE',
                    data: {},
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Log the response object
                        if (response.status === true) {
                            $('#elementToDelete_' + id).remove();
                            $('#successMessage').html('<div class="alert alert-success alert-dismissible" id="successMessage"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Success</h4>Record deleted successfully.</div>')
                        } else {
                            alert('Failed to delete record.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                    }
                });
            }
        }

        let message = document.getElementById("message");
        setTimeout(function() {
            message.style.display = 'none';
        }, 5000);
        let messages = document.getElementsByClassName("alert");
        setTimeout(function() {
            for (let i = 0; i < messages.length; i++) {
                messages[i].style.display = 'none';
            }
        }, 5000);
    </script>
@endsection
