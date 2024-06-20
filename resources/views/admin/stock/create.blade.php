@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Stock</h1>
                    @include('admin.message')
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('brands.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('stock.store') }}" method="post" name="brandsForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product(Choose Product )</h2>
                                
                                <div class="mb-3">
                                    <select name="name" id="product" class="form-control @error('name') is-invalid @enderror">
                                        <option  value="" disabled selected
                                    >---------------select Product---------</option>
                                        @if ($product->isNotEmpty())
                                            @foreach ($product as $item)
                                            <option value="{{ $item->title }}">{{ $item->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h2 class="h4 mb-3">Pricing</h2>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="price">MRP</label>
                                                            <input type="text" name="mrp" id="price"
                                                                class="form-control  @error('mrp') is-invalid @enderror " placeholder="Price">
                                                                @error('mrp')
                                                                <p class="invalid-feedback">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="compare_price">Selling at Price</label>
                                                            <input type="text" name="selling_price" id="compare_price"
                                                                class="form-control" placeholder="Compare Price">
                                                            <p class="text-muted mt-3">
                                                                To show a reduced price, move the product’s original price
                                                                into Compare at
                                                                price. Enter a lower value into Price.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h2 class="h4 mb-3">Inventory</h2>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="sku">SKU (Stock Keeping Unit)</label>
                                                            <input type="text" name="sku" id="sku" class="form-control @error('sku') is-invalid @enderror"
                                                                placeholder="sku">
                                                                @error('sku')
                                                                <p class="invalid-feedback">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="barcode">Barcode</label>
                                                            <input type="text" name="barcode" id="barcode" class="form-control"
                                                                placeholder="Barcode">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label for="alert_stock">Alert Stock( Out Of Stock)</label>
                                                            <input type="text" name="alert_stock" id="out_stock" class="form-control @error('alert_stock') is-invalid @enderror"
                                                                placeholder="Alert Stock Qty">
                                                                @error('alert_stock')
                                                                <p class="invalid-feedback">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="track_qty"
                                                                name="track_qty" checked>
                                                            <label for="track_qty"  class="custom-control-label">Track Quantity</label>
                                                        </div>
                                                        <div class="mb-3">
                                                            <input type="number" min="0" name="qty" id="qty"
                                                                class="form-control" placeholder="Qty">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('brands.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('customjs')
    <script>
        let message = document.getElementById("message");
        setTimeout(function() {
            message.style.display = 'none';
        }, 5000);
    </script>
@endsection
