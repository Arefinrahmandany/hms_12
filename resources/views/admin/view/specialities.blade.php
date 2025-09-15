@extends('layouts.admin') <!-- extends the master layout -->

@section('admin-content')
    <!-- fills the main part -->
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Specialities</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Specialities</li>
                        </ul>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="#Add_Specialities_details" data-toggle="modal"
                            class="btn btn-primary float-right mt-2">Add</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Specialities</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($specialities as $speciality)
                                            <tr>
                                                <td>{{ $speciality->id }}</td>

                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html" class="avatar avatar-sm mr-2">
                                                            @if ($speciality->image)
                                                                <img src="{{ asset('storage/' . $speciality->image) }}"
                                                                    width="50">
                                                            @endif
                                                        </a>
                                                        <a href="profile.html">{{ $speciality->name }}</a>
                                                    </h2>
                                                </td>

                                                <td class="text-right">
                                                    <div class="actions">
                                                        <a href="javascript:void(0);" class="btn btn-sm bg-success-light edit-btn" data-id="{{ $speciality->id }}" data-toggle="modal" data-target="#edit_specialities_details"> <i class="fe fe-pencil"></i> Edit </a>

                                                        <a href="javascript:void(0);" class="btn btn-sm bg-danger-light delete-btn" data-url="{{ route('specialities.destroy', $speciality->id) }}" data-toggle="modal" data-target="#delete_modal"> <i class="fe fe-trash"></i> Delete </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No Specialities Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->


    <!-- Add Modal -->
    <div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Specialities</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('specialities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Specialities</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /ADD Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="edit_specialities_details" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Specialities</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row form-row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Specialities</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Edit Details Modal -->

    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-content p-2">
                        <h4 class="modal-title">Delete</h4>
                        <p class="mb-4">Are you sure you want to delete?</p>
                        <button type="button" id="confirmDelete" class="btn btn-primary">Yes, Delete</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
    </form>

<script>
    // Edit Speciality - works dynamically
    $(document).on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $.get('/admin/specialities/' + id + '/edit', function(data) {
            $('#editForm').attr('action', '/admin/specialities/' + id);
            $('#editForm input[name="name"]').val(data.name);
        });
    });

    // Delete Speciality - works dynamically
    let deleteUrl = '';

    $(document).on('click', '.delete-btn', function() {
        deleteUrl = $(this).data('url'); // get route from clicked button
        $('#delete_modal').modal('show'); // optional: ensure modal opens
    });

    $(document).on('click', '#confirmDelete', function() {
        if (deleteUrl) {
            $('#deleteForm').attr('action', deleteUrl).submit();
        }
    });
</script>


@endsection

