@extends('layouts.app')

@section('content')
    <h1>Add Achievement</h1>
    <form class="card" action="{{ route('admin.achievements.store') }}" method="POST">
        @csrf
        @include('admin.achievements.form', ['achievement' => null])
        <button class="btn" type="submit">Create</button>
    </form>
@endsection
