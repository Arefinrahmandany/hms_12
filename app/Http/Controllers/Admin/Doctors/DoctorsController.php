<?php

namespace App\Http\Controllers\Admin\Doctors;

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

        if ($request->chambers) {
            foreach ($request->chambers as $chamberData) {
                // skip if chamber name is empty (or any key field is missing)
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

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update($data);

        $doctor->chambers()->delete(); // reset chambers
        if ($request->chambers) {
            foreach ($request->chambers as $chamberData) {
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
