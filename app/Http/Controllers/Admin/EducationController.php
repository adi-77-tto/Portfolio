<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::all();
        return view('admin.education.index', compact('education'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'degree_name' => 'required|string|max:255',
            'institution_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'honors_achievements' => 'nullable|string',
            'scholarships' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['degree_name', 'institution_name', 'start_date', 'end_date', 'honors_achievements', 'scholarships']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('education_logos', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $data['sort_order'] = Education::count();
        Education::create($data);

        return redirect()->route('admin.education.index')->with('success', 'Education added successfully.');
    }

    public function edit($id)
    {
        $education = Education::findOrFail($id);
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $request->validate([
            'degree_name' => 'required|string|max:255',
            'institution_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'honors_achievements' => 'nullable|string',
            'scholarships' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['degree_name', 'institution_name', 'start_date', 'end_date', 'honors_achievements', 'scholarships']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('education_logos', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $education->update($data);

        return redirect()->route('admin.education.index')->with('success', 'Education updated successfully.');
    }

    public function destroy($id)
    {
        Education::findOrFail($id)->delete();
        return redirect()->route('admin.education.index')->with('success', 'Education deleted successfully.');
    }
}
