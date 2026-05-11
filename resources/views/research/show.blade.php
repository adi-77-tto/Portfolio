@extends('layouts.app')

@section('title', $research->title)

@section('content')
<div class="research-detail">
    <div class="research-header">
        <a href="{{ route('home') }}" class="back-link">← Back to Portfolio</a>
        <div class="status-badge status-{{ $research->status }}">
            {{ ucfirst(str_replace('_', ' ', $research->status)) }}
        </div>
    </div>

    <div class="research-container">
        <div class="research-main">
            @if ($research->image)
            <div class="research-image">
                <img src="{{ asset($research->image) }}" alt="{{ $research->title }}">
            </div>
            @endif

            <h1 class="research-title">{{ $research->title }}</h1>

            <div class="research-meta">
                <span class="year">{{ $research->year }}</span>
                @if ($research->status === 'published')
                <span class="badge badge-success">Published</span>
                @else
                <span class="badge badge-warning">In Progress</span>
                @endif
            </div>

            <section class="research-section">
                <h2>Description</h2>
                <p>{{ $research->description }}</p>
            </section>

            @if ($research->abstract)
            <section class="research-section">
                <h2>Abstract</h2>
                <div class="abstract-text">
                    {{ $research->abstract }}
                </div>
            </section>
            @endif

            <section class="research-section">
                <h2>Authors</h2>
                <div class="authors-list">
                    @php
                    $authors = array_map('trim', explode(',', $research->team_members));
                    @endphp
                    @foreach ($authors as $author)
                    <div class="author-item">
                        <span class="author-name">{{ $author }}</span>
                        @if ($loop->first)
                        <span class="author-badge">First Author</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>

            @if ($research->pdf_file || $research->paper_link)
            <section class="research-section">
                <h2>Access Paper</h2>
                <div class="paper-access">
                    @if ($research->pdf_file)
                    <div class="pdf-viewer-section">
                        <div class="pdf-controls">
                            <h3>PDF Preview</h3>
                            <a href="{{ asset($research->pdf_file) }}" class="btn btn-primary" download>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download PDF
                            </a>
                        </div>
                        <iframe src="{{ asset($research->pdf_file) }}#toolbar=0" class="pdf-preview"></iframe>
                    </div>
                    @endif

                    @if ($research->paper_link)
                    <div class="paper-link-section">
                        <a href="{{ $research->paper_link }}" target="_blank" class="btn btn-secondary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>
                            View External Paper
                        </a>
                    </div>
                    @endif
                </div>
            </section>
            @endif
        </div>

        <div class="research-sidebar">
            <div class="sidebar-card">
                <h3>Research Details</h3>
                <div class="detail-item">
                    <label>Year Published</label>
                    <p>{{ $research->year }}</p>
                </div>
                <div class="detail-item">
                    <label>Status</label>
                    <p>{{ ucfirst(str_replace('_', ' ', $research->status)) }}</p>
                </div>
                <div class="detail-item">
                    <label>Team Members</label>
                    <p>{{ $research->team_members }}</p>
                </div>
                @if ($research->paper_link)
                <div class="detail-item">
                    <label>Paper Link</label>
                    <a href="{{ $research->paper_link }}" target="_blank" class="link-external">View Paper</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.research-detail {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.research-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    gap: 1rem;
}

.back-link {
    color: var(--accent);
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: opacity 0.2s;
}

.back-link:hover {
    opacity: 0.8;
}

.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-weight: 500;
    font-size: 0.875rem;
}

.status-published {
    background: #d1f7d1;
    color: #155724;
}

.status-in_progress {
    background: #fff3cd;
    color: #856404;
}

.research-container {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 3rem;
}

@media (max-width: 768px) {
    .research-container {
        grid-template-columns: 1fr;
    }
}

.research-main {
    background: var(--surface);
    padding: 2rem;
    border-radius: 0.5rem;
}

.research-image {
    margin-bottom: 2rem;
    border-radius: 0.5rem;
    overflow: hidden;
}

.research-image img {
    width: 100%;
    height: auto;
    display: block;
}

.research-title {
    font-size: 2rem;
    margin: 1rem 0;
    line-height: 1.3;
}

.research-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    align-items: center;
    flex-wrap: wrap;
}

.year {
    font-weight: 600;
    color: var(--accent);
    font-size: 1.1rem;
}

.badge {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-success {
    background: #d1f7d1;
    color: #155724;
}

.badge-warning {
    background: #fff3cd;
    color: #856404;
}

.research-section {
    margin-bottom: 2rem;
}

.research-section h2 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--ink);
}

.abstract-text {
    line-height: 1.8;
    color: var(--ink);
}

.authors-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.author-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: rgba(0, 0, 0, 0.02);
    border-radius: 0.375rem;
}

.author-name {
    flex: 1;
    font-weight: 500;
}

.author-badge {
    display: inline-block;
    background: var(--accent);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.paper-access {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.pdf-viewer-section {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.pdf-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pdf-controls h3 {
    margin: 0;
}

.pdf-preview {
    width: 100%;
    height: 600px;
    border: 1px solid var(--line);
    border-radius: 0.375rem;
}

@media (max-width: 768px) {
    .pdf-preview {
        height: 400px;
    }
}

.paper-link-section {
    padding: 1rem;
    background: rgba(0, 0, 0, 0.02);
    border-radius: 0.375rem;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    text-decoration: none;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: opacity 0.2s;
}

.btn-primary {
    background: var(--accent);
    color: white;
}

.btn-primary:hover {
    opacity: 0.9;
}

.btn-secondary {
    background: #e0e0e0;
    color: var(--ink);
}

.btn-secondary:hover {
    background: #d0d0d0;
}

.research-sidebar {
    background: var(--surface);
    padding: 2rem;
    border-radius: 0.5rem;
    height: fit-content;
}

.sidebar-card h3 {
    margin-top: 0;
    margin-bottom: 1.5rem;
}

.detail-item {
    margin-bottom: 1.5rem;
}

.detail-item label {
    display: block;
    font-weight: 600;
    color: var(--muted);
    font-size: 0.875rem;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}

.detail-item p {
    margin: 0;
    color: var(--ink);
}

.link-external {
    color: var(--accent);
    text-decoration: none;
    word-break: break-word;
}

.link-external:hover {
    text-decoration: underline;
}
</style>
@endsection
