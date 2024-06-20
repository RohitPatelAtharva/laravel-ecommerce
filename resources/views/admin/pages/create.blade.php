@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Pages
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
            <form  id="pageForm" method="post" name="pageForm">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        oninput="document.getElementById('slug').value=this.value"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                        <p></p>
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="slug">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="summernote" cols="30" rows="10"></textarea>
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


     $("#pageForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        console.log('hello');
            $.ajax({
                url:'{{route("pages.store")}}',
                type:'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {
            window.location.href="{{route('pages.index')}}"

            $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    } else {
                        var errors =response['errors'];
                        if(errors['name']){
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                        }else{
                            $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }
                        if(errors['slug']){
                            $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
                        }

                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });

        });




        $("#title").change(function() {
            element = $(this);
            $("button[type=submit]").prop('disabled', true);



            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: {
                    title: element.val()
                },
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true) {
                        window.location.href="{{route('categories.index')}}"
                    }
                }




            });
        });






    </script>
@endsection
