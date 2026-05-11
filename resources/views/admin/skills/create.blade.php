@extends('layouts.app')

@section('content')
    <h1>Add Skill</h1>
    <form class="card" action="{{ route('admin.skills.store') }}" method="POST">
        @csrf
        @include('admin.skills.form', ['skill' => null])
        <button class="btn" type="submit">Create</button>
    </form>
@endsection
