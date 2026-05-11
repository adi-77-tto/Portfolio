<label for="name">Name</label>
<input id="name" name="name" value="{{ old('name', $skill->name ?? '') }}" required>

<label for="category">Category</label>
<select id="category" name="category" required>
    @foreach (['language', 'framework', 'tool', 'db'] as $category)
        <option value="{{ $category }}" {{ old('category', $skill->category ?? '') === $category ? 'selected' : '' }}>
            {{ ucfirst($category) }}
        </option>
    @endforeach
</select>

<label for="level">Level</label>
<input id="level" name="level" value="{{ old('level', $skill->level ?? '') }}" required>
