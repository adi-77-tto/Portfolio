@extends('layouts.app')

@section('content')
    <h1>Edit Project</h1>
    <form class="card" action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.projects.form', ['project' => $project])
        <button class="btn" type="submit">Update</button>
    </form>
@endsection
