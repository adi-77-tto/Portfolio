@extends('layouts.app')

@section('content')
    <h1>Edit Skill</h1>
    <form class="card" action="{{ route('admin.skills.update', $skill) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.skills.form', ['skill' => $skill])
        <button class="btn" type="submit">Update</button>
    </form>
@endsection
