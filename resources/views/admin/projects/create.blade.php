@extends('layouts.app')

@section('content')
    <h1>Add Project</h1>
    <form class="card" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.projects.form', ['project' => null])
        <button class="btn" type="submit">Create</button>
    </form>
@endsection
