@extends('layouts.app')

@section('content')
    <h1>Projects</h1>
    <div class="grid">
        @forelse ($projects as $project)
            <article class="card">
                <h2>{{ $project->title }}</h2>
                <p class="muted">{{ $project->tech_stack }}</p>
                <p>{{ $project->description }}</p>
                <div>
                    <a class="btn" href="{{ route('projects.show', $project) }}">More Details</a>
                    @if ($project->github_url)
                        <a class="btn btn-alt" href="{{ $project->github_url }}" target="_blank" rel="noopener">GitHub</a>
                    @endif
                    @if ($project->live_url)
                        <a class="btn btn-alt" href="{{ $project->live_url }}" target="_blank" rel="noopener">Live</a>
                    @endif
                </div>
            </article>
        @empty
            <p class="muted">No projects available.</p>
        @endforelse
    </div>
@endsection
