@extends('layouts.app')

@section('content')
    <h1>Messages</h1>
    <div class="grid">
        @forelse ($messages as $message)
            <article class="card">
                <h2>{{ $message->name }}</h2>
                <p class="muted">{{ $message->email }} | {{ $message->created_at->format('Y-m-d H:i') }}</p>
                <p>{{ \Illuminate\Support\Str::limit($message->message, 130) }}</p>
                <p><a href="{{ route('admin.messages.show', $message) }}">Open</a></p>
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-alt" type="submit">Delete</button>
                </form>
            </article>
        @empty
            <p class="muted">No messages yet.</p>
        @endforelse
    </div>
@endsection
