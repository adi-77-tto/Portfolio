@extends('layouts.app')

@section('content')
    <h1>Manage Skills</h1>
    <p><a class="btn" href="{{ route('admin.skills.create') }}">Add Skill</a></p>

    <div class="grid">
        @forelse ($skills as $skill)
            <article class="card">
                <h2>{{ $skill->name }}</h2>
                <p class="muted">{{ $skill->category }} | {{ $skill->level }}</p>
                <p><a href="{{ route('admin.skills.edit', $skill) }}">Edit</a></p>
                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-alt" type="submit">Delete</button>
                </form>
            </article>
        @empty
            <p class="muted">No skills found.</p>
        @endforelse
    </div>
@endsection
