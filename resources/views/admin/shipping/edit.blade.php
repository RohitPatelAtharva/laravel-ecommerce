@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping Management</h1>
                    @include('admin.message')
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
                                                <option
                                                    {{ $shippingCharge->countries_id == $country->id ? 'selected' : '' }}
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                            <option {{ $shippingCharge->countries_id == 'rest_of_world' ? 'selected' : '' }}
                                                value="rest_of_world">Rest of world</option>
                                        @endif
                                    </select>
                                    <p></p>
                                </div>



                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="amount" id="amount" class="form-control"
                                        placeholder="Amount" value="{{ $shippingCharge->amount }}">
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



        </div>

    </section>


@endsection

@section('customjs')
    <script>
        $("#shippingForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route("shipping.update",$shippingCharge->id) }}',
                type: 'put',
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
                }
            });
        })

        let message = document.getElementById("message");
        setTimeout(function() {
            message.style.display = 'none';
        }, 5000);
    </script>
@endsection
