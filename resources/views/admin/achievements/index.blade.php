@extends('layouts.app')

@section('content')
    <h1>Manage Achievements</h1>
    <p><a class="btn" href="{{ route('admin.achievements.create') }}">Add Achievement</a></p>

    <div class="grid">
        @forelse ($achievements as $achievement)
            <article class="card">
                <h2>{{ $achievement->title }}</h2>
                <p class="muted">{{ optional($achievement->date)->format('Y-m-d') }} | {{ $achievement->type }}</p>
                <p>{{ $achievement->description }}</p>
                <p><a href="{{ route('admin.achievements.edit', $achievement) }}">Edit</a></p>
                <form action="{{ route('admin.achievements.destroy', $achievement) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-alt" type="submit">Delete</button>
                </form>
            </article>
        @empty
            <p class="muted">No achievements found.</p>
        @endforelse
    </div>
@endsection
