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
                    <h1>Create Product</h1>
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
        <form action="{{ asset(route('products.store')) }}" id="productForm" name="productForm" method="post"
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
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" id="slug" class="form-control"
                                                placeholder="slug">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Short_description</label>
                                            <textarea name="short_description" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Shipping_description</label>
                                            <textarea name="shipping_returns" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <div class="row" id="product-gallery">


                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" id="price" class="form-control"
                                                placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" name="compare_price" id="compare_price"
                                                class="form-control" placeholder="Compare Price">
                                            <p class="text-muted mt-3">
                                                To show a reduced price, move the product’s original price into Compare at
                                                price. Enter a lower value into Price.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sku">SKU (Stock Keeping Unit)</label>
                                            <input type="text" name="sku" id="sku" class="form-control"
                                                placeholder="sku">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Barcode</label>
                                            <input type="text" name="barcode" id="barcode" class="form-control"
                                                placeholder="Barcode">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="track_qty"
                                                    name="track_qty" checked>
                                                <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" min="0" name="qty" id="qty"
                                                class="form-control" placeholder="Qty">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 col-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <label for="">Related product</label>
                                                <div class="mb-3">
                                                    <select multiple class="related-product w-100"
                                                        name="related_products[]" id="related_products">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            
                                <div class="card mb-3 ">
                                <h2 class="p-5">Related Products</h2>
                                    <div class="card-body ">
                                        <label for="">Related Tags</label>
                                        <a href="#" id="addNewTagLink" class="pl-5">Add New Tag</a>
                                        <div class="mb-3">
                                            <select multiple class="related-tags w-100" name="related_tags[]" id="related_tags"></select>
                                        </div>
                                         
                                    </div>
                                </div>
                            
                         </div>
                    </div>
                    <div class="col-md-4">
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
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4  mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select cetegory</option>
                                        @if ($categories->isNotEmpty())
                                            {
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                        }
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="category">Sub category</label>
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Select SubCategory</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select Brands</option>
                                        @if ($brands->isNotEmpty())
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card mb-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <label for="">Related Tags</label>
                                    <a href="#" id="addNewTagLink" class="pl-5">Add New Tag</a>
                                    <div class="mb-3">
                                        <select multiple class="related-tags w-100" name="related_tags[]" id="related_tags"></select>
                                    </div>
                                     
                                </div>
                            </div>
                        </div> --}}
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
        $('.related-product').select2({
            ajax: {
                url: '{{ route('product.getProducts') }}',
                dataType: 'json',
                tags: true,
                multiple: true,
                minimumInputLength: 3,
                processResults: function(data) {
                    return {
                        results: data.tags
                    };
                }

            }
        });
        $('.related-tags').select2({
    tags: true, // Allow creating new tags
    tokenSeparators: [','], // Define the character(s) used to separate tags
    createTag: function (params) {
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
    insertTag: function (data, tag) {
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
                        return { id: tag.id, text: tag.name };
                    })
                };
            } else {
                return { results: [] };
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
            url: '{{route("tags.add")}}', // Change this URL to your server endpoint for adding tags
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
       


        $("#title").change(function() {
            element = $(this);
            $("button[type=submit]").prop('disabled', true);



            $.ajax({
                url: '{{ route('getSlug') }}',
                type: 'get',
                data: {
                    title: element.val()
                },
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {
                        $("#slug").val(response["slug"]);
                    }
                }




            });
        });

        //###########====================slug========= end here============


        $("#category").change(function() {
            var category_id = $(this).val();
            $.ajax({
                url: '{{ route('product-subcategories.index') }}',
                type: 'get',
                data: {
                    category_id: category_id
                },
                datatype: 'json',
                success: function(response) {
                    $("#sub_category").find("option").not(":first").remove();
                    $.each(response["subCategories"], function(key, item) {
                        $("#sub_category").append(
                            `<option value='${item.id}'>${item.name}</option>`)
                    })

                },
                error: function() {
                    console.log("something is wrong");
                }
            })
        })


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

        // ============desappear massage===========

        document.addEventListener("DOMContentLoaded", function() {
        // Get the success message element
        var successMessage = document.getElementById('successMessage');
        
        // Check if the success message exists
        if(successMessage) {
            // Set a timeout to remove the message after 5 seconds
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    });


        // ===================cetegory  and  sub category end here==================================



        // $("productForm").submit(function(event){
        //     event.preventDefault();
        //     var formArray = $(this).serializeArray();
        //     $.ajax({
        //         url:'{{ route('products.store') }}',
        //         type:'POST',
        //         data:formArray,
        //         datatype:'json',
        //         success: function(response){

        //         },
        //         error:function(){
        //             console.log("some is wrong")
        //         }
        //     });
        // })






        //         Dropzone.autoDiscover = false;

        //         const dropzone = $("#image").dropzone({

        //             init: function() {
        //                 this.on('addedfile', function(file) {
        //                     if (this.files.length > 5) {
        //                         this.removeFile(this.files[0]);
        //                     }
        //                 });
        //             },

        //             url: "{{ route('temp-images.create') }}",
        //             type: 'post',
        //             maxFiles: 5,
        //             paramName: 'image',
        //             addRemoveLinks: true,
        //             acceptedFiles: "image/jpeg,image/png,image/gif",
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function(file, response) {
        //                 // $("#image_id").val(response.image_id);

        //                 var html = `<div class="card">
    //   <img src="${response.image}" class="card-img-top" alt="...">
    //   <div class="card-body">


    //     <a href="#" class="btn btn-danger">Delete</a>
    //   </div>
    // </div>`;

        //                 $("#product-gallery").append(html);
        //             }
        //         });
    </script>


    // {{-- <script>


    //     Dropzone.autoDiscover = false;
    //     const dropzone = $("#image").dropzone({
    //         init: function() {
    //             this.on('addedfile', function(file) {
    //                 if (this.files.length > 5) {
    //                     this.removeFile(this.files[0]);
    //                 }
    //             });
    //         },
    //         url: "{{ route('temp-images.create') }}",

    //         maxFiles: 5,
    //         paramName: 'image',
    //         addRemoveLinks: true,
    //         acceptedFiles: "image/jpeg,image/png,image/gif",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //         },
    //         success: function(file, response) {
    //             $("#image_id").val(response.image_id);
    //             //console.log(response)


    //                  var html = <div class="card"  >
    //                 <img src="${response.ImagePath}" class="card-img-top" alt=" ">
    //                 <div class="card-body">
    //                     <h5 class="card-title">Card title</h5>

    //                   <a href="#" class="btn btn-danger">Delete</a>
    //                 </div>
    //                   </div>

    //             $("#product-gallery").append(html);
    //         }

    //     });
    // </script> --}}
@endsection
