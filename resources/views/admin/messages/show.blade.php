@extends('layouts.app')

@section('content')
    <article class="card">
        <h1>{{ $message->name }}</h1>
        <p class="muted">{{ $message->email }} | {{ $message->created_at->format('Y-m-d H:i') }}</p>
        <p>{{ $message->message }}</p>
        <p><a href="{{ route('admin.messages.index') }}">Back to Messages</a></p>
    </article>
@endsection
