@extends('layouts.app')

@section('title', 'Edit Work Experience')

@section('content')
<div class="admin-header">
    <h1>Edit Work Experience</h1>
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

<form action="{{ route('admin.work-experience.update', $workExperience->id) }}" method="POST" enctype="multipart/form-data" class="form-container">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="company_name">Company Name *</label>
        <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $workExperience->company_name) }}" required class="form-input">
    </div>

    <div class="form-group">
        <label for="position">Position *</label>
        <input type="text" id="position" name="position" value="{{ old('position', $workExperience->position) }}" required class="form-input">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="start_date">Start Date *</label>
            <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $workExperience->start_date->format('Y-m-d')) }}" required class="form-input">
        </div>

        <div class="form-group">
            <label for="end_date">End Date (Leave blank for current)</label>
            <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $workExperience->end_date ? $workExperience->end_date->format('Y-m-d') : '') }}" class="form-input">
        </div>
    </div>

    <div class="form-group">
        <label for="logo">Company Logo (Max 2MB)</label>
        @if ($workExperience->logo)
        <div class="logo-preview">
            <img src="{{ asset($workExperience->logo) }}" alt="Logo" style="max-width: 100px; max-height: 100px; border-radius: 50%;">
        </div>
        @endif
        <input type="file" id="logo" name="logo" accept="image/*" class="form-input">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="6" class="form-textarea">{{ old('description', $workExperience->description) }}</textarea>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Update Work Experience</button>
        <a href="{{ route('admin.work-experience.index') }}" class="btn-secondary">Cancel</a>
    </div>
</form>

<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--line, #e5e7eb);
}

.admin-header h1 {
    margin: 0;
    font-size: 1.75rem;
}

.form-container {
    background: var(--surface, white);
    padding: 2rem;
    border-radius: 0.75rem;
    max-width: 700px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--ink, #111827);
}

.form-input, .form-textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid var(--line, #e5e7eb);
    border-radius: 0.5rem;
    font-family: inherit;
    font-size: 1rem;
    background: var(--surface, white);
    color: var(--ink, #111827);
}

.form-textarea {
    resize: vertical;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', 'Consolas', monospace;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-primary, .btn-secondary {
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: var(--accent, #2563eb);
    color: white;
}

.btn-primary:hover {
    opacity: 0.9;
}

.btn-secondary {
    background: var(--line, #e5e7eb);
    color: var(--ink, #111827);
}

.btn-secondary:hover {
    opacity: 0.8;
}

.logo-preview {
    margin-bottom: 1rem;
}

.alert {
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background: #fee;
    color: #c33;
    border: 1px solid #fcc;
}

.alert-danger ul {
    margin: 0;
    padding-left: 1.5rem;
}

.alert-danger li {
    margin-bottom: 0.25rem;
}
</style>
@endsection
