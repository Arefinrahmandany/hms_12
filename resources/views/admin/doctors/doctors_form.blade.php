@extends('layouts.admin') <!-- extends the master layout -->

@section('admin-content')
    <!-- fills the main part -->

    <div class="container">
        <div class="card p-4 mb-5">
            <h2>{{ isset($doctor) ? 'Edit Doctor' : 'Add Doctor' }}</h2>

            <form action="{{ isset($doctor) ? route('admin.doctors.update', $doctor->id) : route('admin.doctors.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($doctor))
                    @method('PUT')
                @endif

                <div class="row">
                    <!-- Basic Info -->
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name ?? '') }}"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $doctor->email ?? '') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', $doctor->phone ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $doctor->dob ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">-- Select Gender --</option>
                            <option value="Male" {{ old('gender', $doctor->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ old('gender', $doctor->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                Female</option>
                            <option value="Other" {{ old('gender', $doctor->gender ?? '') == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Photo</label>
                        <input type="file" name="photo" class="form-control">
                        @if (isset($doctor) && $doctor->photo)
                            <img src="{{ asset('storage/' . $doctor->photo) }}" width="80" class="mt-2">
                        @endif
                    </div>

                    <!-- Professional Info -->
                    <div class="col-md-6 mb-3">
                        <label>Specialization</label>
                        <input type="text" name="specialization" class="form-control"
                            value="{{ old('specialization', $doctor->specialization ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Qualification</label>
                        <input type="text" name="qualification" class="form-control"
                            value="{{ old('qualification', $doctor->qualification ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Experience (Years)</label>
                        <input type="number" name="experience" class="form-control"
                            value="{{ old('experience', $doctor->experience ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Degree</label>
                        <input type="text" name="degree" class="form-control"
                            value="{{ old('degree', $doctor->degree ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Registration Number</label>
                        <input type="text" name="registration_number" class="form-control"
                            value="{{ old('registration_number', $doctor->registration_number ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Department</label>
                        <input type="text" name="department" class="form-control"
                            value="{{ old('department', $doctor->department ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Languages</label>
                        <input type="text" name="languages" class="form-control"
                            value="{{ old('languages', $doctor->languages ?? '') }}" placeholder="English, Bengali">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Biography</label>
                        <textarea name="bio" class="form-control" rows="3">{{ old('bio', $doctor->bio ?? '') }}</textarea>
                    </div>
                </div>

                <hr>

                <!-- Chambers Section -->
                <h4>Chambers</h4>
                <div id="chambers-container">
                    @if (isset($doctor) && $doctor->chambers)
                        @foreach ($doctor->chambers as $i => $chamber)
                            <div class="chamber-row border p-3 mb-2">
                                <input type="text" name="chambers[{{ $i }}][name]" value="{{ $chamber->name }}"
                                    placeholder="Chamber Name" class="form-control mb-2">
                                <input type="text" name="chambers[{{ $i }}][address]"
                                    value="{{ $chamber->address }}" placeholder="Address" class="form-control mb-2">
                                <input type="text" name="chambers[{{ $i }}][phone]"
                                    value="{{ $chamber->phone }}" placeholder="Phone" class="form-control mb-2">
                                <input type="text" name="chambers[{{ $i }}][country]"
                                    value="{{ $chamber->country }}" placeholder="Country" class="form-control mb-2">
                                <input type="text" name="chambers[{{ $i }}][city]" value="{{ $chamber->city }}"
                                    placeholder="City" class="form-control mb-2">
                                <input type="time" name="chambers[{{ $i }}][start_time]"
                                    value="{{ $chamber->start_time }}" class="form-control mb-2">
                                <input type="time" name="chambers[{{ $i }}][end_time]"
                                    value="{{ $chamber->end_time }}" class="form-control mb-2">
                                <div class="mb-2">
                                    <label>Working Days:</label><br>
                                    @php
                                        $days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
                                        $selectedDays = isset($chamber->working_days) ? explode(',', $chamber->working_days) : [];
                                    @endphp
                                    @foreach($days as $day)
                                        <label class="me-2">
                                            <input type="checkbox" name="chambers[{{ $i }}][working_days][]"
                                                value="{{ $day }}"
                                                {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                            {{ $day }}
                                        </label>
                                    @endforeach
                                </div>

                                <input type="number" step="0.01" name="chambers[{{ $i }}][consultation_fee]"
                                    value="{{ $chamber->consultation_fee }}" placeholder="Consultation Fee"
                                    class="form-control mb-2">
                                <button type="button" class="btn btn-danger remove-chamber">Remove</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <button type="button" id="add-chamber" class="btn btn-secondary">+ Add Chamber</button>

                <hr>

                <button type="submit" class="btn btn-primary">
                    {{ isset($doctor) ? 'Update Doctor' : 'Save Doctor' }}
                </button>
            </form>
        </div>
    </div>

    {{-- JS for dynamic chambers --}}
    <script>
        document.getElementById('add-chamber').addEventListener('click', function() {
            let container = document.getElementById('chambers-container');
            let index = container.querySelectorAll('.chamber-row').length;
            let row = document.createElement('div');
            row.classList.add('chamber-row', 'border', 'p-3', 'mb-2');
            row.innerHTML = `
                <input type="text" name="chambers[${index}][name]" placeholder="Chamber Name" class="form-control mb-2">
                <input type="text" name="chambers[${index}][address]" placeholder="Address" class="form-control mb-2">
                <input type="text" name="chambers[${index}][phone]" placeholder="Phone" class="form-control mb-2">
                <input type="text" name="chambers[${index}][country]" placeholder="Country" class="form-control mb-2">
                <input type="text" name="chambers[${index}][city]" placeholder="City" class="form-control mb-2">
                <input type="time" name="chambers[${index}][start_time]" class="form-control mb-2">
                <input type="time" name="chambers[${index}][end_time]" class="form-control mb-2">
                <div class="mb-2">
                    <label>Working Days:</label><br>
                    <label class="me-2"><input type="checkbox" name="chambers[${index}][working_days][]" value="Mon"> Mon</label>
                    <label class="me-2"><input type="checkbox" name="chambers[${index}][working_days][]" value="Tue"> Tue</label>
                    <label class="me-2"><input type="checkbox" name="chambers[${index}][working_days][]" value="Wed"> Wed</label>
                    <label class="me-2"><input type="checkbox" name="chambers[${index}][working_days][]" value="Thu"> Thu</label>
                    <label class="me-2"><input type="checkbox" name="chambers[${index}][working_days][]" value="Fri"> Fri</label>
                    <label class="me-2"><input type="checkbox" name="chambers[${index}][working_days][]" value="Sat"> Sat</label>
                    <label class="me-2"><input type="checkbox" name="chambers[${index}][working_days][]" value="Sun"> Sun</label>
                </div>
                <input type="number" step="0.01" name="chambers[${index}][consultation_fee]" placeholder="Consultation Fee" class="form-control mb-2">
                <button type="button" class="btn btn-danger remove-chamber">Remove</button>
            `;
            container.appendChild(row);

            row.querySelector('.remove-chamber').addEventListener('click', function() {
                row.remove();
            });
        });

        // Remove existing chambers
        document.querySelectorAll('.remove-chamber').forEach(btn => {
            btn.addEventListener('click', function() {
                btn.closest('.chamber-row').remove();
            });
        });
    </script>

@endsection
