@extends('layouts.app')

@section('content')
    <h1>Edit Achievement</h1>
    <form class="card" action="{{ route('admin.achievements.update', $achievement) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.achievements.form', ['achievement' => $achievement])
        <button class="btn" type="submit">Update</button>
    </form>
@endsection
