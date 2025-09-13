@extends('layouts.admin') <!-- extends the master layout -->

@section('admin-content')
    <!-- fills the main part -->
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">List of Doctors</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li>
                            <li class="breadcrumb-item active">Doctor</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 text-right m-b-20">
                        <a href="{{ route('admin.doctors.form') }}" class="btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Add Doctor</a>
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
                                            <th>Doctor Name</th>
                                            <th>Speciality</th>
                                            <th>Member Since</th>
                                            <th>Earned</th>
                                            <th>Account Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($doctors as $doctor)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="#" class="avatar avatar-sm mr-2">
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/admin/assets/img/doctors/doctor-thumb-01.jpg') }}"
                                                                alt="{{ $doctor->name }}">
                                                        </a>
                                                        <a href="#">{{ $doctor->name }}</a>
                                                    </h2>
                                                </td>

                                                <td>{{ $doctor->specialization }}</td>

                                                <td>
                                                    {{ $doctor->created_at->format('d M Y') }}
                                                    <br>
                                                    <small>{{ $doctor->created_at->format('h:i A') }}</small>
                                                </td>

                                                <td>
                                                    {{-- Example: show chamber count or phone number --}}
                                                    {{ $doctor->phone ?? 'N/A' }}
                                                </td>

                                                <td>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" id="status_{{ $doctor->id }}"
                                                            class="check" {{ $doctor->status ? 'checked' : '' }}>
                                                        <label for="status_{{ $doctor->id }}"
                                                            class="checktoggle"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.doctors.form', $doctor->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No doctors found.</td>
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

<script>
    document.querySelectorAll('.status-toggle .check').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            let doctorId = this.id.replace('status_', '');
            let status = this.checked ? 1 : 0;

            fetch(`/admin/doctors/status/${doctorId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Status updated:", data);
            });

        });
    });
</script>

@endsection
