@extends('admin.layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
    @endif

    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Top Section</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="products.html" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form action="{{ asset(route('topsection.store')) }}" id="topsection.store" name="topsection.store" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="title">
                                            @error('title')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">=Description</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description"></textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="title">Image Text</label>
                                <input type="text" name="image_text" id="image_text" class="form-control"
                                    placeholder="image_text">
                            </div>
                            <div class="mb-3">
                                <label for="title">Image Url</label>
                                <input type="text" name="image_url" id="image_url" class="form-control"
                                    placeholder="image_url">
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div id="imageContainer" class="dropzone dz-clickable" onclick="openImageFolder()">
                                        <div class="dz-message needsclick">
                                            <img id="imageDisplay" src="" alt="Uploaded Image"
                                                style="display: none;width:100%" class="img-fluid">

                                            <br>
                                            <p id="upload">Drop file here or click to upload.</p> <br><br>

                                        </div>

                                    </div>
                                    <input type="file" id="fileInput" name="image" style="" accept="image/*">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Section Id</h2>
                                <div class="mb-3">
                                    <select name="section_id" id="section_id"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="section_id">
                                        @error('section_id')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                        <option value="">Select Section</option>
                                        @if ($getsection->isNotEmpty())
                                            {
                                            @foreach ($getsection as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        @endif
                                        }
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="price">Discount</label>
                                        <input type="text" name="discount" id="discount" class="form-control"
                                            placeholder="discount">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card mb-3 ">
                            <h2 class="p-5">Related Products</h2>
                            <div class="card-body ">
                                <label for="">Related Tags</label>
                                <a href="#" id="addNewTagLink" class="pl-5">Add New Tag</a>
                                <div class="mb-3">
                                    <select multiple class="related-tags w-100" name="related_tags[]"
                                        id="related_tags"></select>
                                </div>

                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2>Select</h2>
                                <div class="mb-3">
                                    <select id="options" onchange="showOptions()" class="form-control" name="select">
                                        <option value="0">Select an option</option>
                                        <option value="1">Category</option>
                                        <option value="2">Product</option>
                                        <option value="3">Tag</option>
                                    </select>

                                    <div id="dynamicOptions" style="display: none;">
                                        <!-- Dynamic options will be displayed here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>

            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
@endsection

@section('customjs')
    <script>
        $('.related-tags').select2({
            tags: true, // Allow creating new tags
            tokenSeparators: [','], // Define the character(s) used to separate tags
            createTag: function(params) {
                // Check if the user typed a comma and it's not an existing tag
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true // Indicate that it's a new tag
                };
            },
            insertTag: function(data, tag) {
                // Insert the tag at the beginning of the results
                data.push(tag);
            },
            ajax: {
                url: '{{ route('product.getTags') }}',
                dataType: 'json',
                multiple: true,
                minimumInputLength: 3,
                processResults: function(data) {
                    if (data && data.tags) {
                        return {
                            results: $.map(data.tags, function(tag) {
                                return {
                                    id: tag.name,
                                    text: tag.name
                                };
                            })
                        };
                    } else {
                        return {
                            results: []
                        };
                    }
                }
            }
        });
        $('#addNewTagLink').click(function(event) {
            event.preventDefault(); // Prevent the default link behavior
            var newTagName = prompt("Enter the new tag name:");
            if (newTagName) {
                // Create a new option element
                var newOption = new Option(newTagName, newTagName, true, true);
                // Append the new option to the Select2 input field
                $('.related-tags').append(newOption).trigger('change');

                // AJAX request to add the new tag to the database
                $.ajax({
                    url: '{{ route('tags.add') }}', // Change this URL to your server endpoint for adding tags
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: newTagName
                    },
                    success: function(response) {
                        console.log("Tag added successfully!");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error adding tag:", error);
                    }
                });
            }
        });




        //###########====================slug========= end here============




        function openImageFolder() {
            document.getElementById('fileInput').click();
        }

        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imageDisplay').src = e.target.result;
                    document.getElementById('upload').style.display = 'none';
                    document.getElementById('imageDisplay').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function showOptions() {
            var selectedOption = document.getElementById("options").value;
            var dynamicOptionsDiv = document.getElementById("dynamicOptions");

            // Clear previous dynamic options
            dynamicOptionsDiv.innerHTML = "";

            // Show dynamic options based on selected option
            if (selectedOption === "1") {
                $.ajax({
                    url: "{{ route('top.getCetegory') }}",
                    type: "GET",
                    success: function(response) {
                        var categoryOptions = "<label for='categoryOptions'>Category:</label>" +
                            "<select id='categoryOptions' name='related' class='form-control'>" +
                            "<option value=''>Select a category name</option>";
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
                $.ajax({
                    url: "{{ route('top.getProducts') }}",
                    type: "GET",
                    success: function(response) {
                        var productOptions = "<label for='productOptions'>Product:</label>" +
                            "<select id='categoryOptions' name='related' class='form-control'>" +
                            "<option value=''>Select a product name</option>";
                        $.each(response.products, function(index, product) {
                            productOptions += "<option value='" + product.id + "'>" + product.title +
                                "</option>";
                        });
                        productOptions += "</select>";
                        dynamicOptionsDiv.innerHTML = productOptions;

                        // Show dynamic options div after appending options
                        dynamicOptionsDiv.style.display = "block";
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log error message
                    }
                });
            } else if (selectedOption === "3") {
                $.ajax({
                    url: "{{ route('top.getTags') }}",
                    type: "GET",
                    success: function(response) {
                        var tagOptions = "<label for='tagOptions'>Tag:</label>" +
                            "<select id='categoryOptions' name='related' class='form-control'>" +
                            "<option value=''>Select a tag name</option>";
                        $.each(response.tags, function(index, tag) {
                            tagOptions += "<option value='" + tag.id + "'>" + tag.name + "</option>";
                        });
                        tagOptions += "</select>";
                        dynamicOptionsDiv.innerHTML = tagOptions;

                        // Show dynamic options div after appending options
                        dynamicOptionsDiv.style.display = "block";
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log error message
                    }
                });
            }
        }







        // ============desappear massage===========

        document.addEventListener("DOMContentLoaded", function() {
            // Get the success message element
            var successMessage = document.getElementById('successMessage');

            // Check if the success message exists
            if (successMessage) {
                // Set a timeout to remove the message after 5 seconds
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 5000); // 5000 milliseconds = 5 seconds
            }
        });
    </script>
@endsection
