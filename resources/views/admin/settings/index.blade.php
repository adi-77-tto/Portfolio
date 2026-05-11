@extends('layouts.app')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <h2>Manage Settings</h2>
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 1rem;">
            <label style="font-weight: bold; display: block;">Resume PDF</label>
            <small style="color: var(--muted); display: block; margin-bottom: 0.5rem;">Upload your resume PDF here. It will be readable and downloadable on the frontend.</small>
            @if(!empty($settings['resume_file']))
                <div style="margin-bottom: 0.5rem;">
                    <a class="badge" href="{{ asset($settings['resume_file']) }}" target="_blank" style="color: var(--accent);">View Current Resume PDF</a>
                </div>
            @endif
            <input type="file" name="resume_file" accept="application/pdf">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="font-weight: bold;">Name</label>
            <input type="text" name="name" value="{{ $settings['name'] ?? '' }}">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="font-weight: bold;">Title</label>
            <input type="text" name="title" value="{{ $settings['title'] ?? '' }}">
        </div>

        <div style="margin-bottom: 1rem;">
            <label style="font-weight: bold;">Bio</label>
            <textarea name="bio" rows="4">{{ $settings['bio'] ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn">Save Settings</button>
    </form>
</div>
@endsection
