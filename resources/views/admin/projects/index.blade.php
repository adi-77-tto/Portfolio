@extends('layouts.app')

@section('content')
    <h1>Manage Projects</h1>
    <p><a class="btn" href="{{ route('admin.projects.create') }}">Add Project</a></p>

    <div class="grid">
        @forelse ($projects as $project)
            <article class="card">
                <h2>{{ $project->title }}</h2>
                <p class="muted">{{ $project->tech_stack }}</p>
                <p>{{ $project->description }}</p>
                <p>
                    <a href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                </p>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-alt" type="submit">Delete</button>
                </form>
            </article>
        @empty
            <p class="muted">No projects found.</p>
        @endforelse
    </div>
@endsection
