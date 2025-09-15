<?php

namespace App\Http\Controllers\Admin\Doctors;

use Storage;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorsController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        $data['doctors'] = Doctor::all();
        return view('admin.doctors.doctors', $data);
    }

    // Show add/edit doctor form
    public function form($id = null){
        $doctor = null;
        $chambers = [];

        if ($id) {
            $doctor = Doctor::with('chambers')->findOrFail($id);
            $chambers = $doctor->chambers;
        }

        return view('admin.doctors.doctors_form', compact('doctor', 'chambers'));
    }

    public function store(Request $request)
    {
        $data = $request->except('chambers');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor = Doctor::create($data);

        // Save chambers if provided
        if ($request->has('chambers')) {
            foreach ($request->chambers as $chamberData) {
                if (!empty($chamberData['name'])) {
                    $doctor->chambers()->create($chamberData);
                }
            }
        }

        return redirect()->route('admin.doctors')->with('success', 'Doctor added successfully.');
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->except('chambers');

        // Handle photo update
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                \Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        // Update doctor info
        $doctor->update($data);

        // Reset chambers
        $doctor->chambers()->delete();

        foreach ($request->chambers as $chamberData) {
            if (!empty($chamberData['name'])) {
                if (isset($chamberData['working_days']) && is_array($chamberData['working_days'])) {
                    $chamberData['working_days'] = implode(',', $chamberData['working_days']);
                }
                $doctor->chambers()->create($chamberData);
            }
        }


        return redirect()->route('admin.doctors')->with('success', 'Doctor updated successfully.');
    }


    public function status(Request $request, Doctor $doctor)
    {
        $doctor->status = $request->input('status', 0);
        $doctor->save();

        return response()->json([
            'success' => true,
            'status' => $doctor->status
        ]);
    }

}
