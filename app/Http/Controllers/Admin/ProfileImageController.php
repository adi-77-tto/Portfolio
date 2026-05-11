<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroImage;
use Illuminate\Http\Request;

class ProfileImageController extends Controller
{
    public function index()
    {
        $profileImages = HeroImage::all();
        return view('admin.profile-images.index', compact('profileImages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            HeroImage::create([
                'image_path' => 'storage/' . $path,
                'description' => $request->input('description', ''),
                'sort_order' => HeroImage::count(),
            ]);
        }

        return redirect()->back()->with('success', 'Profile image added successfully.');
    }

    public function update(Request $request, $id)
    {
        $profileImage = HeroImage::find($id);
        if (!$profileImage) {
            return redirect()->back()->with('error', 'Profile image not found.');
        }

        $request->validate([
            'description' => 'nullable|string|max:500',
        ]);

        $profileImage->description = $request->input('description', '');
        $profileImage->save();

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }

    public function destroy($id)
    {
        $profileImage = HeroImage::find($id);
        if ($profileImage) {
            $profileImage->delete();
        }

        return redirect()->back()->with('success', 'Profile image deleted successfully.');
    }
}
