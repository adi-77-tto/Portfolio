<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function index()
    {
        $research = Research::all();
        return view('admin.research.index', compact('research'));
    }

    public function create()
    {
        return view('admin.research.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'abstract' => 'nullable|string',
            'team_members' => 'required|string',
            'status' => 'required|in:published,in_progress',
            'year' => 'required|integer|min:2000|max:2099',
            'paper_link' => 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'abstract', 'team_members', 'status', 'year', 'paper_link']);

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('research_pdfs', 'public');
            $data['pdf_file'] = 'storage/' . $path;
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('research_images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $data['sort_order'] = Research::count();
        Research::create($data);

        return redirect()->route('admin.research.index')->with('success', 'Research added successfully.');
    }

    public function edit($id)
    {
        $research = Research::findOrFail($id);
        return view('admin.research.edit', compact('research'));
    }

    public function update(Request $request, $id)
    {
        $research = Research::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'abstract' => 'nullable|string',
            'team_members' => 'required|string',
            'status' => 'required|in:published,in_progress',
            'year' => 'required|integer|min:2000|max:2099',
            'paper_link' => 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'abstract', 'team_members', 'status', 'year', 'paper_link']);

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('research_pdfs', 'public');
            $data['pdf_file'] = 'storage/' . $path;
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('research_images', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $research->update($data);

        return redirect()->route('admin.research.index')->with('success', 'Research updated successfully.');
    }

    public function destroy($id)
    {
        Research::findOrFail($id)->delete();
        return redirect()->route('admin.research.index')->with('success', 'Research deleted successfully.');
    }
}
