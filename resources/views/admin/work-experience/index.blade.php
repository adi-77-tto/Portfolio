@extends('layouts.app')

@section('title', 'Manage Work Experience')

@section('content')
<div class="admin-header">
    <h1>Manage Work Experience</h1>
    <a href="{{ route('admin.work-experience.create') }}" class="btn-primary">+ Add Work Experience</a>
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
                <th>Company</th>
                <th>Position</th>
                <th>Period</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($workExperience as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($item->logo)
                        <img src="{{ asset($item->logo) }}" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    @else
                        <span style="color: var(--muted);">No logo</span>
                    @endif
                </td>
                <td>{{ $item->company_name }}</td>
                <td>{{ $item->position }}</td>
                <td>
                    {{ $item->start_date->format('M Y') }} 
                    @if($item->end_date)
                        - {{ $item->end_date->format('M Y') }}
                    @else
                        - Current
                    @endif
                </td>
                <td class="actions">
                    <a href="{{ route('admin.work-experience.edit', $item->id) }}" class="btn-icon edit" title="Edit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('admin.work-experience.destroy', $item->id) }}" method="POST" class="form-inline" onsubmit="return confirm('Are you sure you want to delete this work experience?');">
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
                <td colspan="6" class="text-center text-muted">No work experience found. <a href="{{ route('admin.work-experience.create') }}">Add one</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
