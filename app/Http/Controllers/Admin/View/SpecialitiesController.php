<?php

namespace App\Http\Controllers\Admin\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Speciality;
use App\Http\Controllers\Controller;


class SpecialitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['specialities'] = Speciality::latest()->get();
        return view('admin.view.specialities',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('specialities', 'public');
        }

         // Generate code
            $last = Speciality::latest('id')->first();
            $nextId = $last ? $last->id + 1 : 1;
            $data['code'] = 'SP' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Speciality::create($data);

        return redirect()->back()->with('success', 'Speciality created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speciality $speciality)
    {
        return response()->json($speciality); // for ajax modal
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speciality $speciality)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->only('name');

        if ($request->hasFile('image')) {
            if ($speciality->image) {
                Storage::disk('public')->delete($speciality->image);
            }
            $data['image'] = $request->file('image')->store('specialities', 'public');
        }

        $speciality->update($data);

        return redirect()->back()->with('success', 'Speciality updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speciality $speciality)
    {
        if ($speciality->image) {
            Storage::disk('public')->delete($speciality->image);
        }
        $speciality->delete();
        return redirect()->back()->with('success', 'Speciality deleted successfully!');
    }
}
