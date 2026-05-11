@extends('layouts.app')

@section('title', 'Add Education')

@section('content')
<div class="admin-header">
    <h1>Add Education</h1>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.education.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
    @csrf

    <div class="form-group">
        <label for="degree_name">Degree Name *</label>
        <input type="text" id="degree_name" name="degree_name" value="{{ old('degree_name') }}" placeholder="e.g., BSc Engineering in CSE" required class="form-input">
    </div>

    <div class="form-group">
        <label for="institution_name">Institution Name *</label>
        <input type="text" id="institution_name" name="institution_name" value="{{ old('institution_name') }}" placeholder="e.g., Bangladesh University of Engineering and Technology" required class="form-input">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="start_date">Start Date *</label>
            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required class="form-input">
        </div>

        <div class="form-group">
            <label for="end_date">End Date (Leave blank for current)</label>
            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="form-input">
        </div>
    </div>

    <div class="form-group">
        <label for="logo">Logo Image (Max 2MB)</label>
        <input type="file" id="logo" name="logo" accept="image/*" class="form-input">
    </div>

    <div class="form-group">
        <label for="honors_achievements">Honors & Achievements</label>
        <textarea id="honors_achievements" name="honors_achievements" rows="4" placeholder="e.g., Cumulative GPA 3.90&#10;Deans List in Level 4" class="form-textarea">{{ old('honors_achievements') }}</textarea>
        <small style="color: var(--muted);">Enter each achievement on a new line</small>
    </div>

    <div class="form-group">
        <label for="scholarships">Scholarships</label>
        <textarea id="scholarships" name="scholarships" rows="4" placeholder="e.g., Full Scholarship (1st rank)&#10;Merit Scholarship 2025" class="form-textarea">{{ old('scholarships') }}</textarea>
        <small style="color: var(--muted);">Enter each scholarship on a new line</small>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Add Education</button>
        <a href="{{ route('admin.education.index') }}" class="btn-secondary">Cancel</a>
    </div>
</form>

<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.admin-header h1 {
    margin: 0;
    font-size: 1.75rem;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #f5c6cb;
}

.alert-danger ul {
    margin: 0;
    padding-left: 1.5rem;
}

.alert-danger li {
    margin: 0.5rem 0;
}

.form-container {
    background: var(--surface);
    padding: 2rem;
    border-radius: 0.5rem;
    max-width: 800px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--ink);
}

.form-input,
.form-textarea,
.form-select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--line);
    border-radius: 0.375rem;
    font-size: 1rem;
    font-family: inherit;
    background: white;
    color: var(--ink);
    transition: border-color 0.2s;
}

.form-input:focus,
.form-textarea:focus,
.form-select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(var(--accent-rgb), 0.1);
}

.form-textarea {
    resize: vertical;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-primary,
.btn-secondary {
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: opacity 0.2s;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: var(--accent);
    color: white;
}

.btn-primary:hover {
    opacity: 0.9;
}

.btn-secondary {
    background: var(--line);
    color: var(--ink);
}

.btn-secondary:hover {
    opacity: 0.8;
}
</style>
@endsection
