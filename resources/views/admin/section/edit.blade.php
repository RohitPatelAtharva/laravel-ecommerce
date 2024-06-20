@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
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
            <form action="{{ route('sections.store') }}" method="post" name="categoryForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control @error('title') is-invalid @enderror" placeholder="title">
                                        @error('title')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror" placeholder="slug">
                                    @error('slug')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                        placeholder="Description"></textarea>
                                </div>
                                {{-- <input type="file" id="fileInput" name="image" style="" accept="image/*"> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Max Quantity">Max Quantity</label>
                                <input type="number" name="max_quantity" id="max_quantity"
                                    class="form-control @error('max_quantity') is-invalid @enderror"
                                    placeholder="max_quantity">
                                @error('max_quantity')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        <div class="pb-5 pt-3">
            <button class="btn btn-primary">Create</button>
            <a href="{{ route('sections.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

        </form>
        </div>
        <!-- /.card -->
    </section>
@endsection

@section('customjs')
    <script>
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
    </script>
@endsection
