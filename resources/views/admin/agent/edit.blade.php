@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Agents</h1>
                    @include('admin.message')
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.agents.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <form action="{{ isset($agent) ? route('admin.agents.update', $agent->id) : route('admin.agents.store') }}" method="POST">
            @csrf
            @if(isset($agent))
                @method('PUT')
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', isset($agent) ? $agent->name : '') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', isset($agent) ? $agent->email : '') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', isset($agent) ? $agent->phone : '') }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">{{ isset($agent) ? 'Update' : 'Create' }}</button>
                <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
@endsection
