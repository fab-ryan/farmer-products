@extends('layouts/master')

@section('title', 'Products')
@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Cetegory /</span>
    </h4>

    <div class="card">
        <div class="card-header d-flex align-content-center  justify-content-between">
            <h5>Category Lists</h5>

            <x-button  style="primary btnCategory" type="button"
            text="Add Category"
            >Add Categories</x-button>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class='text-center'>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($categories as $category )
                        <tr class='text-center'>
                            <td> {{ $category->name}}
                            </td>
                            <td>
                                @if($category->status == 'active')
                                    <span class="badge bg-label-primary me-1">Active</span>
                                @else
                                    <span class="badge bg-label-danger me-1">Inactive</span>
                                @endif
                            </td>
                                <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                      <div class="dropdown-menu">
                                        <button  class="dropdown-item btnEdit"
                                        data-category="{{json_encode($category)}}"

                                        ><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                        <button class="dropdown-item btnDelete"
                                        data-category="{{json_encode($category)}}"
                                        ><i class="bx bx-trash me-1"></i> Delete</button>
                                      </div>
                                    </div>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="2">No Categories Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('categories.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <x-input
                                    label="Category Name"
                                    name="category_name"
                                    placeholder="Enter The Category name"
                                    type="text"
                                    parent_class="col-12"
                                />
                            </div>
                            <div class="row mt-3">
                                <x-select
                                    label="Category Status"
                                    name="status"
                                    placeholder="Category Status"
                                    parent_class="col-12"
                                    :options="['active' => 'Active', 'inactive' => 'Inactive']"
                                />
                            </div>
                            <div class="mt-4 d-flex justify-center">
                                <x-button
                                    style="primary"
                                    type="submit"
                                    text="Save"
                                    parent_class="col-12"
                                />

                                <x-button
                                    style="danger ml-4"
                                    type="button"
                                    text="Cancel"
                                    parent_class="col-12"
                                    data-bs-dismiss="modal"
                                    />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteCategoryModal"  tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" >
                            @csrf
                            @method('DELETE')

                            <div class="row">
                                <div class="col-12">
                                    <p>Are you sure you want to delete this category?</p>
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-center ">
                                <x-button
                                    style="primary"
                                    type="submit"
                                    text="Delete"
                                    parent_class="col-12"
                                />

                                <x-button
                                    style="danger ml-4"
                                    type="button"
                                    text="Cancel"
                                    parent_class="col-12"
                                    data-bs-dismiss="modal"
                                    />
                        </form>

                    </div>


                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
                $('.btnCategory').on('click', function () {

                    $('#categoryModal').modal('show');
                    $('#categoryModal .modal-title').text('Add New Category');
                });

                $('.btnEdit').on('click', function () {
                    const category = $(this).data('category');
                    console.log(category);
                  const modal =  $('#categoryModal').modal('show');
                    modal.find('.modal-title').text('Edit Category');
                    modal.find('form').attr('action', `{{route('categories.update','')}}/${category.id}` );
                    modal.find('form').append('<input type="hidden" name="_method" value="PUT">');
                    modal.find('form').find('[name="category_name"]').val(category.name);
                    modal.find('form').find('[name="status"]').val(category.status);
                    modal.find('.btn-primary').text('Update');

                });

                $('.btnDelete').on('click', function () {
                    const category = $(this).data('category');
                  const modal =  $('#deleteCategoryModal').modal('show');
                    modal.find('.modal-title').text('Delete Category');
                    modal.find('form').attr('action', `{{route('categories.destroy','')}}/${category.id}` );
                    modal.find('form').append('<input type="hidden" name="_method" value="DELETE">');
                    modal.find('.btn-primary').text('Delete');

                });
        </script>
    @endpush
