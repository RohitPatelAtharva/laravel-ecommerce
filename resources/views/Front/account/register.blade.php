@extends('Front.app')
@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Register</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">
                <form method="post"    id="registrationForm" name="registrationForm" >
                    <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                        <p></p>
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
                </form>
                <div class="text-center small">Already have an account? <a href="{{route('account.login')}}">Login Now</a></div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('customjs')
<script type="text/javascript">

$("#registrationForm").submit(function(event) {
    event.preventDefault();

    // Get the values of password and confirm password fields
    var password = $("#password").val();
    var confirmPassword = $("#password_confirmation").val();

    // Clear previous error states
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').remove();

    // Check if the passwords match
    if (password !== confirmPassword) {
        // Show error messages for both fields
        $('#password, #password_confirmation').addClass('is-invalid').siblings('p').text('Passwords do not match');
        return; // Stop form submission
    }

    // If passwords match, proceed with form submission
    $("button[type='submit']").prop('disabled', true);

    $.ajax({
        url: '{{ route("account.processRegister") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response) {
            $("button[type='submit']").prop('disabled', false);
            // Handle success response if needed
            if (response.status === false) {
                // Display validation errors
                $.each(response.errors, function(key, value) {
                    $('#' + key).addClass('is-invalid').after('<p class="invalid-feedback">' + value[0] + '</p>');
                });
            } else {
                window.location.href = "{{ route('account.login') }}";
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // Log the error message returned by the server
            console.log("Error:", jqXHR.responseText);

            // Display a generic error message to the user
            console.log("Something went wrong");
        }
    });
});
</script>
@endsection
