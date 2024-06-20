@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Users
                    </h1>
                    @include('admin.message')
                </div>
                <div class="col-sm-6 text-right">
                    <a href="
                    {{ route('pages.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="userForm" method="post" name="userForm">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name">
                                    <p></p>
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Enter Your Email">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" id="password"
                                        name="password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        id="password_confirmation" name="password_confirmation">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Phone</label>
                                <div class="mb-3">
                                    <input type="text" id="phone" class="form-control" name="phone"
                                        placeholder="Enter Phone">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('pages.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>

            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection

@section('customjs')
    <script>
        $("#userForm").submit(function(event) {

            event.preventDefault();
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();

            // Clear previous error states
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            // Check if the passwords match
            if (password !== confirmPassword) {
                // Show error messages for both fields
                $('#password, #password_confirmation').addClass('is-invalid');
                $('#password').after('<p class="invalid-feedback">Passwords do not match</p>');
                $('#password_confirmation').after('<p class="invalid-feedback">Passwords do not match</p>');
                return; // Stop form submission
            }


            var element = $(this);
            console.log('hello');
            $.ajax({
                url: '{{ route('users.store') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {
                        window.location.href = "{{ route('users.index') }}"

                        $("#name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#email").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#password").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#password_confirmation").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#phone").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    } else {
                        var errors = response['errors'];
                        if (errors['name']) {
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                        if (errors['email']) {
                            $("#email").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['email']);
                        } else {
                            $("#email").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                        if (errors['password']) {
                            $("#password").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['password']);
                        } else {
                            $("#password").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }
                        if (errors['password_confirmation']) {
                            $("#password_confirmation").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['password_confirmation']);
                        } else {
                            $("#password_confirmation").removeClass('is-invalid').siblings('p')
                                .removeClass(
                                    'invalid-feedback').html("");
                        }
                        if (errors['phone']) {
                            $("#phone").addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['phone']);
                        } else {
                            $("#phone").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html("");
                        }


                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });

        });
    </script>
@endsection
