<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach (['name', 'title', 'bio', 'image_caption', 'social_scholar', 'social_linkedin', 'social_github', 'social_orcid'] as $key) {
            Setting::set($key, $request->input($key));
        }

        if ($request->hasFile('resume_file')) {
            $path = $request->file('resume_file')->store('settings', 'public');
            Setting::set('resume_file', 'storage/' . $path);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
