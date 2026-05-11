<label for="title">Title</label>
<input id="title" name="title" value="{{ old('title', $project->title ?? '') }}" required>

<label for="description">Description</label>
<textarea id="description" name="description" rows="5" required>{{ old('description', $project->description ?? '') }}</textarea>

<label for="tech_stack">Tech Stack</label>
<input id="tech_stack" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack ?? '') }}">

<label for="github_url">GitHub URL</label>
<input id="github_url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}">

<label for="live_url">Live URL</label>
<input id="live_url" name="live_url" value="{{ old('live_url', $project->live_url ?? '') }}">

<label for="image">Project Main Image</label>
<input type="file" id="image" name="image" accept="image/*">
@if(isset($project) && $project->image)
    <div style="margin-bottom: 15px;">
        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" style="max-height: 100px;">
    </div>
@endif

<label for="gallery_images">Gallery Images (Multiple)</label>
<input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
@if(isset($project) && $project->images->count() > 0)
    <div style="margin-bottom: 15px; display: flex; gap: 10px; flex-wrap: wrap;">
        @foreach($project->images as $galleryImage)
            <img src="{{ Storage::url($galleryImage->image_path) }}" alt="Gallery Image" style="max-height: 80px;">
        @endforeach
    </div>
@endif

<label>
    <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured ?? false) ? 'checked' : '' }}>
    Featured Project
</label>
