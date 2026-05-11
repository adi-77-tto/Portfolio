@extends('layouts.app')

@section('title', 'Manage Education')

@section('content')
<div class="admin-header">
    <h1>Manage Education</h1>
    <a href="{{ route('admin.education.create') }}" class="btn-primary">+ Add Education</a>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">{{ $message }}</div>
@endif

<div class="table-wrapper">
    <table class="admin-table">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Logo</th>
                <th>Degree</th>
                <th>Institution</th>
                <th>Period</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($education as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($item->logo)
                        <img src="{{ asset($item->logo) }}" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    @else
                        <span style="color: var(--muted);">No logo</span>
                    @endif
                </td>
                <td>{{ $item->degree_name }}</td>
                <td>{{ $item->institution_name }}</td>
                <td>
                    {{ $item->start_date->format('M Y') }} 
                    @if($item->end_date)
                        - {{ $item->end_date->format('M Y') }}
                    @else
                        - Current
                    @endif
                </td>
                <td class="actions">
                    <a href="{{ route('admin.education.edit', $item->id) }}" class="btn-icon edit" title="Edit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('admin.education.destroy', $item->id) }}" method="POST" class="form-inline" onsubmit="return confirm('Are you sure you want to delete this education?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon delete" title="Delete">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No education found. <a href="{{ route('admin.education.create') }}">Add one</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    gap: 1rem;
}

.admin-header h1 {
    margin: 0;
    font-size: 1.75rem;
}

.btn-primary {
    display: inline-block;
    background: var(--accent);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: opacity 0.2s;
}

.btn-primary:hover {
    opacity: 0.9;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #c3e6cb;
}

.table-wrapper {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    background: var(--surface);
}

.admin-table thead {
    background: var(--bg);
}

.admin-table th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    border-bottom: 2px solid var(--line);
    color: var(--ink);
}

.admin-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--line);
}

.admin-table tbody tr:hover {
    background: rgba(0, 0, 0, 0.02);
}

.actions {
    display: flex;
    gap: 0.5rem;
}

.btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    border-radius: 0.375rem;
    border: none;
    background: transparent;
    cursor: pointer;
    color: var(--ink);
    transition: background 0.2s;
}

.btn-icon:hover {
    background: rgba(0, 0, 0, 0.05);
}

.btn-icon.edit:hover {
    color: #0066cc;
}

.btn-icon.delete:hover {
    color: #cc0000;
}

.form-inline {
    display: contents;
}

.text-center {
    text-align: center;
}

.text-muted {
    color: var(--muted);
}
</style>
@endsection
