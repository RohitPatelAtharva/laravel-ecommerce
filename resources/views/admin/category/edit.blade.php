@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
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
            <form action="{{ route('categories.store') }}" method="post" name="categoryForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{$category->name}}" id="name"
                                        oninput="document.getElementById('slug').value=this.value"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" readonly id="slug" value="{{$category->slug}}"
                                        class="form-control @error('slug') is-invalid @enderror" placeholder="Slug">
                                    @error('slug')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div id="imageContainer" class="dropzone dz-clickable" onclick="openImageFolder()">
                                        <div class="dz-message needsclick">
                                            @if (!empty($category->image))


                                            <img id="imageDisplay" src="{{asset('admin-assets/images'.$category->image)}}" alt="Uploaded Image"
                                                style="display: none;width:100%" class="img-fluid">
                                                @endif

                                            <br>
                                            <p id="upload">Drop file here or click to upload.</p> <br><br>

                                        </div>

                                    </div>
                                    <input type="file" id="fileInput" name="image" value="{{$category->image}}" style="" accept="image/*">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{($category->status==1)?'selected':''}} value="1">Active</option>
                                        <option {{($category->status==0)?'selected':''}}  value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Show on home</label>
                                    <select name="showhome" id="status" class="form-control">
                                        <option  {{($category->showhome=='Yes')?'selected':''}} value="Yes">Yes</option>
                                        <option {{($category->showhome=='No')?'selected':''}} value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>

            </form>
        </div>
        <!-- /.card -->
    </section>


@endsection

@section('customjs')
<script>
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
</script>
@endsection
