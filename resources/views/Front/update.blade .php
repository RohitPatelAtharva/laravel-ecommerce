<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cart Item Image</title>
</head>
<body>
    <h1>Update Cart Item Image</h1>
    
    <form id="update-image-form" action="{{ route('cart.updateImage')" enctype="multipart/form-data">
        @csrf <!-- CSRF token for Laravel -->
        @method('PUT') <!-- Method spoofing for PUT request -->
        
        <label for="product_id">Select Product:</label>
        <select name="product_id" id="product_id">
            <!-- Options for selecting product -->
            <option value="1">Product 1</option>
            <option value="2">Product 2</option>
            <!-- Add more options as needed -->
        </select>
        
        <label for="image">Upload New Image:</label>
        <input type="file" name="image" id="image">
        
        <button type="submit">Update Image</button>
    </form>

    <!-- jQuery CDN (you can include jQuery from your project instead) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#update-image-form').submit(function(event) {
                event.preventDefault(); // Prevent form submission
                
                var formData = new FormData($(this)[0]); // Get form data
                
                // Send AJAX request
                $.ajax({
                    url: '{{ route("cart.updateImage") }}',
    type: 'PUT',
                    data: formData, // Form data
                    contentType: false, // Prevent jQuery from setting Content-Type
                    processData: false, // Prevent jQuery from processing data
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        alert('Image updated successfully!');
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        alert('Error updating image!');
                    }
                });
            });
        });