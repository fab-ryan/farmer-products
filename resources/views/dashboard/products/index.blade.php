@extends('layouts/master')

@section('title', 'Products')
@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Product /</span> Product Lists
    </h4>
    <div class="card">
        <div class="card-header d-flex align-content-center  justify-content-between">
            <h5>Product Lists</h5>

            <a href="{{ route('products.create') }}" class="btn btn-primary" type="button">Add Products</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price Unity</th>
                        <th>Category</th>
                        <th>Harvest Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($products as $product)
                        <tr>
                            <td> {{ $product->product_name }}
                            </td>
                            <td> {{ $product->quantity }} {{ $product->unit }} </td>
                            <td> {{ $product->unit_price }} RWF</td>
                            <td> {{ $product->category->name }} </td>
                            <td> {{ $product->harvest_date }} </td>
                            <td>
                                @if ($product->status == 'active')
                                    <span class="badge bg-label-primary me-1">Active</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('products.update', $product->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <button class="dropdown-item btnDelete"
                                            data-product="{{ json_encode($product) }}"><i class="bx bx-trash me-1"></i>
                                            Delete</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7">No Products Found</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        @csrf
                        @method('DELETE')

                        <div class="row">
                            <div class="col-12">
                                <p>Are you sure you want to delete this Product?</p>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-center ">
                            <x-button style="primary" type="submit" text="Delete" parent_class="col-12" />

                            <x-button style="danger ml-4" type="button" text="Cancel" parent_class="col-12"
                                data-bs-dismiss="modal" />
                    </form>

                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btnDelete').click(function() {

                var product = $(this).data('product');
                $('#deleteProductModal form').attr('action', '/products/' + product?.id);
                $('#deleteProductModal form').append('<input type="hidden" name="product_id" value="' +
                    product?.id + '">');
                $('#deleteProductModal').modal('show');
            });
        });
    </script>
@endpush
