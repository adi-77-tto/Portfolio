@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <div class="grid" style="margin-bottom: 1rem;">
        <div class="card"><h2>Projects</h2><p>{{ $stats['projects'] }}</p></div>
        <div class="card"><h2>Skills</h2><p>{{ $stats['skills'] }}</p></div>
        <div class="card"><h2>Achievements</h2><p>{{ $stats['achievements'] }}</p></div>
        <div class="card"><h2>Work Experience</h2><p>{{ $stats['workExperience'] }}</p></div>
        <div class="card"><h2>Unread Messages</h2><p>{{ $stats['unreadMessages'] }}</p></div>
    </div>

    <div class="menu" style="padding:0;">
        <a class="btn" href="{{ route('admin.projects.index') }}">Manage Projects</a>
        <a class="btn" href="{{ route('admin.skills.index') }}">Manage Skills</a>
        <a class="btn" href="{{ route('admin.achievements.index') }}">Manage Achievements</a>
        <a class="btn" href="{{ route('admin.education.index') }}">Manage Education</a>
        <a class="btn" href="{{ route('admin.work-experience.index') }}">Manage Work Experience</a>
        <a class="btn" href="{{ route('admin.research.index') }}">Manage Research</a>
        <a class="btn" href="{{ route('admin.profile-images.index') }}">Profile Images</a>
        <a class="btn" href="{{ route('admin.messages.index') }}">View Messages</a>
        <a class="btn" href="{{ route('admin.settings.index') }}">Manage Settings</a>
    </div>
@endsection
