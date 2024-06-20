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
        <form action="{{ route('product.update', $product->id) }}" id="productForm" name="productForm" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                                placeholder="Title" value="{{ $product->title }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" id="slug" class="form-control"
                                                placeholder="slug" value="{{ $product->slug }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Short_description</label>
                                            <textarea name="short_description" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description">{{ $product->short_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Shipping_description</label>
                                            <textarea name="shipping_returns" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description">{{ $product->shipping_returns }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <div id="imageContainer" class="dropzone dz-clickable" onclick="openImageFolder()">
                                    <div class="dz-message needsclick">
                                        <img src="{{ asset('admin-assets/products_img/' . $product->image) }}" alt=""
                                            class="img-fluid">
                                        <br>
                                    </div>
                                </div>
                                <input type="file" id="fileInput" name="image" style="" accept="image/*"
                                    value="{{ $product->image }}">
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
                                                placeholder="Price" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" value="{{ $product->compare_price }}" name="compare_price"
                                                id="compare_price" class="form-control" placeholder="Compare Price">
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
                                                placeholder="sku" value="{{ $product->sku }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Barcode</label>
                                            <input type="text" name="barcode" id="barcode" class="form-control"
                                                placeholder="Barcode" value="{{ $product->barcode }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="track_qty"
                                                    name="track_qty" value="Yes"
                                                    {{ $product->track_qty == 'Yes' ? 'checked' : '' }}>
                                                <label for="track_qty" class="custom-control-label">Track Quantity</label> 
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" min="0" name="qty" id="qty"
                                                value="{{ $product->qty }}" class="form-control" placeholder="Qty">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12 col-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <label for="">Related product</label>
                                        <div class="mb-3">
                                            <select multiple class="related-product w-100" name="related_products[]" id="related_products">
                                                @if(!empty($relatedProducts))
                                                @foreach($relatedProducts as $relProduct)
                                                <option selected value="{{$relProduct->id}}">{{$relProduct->title}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-12 col-12">

                                <div class="card mb-3 ">
                                    <h2 class="p-2">Related Products</h2>
                                    <div class="card-body ">
                                        <label for="">Related Tags</label>
                                        <a href="#" id="addNewTagLink" class="pl-5">Add New Tag</a>
                                        <div class="mb-3">
                                            <select multiple class="related-tags w-100" name="related_tags[]"
                                            id="related_tags">
                                                 
                                                @if(!empty($tagNames))
                                                @foreach($tagNames as $tag)
                                                    <option selected value="{{ $tag }}">{{ $tag }}</option>
                                                @endforeach
                                            @endif
                                                
                                            </select>
                                        </div>
    
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
                                        <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Block</option>
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
                                                <option {{ $product->category_id == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                        }
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="category">Sub category</label>
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Select SubCategory</option>
                                        @if ($subCategories->isNotEmpty())
                                            {
                                            @foreach ($subCategories as $subCategory)
                                                <option
                                                    {{ $product->sub_category_id == $subCategory->id ? 'selected' : '' }}
                                                    value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        @endif
                                        }

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
                                                <option {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                    value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                        <option {{ $product->is_featured == 'NO' ? 'selected' : '' }} value="No">No
                                        </option>
                                        <option {{ $product->is_featured == 'Yes' ? 'selected' : '' }} value="Yes">Yes
                                        </option>
                                    </select>
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
        $('.related-product').select2({
            ajax: {
                url: '{{route("product.getProducts")}}',
                dataType: 'json',
                tags: true,
                multiple:true,
                minimumInputLength:3,
                processResults:function(data){
                    return{
                        results:data.tags
                    };
                }

            }
        });
        $('.related-tags').select2({
            tags: true,
            tokenSeparators: [','],
            createTag: function(params) {
                var term = $.trim(params.term);
                return term === '' ? null : {
                    id: term,
                    text: term,
                    newTag: true
                };
            },
            insertTag: function(data, tag) {
                data.push(tag);
            },
            ajax: {
                url: '{{ route('product.getTags') }}',
                dataType: 'json',
                multiple: true,
                minimumInputLength: 3,
                processResults: function(data) {
                    return {
                        results: data && data.tags ? data.tags.map(tag => ({
                            id: tag.id,
                            text: tag.name
                        })) : []
                    };
                }
            }
        });

        $('#addNewTagLink').click(function(event) {
            event.preventDefault();
            var newTagName = prompt("Enter the new tag name:");
            if (newTagName) {
                $('.related-tags').append(new Option(newTagName, newTagName, true, true)).trigger('change');
                $.ajax({
                    url: '{{ route('tags.add') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: newTagName
                    },
                    success: () => console.log("Tag added successfully!"),
                    error: (xhr, status, error) => console.error("Error adding tag:", error)
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

    //  ==============for tag============
    

    // =============for disapear message


     
    // Wait for the page to load
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
