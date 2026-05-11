<label for="title">Title</label>
<input id="title" name="title" value="{{ old('title', $achievement->title ?? '') }}" required>

<label for="description">Description</label>
<textarea id="description" name="description" rows="4">{{ old('description', $achievement->description ?? '') }}</textarea>

<label for="date">Date</label>
<input id="date" name="date" type="date" value="{{ old('date', isset($achievement) && $achievement->date ? $achievement->date->format('Y-m-d') : '') }}">

<label for="type">Type</label>
<input id="type" name="type" value="{{ old('type', $achievement->type ?? '') }}">
