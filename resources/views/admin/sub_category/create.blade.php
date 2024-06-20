@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Sub Category</h1>
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
            <form action="{{route('sub-categories.store')}}" method="post" name="categoryForm"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">



                                    <label for="cetegory">Category</label>
                                    <select name="category_id" id="category" class="form-control">

                                        <option value="">---select---</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $data)
                                                <option value=" {{ $data->id }}"> {{ $data->name }}</option>
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
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" readonly id="slug"
                                        class="form-control @error('slug') is-invalid @enderror" placeholder="Slug"  >
                                    @error('slug')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status"             class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Show on home</label>
                                    <select name="showhome" id="status" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
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
