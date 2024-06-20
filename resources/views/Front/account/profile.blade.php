@extends('Front.app')
@section('content')
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
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('Front.account.common.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                            </div>
                            <div class="card-body p-4">
                                <form action="" method="post" name="profileForm" id="profileForm">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input value="{{ $user->name }}" type="text" name="name" id="name"
                                                placeholder="Enter Your Name" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email">Email</label>
                                            <input value="{{ $user->email }}" type="text" name="email" id="email"
                                                placeholder="Enter Your Email" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="phone">Phone</label>
                                            <input value="{{ $user->phone }}" type="text" name="phone" id="phone"
                                                placeholder="Enter Your Phone" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="d-flex">
                                            <button class="btn btn-dark">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                            </div>
                            <div class="card-body p-4">
                                <form action="" method="post" name="addressForm" id="addressForm">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input  value="{{(!empty($address)) ? $address->first_name : ''}}"  type="text" name="first_name" id="first_name"
                                                  class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input value="{{(!empty($address)) ? $address->last_name : ''}}"  type="text" name="last_name" id="last_name"
                                                placeholder="Enter Your Last Name" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email">Email</label>
                                            <input value="{{(!empty($address)) ? $address->email : ''}}"  type="text" name="email" id="email"
                                                placeholder="Enter Your Email" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="phone">Mobile</label>
                                            <input value="{{(!empty($address)) ? $address->mobile : ''}}"  type="text" name="mobile" id="mobile"
                                                placeholder="Enter Your mobile" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="phone">Country</label>
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">select a country</option>
                                                @if($countries->isNotEmpty())
                                                @foreach($countries as $country)
                                                <option {{(!empty($address) && $address->countries_id == $country->id) ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="city">state</label>
                                            <input value="{{(!empty($address)) ? $address->state : ''}}"  type="text" name="state" id="state"
                                                placeholder="Enter Your state" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="city">City</label>
                                            <input value="{{(!empty($address)) ? $address->city : ''}}"  type="text" name="city" id="city"
                                                placeholder="Enter Your City" class="form-control">
                                            <p></p>
                                        </div>
                                        

                                        <div class="mb-3 col-md-6">
                                            <label for="phone">Apartment</label>
                                            <input value="{{(!empty($address)) ? $address->apartment : ''}}"  type="text" name="apartment" id="apartment"
                                                placeholder="Enter Your apartment detail" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="city">Zip</label>
                                            <input value="{{(!empty($address)) ? $address->zip : ''}}"  type="text" name="zip" id="zip"
                                                placeholder="Enter Your Zip" class="form-control">
                                            <p></p>
                                        </div>
                                        

                                        <div class="mb-3 col-md-6">
                                            <label for="phone">Note</label>
                                            <input value="{{(!empty($address)) ? $address->note : ''}}"  type="text" name="apartment" id="apartment"
                                                placeholder="Enter Your apartment detail" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 ">
                                            <label for="phone">Address</label>
                                             <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{(!empty($address)) ? $address->address : ''}}</textarea>
                                            <p></p>
                                        </div>
                                         


                                        <div class="d-flex">
                                            <button class="btn btn-dark">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('customjs')
    <script>
        $("#profileForm").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('account.updateProfile') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                         
                        window.location.href = "{{ route('account.profile') }}";
                    } else {
                        var errors = response.errors;

                        if (errors.name) {
                            $("#profileForm #name").addClass('is-invalid').siblings('p').html(errors.name[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#profileForm #name").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }

                        if (errors.email) {
                            $("#profileForm #email").addClass('is-invalid').siblings('p').html(errors.email[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#profileForm #email").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }

                        if (errors.phone) {
                            $("#profileForm #phone").addClass('is-invalid').siblings('p').html(errors.phone[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#profileForm #phone").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle any unexpected errors
                    console.log(error);
                    $("#errorMessage").text('An unexpected error occurred. Please try again later.')
                        .show();
                    $("#successMessage").hide();
                }
            });
        });

        // address form
        $("#addressForm").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('account.updateAddress') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                          
                        window.location.href = "{{ route('account.profile') }}";
                    } else {
                        var errors = response.errors;

                        if (errors.first_name) {
                            $("#first_name").addClass('is-invalid').siblings('p').html(errors.first_name[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#first_name").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                        if (errors.last_name) {
                            $("#last_name").addClass('is-invalid').siblings('p').html(errors.last_name[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#last_name").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }

                        if (errors.email) {
                            $("#addressForm #email").addClass('is-invalid').siblings('p').html(errors.email[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#addressForm #email").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
             
                        if (errors.mobile) {
                            $("#addressForm #mobile").addClass('is-invalid').siblings('p').html(errors.mobile[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#addressForm #mobile").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                        if (errors.country) {
                            $("#addressForm #country_id").addClass('is-invalid').siblings('p').html(errors.country[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#addressForm #country_id").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                        if (errors.city) {
                            $("#addressForm #city").addClass('is-invalid').siblings('p').html(errors.city[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#addressForm #city").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                        if (errors.state) {
                            $("#addressForm #state").addClass('is-invalid').siblings('p').html(errors.state[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#addressForm #state").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                        if (errors.zip) {
                            $("#addressForm #zip").addClass('is-invalid').siblings('p').html(errors.zip[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#addressForm #zip").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                        if (errors.address) {
                            $("#addressForm #address").addClass('is-invalid').siblings('p').html(errors.address[0])
                                .addClass('invalid-feedback');
                        } else {
                            $("#addressForm #address").removeClass('is-invalid').siblings('p').html('').removeClass(
                                'invalid-feedback');
                        }
                    }
                }
                
               
            });
        });
    </script>
@endsection
