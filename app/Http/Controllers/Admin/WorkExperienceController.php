<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $workExperience = WorkExperience::all();
        return view('admin.work-experience.index', compact('workExperience'));
    }

    public function create()
    {
        return view('admin.work-experience.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['company_name', 'position', 'start_date', 'end_date', 'description']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('work_experience_logos', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $data['sort_order'] = WorkExperience::count();
        WorkExperience::create($data);

        return redirect()->route('admin.work-experience.index')->with('success', 'Work experience added successfully.');
    }

    public function edit($id)
    {
        $workExperience = WorkExperience::findOrFail($id);
        return view('admin.work-experience.edit', compact('workExperience'));
    }

    public function update(Request $request, $id)
    {
        $workExperience = WorkExperience::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['company_name', 'position', 'start_date', 'end_date', 'description']);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('work_experience_logos', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        $workExperience->update($data);

        return redirect()->route('admin.work-experience.index')->with('success', 'Work experience updated successfully.');
    }

    public function destroy($id)
    {
        WorkExperience::findOrFail($id)->delete();
        return redirect()->route('admin.work-experience.index')->with('success', 'Work experience deleted successfully.');
    }
}
