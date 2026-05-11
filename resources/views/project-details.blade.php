@extends('layouts.app')

@section('content')
    <div style="display:grid; grid-template-columns: minmax(0, 1.7fr) minmax(280px, 0.8fr); gap: 1rem; align-items: start;">
        <section class="card">
            <h1>{{ $project->title }}</h1>
            <p class="muted">{{ $project->tech_stack }}</p>
            <p>{{ $project->description }}</p>

            @php
                $firstImage = $project->images->first()?->image_path;
            @endphp

            @if ($firstImage)
                <div style="margin-top: 1rem;">
                    <img
                        id="main-project-image"
                        src="{{ str_starts_with($firstImage, 'http') ? $firstImage : Storage::url($firstImage) }}"
                        alt="{{ $project->title }} screenshot"
                        style="width:100%; height:420px; object-fit:cover; border-radius:14px; border:1px solid #d9e2e9;"
                    >
                </div>

                <div style="display:flex; gap:0.6rem; flex-wrap:wrap; margin-top:0.8rem;">
                    @foreach ($project->images as $image)
                        @php $src = str_starts_with($image->image_path, 'http') ? $image->image_path : Storage::url($image->image_path); @endphp
                        <button
                            type="button"
                            class="thumb-btn"
                            data-image="{{ $src }}"
                            style="padding:0; border:1px solid #d9e2e9; border-radius:10px; background:#fff; cursor:pointer;"
                        >
                            <img
                                src="{{ $src }}"
                                alt="{{ $project->title }} thumbnail"
                                style="width:95px; height:70px; object-fit:cover; border-radius:10px; display:block;"
                            >
                        </button>
                    @endforeach
                </div>
            @else
                <p class="muted">No project screenshots added yet.</p>
            @endif
        </section>

        <aside class="card" style="position: sticky; top: 5.2rem;">
            <h2 style="margin-bottom:0.2rem;">Project Actions</h2>
            <p class="muted" style="margin-top:0;">Want this kind of build for your product?</p>

            @if ($project->github_url)
                <p><a class="btn" href="{{ $project->github_url }}" target="_blank" rel="noopener" style="display:block; text-align:center;">View GitHub</a></p>
            @endif

            @if ($project->live_url)
                <p><a class="btn btn-alt" href="{{ $project->live_url }}" target="_blank" rel="noopener" style="display:block; text-align:center;">View Live Project</a></p>
            @endif

            <p><a class="btn" href="{{ route('contact.index') }}" style="display:block; text-align:center;">Contact me</a></p>
        </aside>
    </div>

    <script>
        document.querySelectorAll('.thumb-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var mainImage = document.getElementById('main-project-image');
                if (mainImage) {
                    mainImage.src = btn.getAttribute('data-image');
                }
            });
        });
    </script>
@endsection
