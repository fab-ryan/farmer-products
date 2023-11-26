@extends('layouts/master')

@push('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('/assets/summernote/summernote-bs4.min.css') }}">
@endpush

@section('title', 'Products')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Edit Product
    </h4>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <!-- Basic -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <form action='{{ route('products.update', $product->id) }}' method='POST' enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <x-input label="Product Name" name="product_name" placeholder="Enter The Product name"
                                value="{{ $product->product_name }}" is_edit="true" type="text" />
                            <x-input label="Product Quantiy" name="product_quantity" value="{{ $product->quantity }}"
                                is_edit="true" placeholder="Enter The Product Quantity" type="number" />
                        </div>
                        <div class="row mt-3">
                            <x-select label="Product Unity" name="product_unit" placeholder="Select Product Unity"
                                selected="{{ $product->unit }}" :options="[
                                    'Ton' => 'Ton',
                                    'Kg' => 'KG',
                                    'L' => 'L',
                                    'Unit' => 'Unit',
                                    'Box' => 'Box',
                                    'Package' => 'Package',
                                    'Other' => 'Other',
                                ]" />
                            <x-select label="Product Category" name="product_category" placeholder="Select Product Category"
                                selected="{{ $product->category_id }}"
                                :options="$categories" is_db="true" />
                        </div>
                        <div class="row mt-3">
                            <x-input label="Harvest Date" name="harvest_date" placeholder="Enter The Harvest Date"
                                value="{{ $product->harvest_date }}" is_edit="true"
                                type="date" />
                            <x-input label="Harvest Time" name="harvest_time" placeholder="Enter The Harvest Time"
                                value="{{ $product->harvest_time }}" is_edit="true"
                                type="time" />
                        </div>
                        <div class="row mt-3">
                            <x-input label="Unity Price" name="unit_price" placeholder="Enter The Unity Price"
                                value="{{ $product->unit_price }}" is_edit="true"
                                type="number" />

                            <x-select label="Product Status" name="product_status" placeholder="Select Product Status"
                                selected="{{ $product->status }}"
                                :options="[
                                    'active' => 'Active',
                                    'inactive' => 'Inactive',
                                ]" />
                        </div>


                        <div class="row mt-3">
                            <label class="form-label">Product Images</label>
                            <div class="input-group">
                                <input type="file"
                                    class="form-control
                                    @error('product_images') is-invalid @enderror
                                "
                                    name="product_images[]" id="productImages" multiple>
                            </div>
                            @error('product_images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="product-images-preview mt-3 row">
                            </div>
                        </div>
                        <div class="row">
                            <x-textarea label="Product Description" name="product_description" parent_class="col-12"
                                value="{{ $product->description }}" is_edit="true"
                                placeholder="Enter The Product Description" id="summernote" />
                        </div>

                        <div class="row mt-3">
                            <x-button style="primary" type="submit" text="Update" parent_class="col-12" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('/assets/summernote/summernote-bs4.min.js') }}"></script>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#productImages').on('change', function() {
                var files = $(this)[0].files;
                var preview = $('.product-images-preview');
                preview.html('');
                if (files.length > 0) {
                    $.each(files, function(i, file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            var html = `<div class="col-3">
                                            <div class="card">
                                                <div class="img-responsive">
                                                <img src="${e.target.result}" class="card-img-top" alt="...">
                                                </div>

                                            </div>
                                        </div>`;
                            preview.append(html);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });

            $(document).on('click', '.removeImage', function() {
                $(this).closest('.col-3').remove();
                // remove it in input also
                var image = $(this).data('image');
                var input = $('#productImages');
                var files = input[0].files;
                var newFiles = [];
                $.each(files, function(i, file) {
                    if (file != image) {
                        newFiles.push(file);
                    }
                });
                input[0].files = newFiles;

            });
        });
    </script>
@endpush
