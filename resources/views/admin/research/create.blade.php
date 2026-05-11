@extends('layouts.app')

@section('title', 'Add Research')

@section('content')
<div class="admin-header">
    <h1>Add Research</h1>
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

<form action="{{ route('admin.research.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
    @csrf

    <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-input">
    </div>

    <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="4" required class="form-textarea">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
        <label for="abstract">Abstract</label>
        <textarea id="abstract" name="abstract" rows="4" class="form-textarea">{{ old('abstract') }}</textarea>
    </div>

    <div class="form-group">
        <label for="team_members">Team Members *</label>
        <input type="text" id="team_members" name="team_members" value="{{ old('team_members') }}" placeholder="e.g., John Doe, Jane Smith" required class="form-input">
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="status">Status *</label>
            <select id="status" name="status" required class="form-select">
                <option value="">Select Status</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
            </select>
        </div>

        <div class="form-group">
            <label for="year">Year *</label>
            <input type="number" id="year" name="year" value="{{ old('year', date('Y')) }}" min="2000" max="2099" required class="form-input">
        </div>
    </div>

    <div class="form-group">
        <label for="paper_link">Paper Link (URL)</label>
        <input type="url" id="paper_link" name="paper_link" value="{{ old('paper_link') }}" placeholder="https://example.com" class="form-input">
    </div>

    <div class="form-group">
        <label for="pdf_file">PDF File (Max 10MB)</label>
        <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" class="form-input">
    </div>

    <div class="form-group">
        <label for="image">Image (Max 2MB)</label>
        <input type="file" id="image" name="image" accept="image/*" class="form-input">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Add Research</button>
        <a href="{{ route('admin.research.index') }}" class="btn-secondary">Cancel</a>
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
