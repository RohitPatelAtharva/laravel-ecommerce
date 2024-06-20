@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sub Category</h1>
                    @include('admin.message')
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('sub-categories.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('sub-categories.update',$subCategory->id)}}" method="post" name="categoryForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">



                                    <label for="cetegory">sub Category</label>
                                    <select name="category_id" id="category" class="form-control">

                                               @if ($categories->isNotEmpty())



                                            @foreach ($categories as $category)
                                                <option {{ $subCategory->category_id == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            @endif



                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        oninput="document.getElementById('slug').value=this.value"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{$subCategory->name}}">
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" readonly id="slug"
                                        class="form-control @error('slug') is-invalid @enderror" placeholder="Slug" value="{{$subCategory->slug}}">
                                    @error('slug')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $subCategory->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $subCategory->status == 0 ? 'selected' : '' }} value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Show on home</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ $subCategory->showhome == "Yes" ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option {{ $subCategory->showhome == "No" ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>

            </form>
        </div>
        <!-- /.card -->
    </section>

    <script>
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
    </script>

    <script>
        let message = document.getElementById("message");
        setTimeout(function() {
            message.style.display = 'none';
        }, 5000);
    </script>

< @endsection
