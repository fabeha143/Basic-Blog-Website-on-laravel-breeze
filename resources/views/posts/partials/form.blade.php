<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" id="title" class="form-control"
           value="{{ old('title', $post->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="body" class="form-label">Body</label>
    <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body', $post->body ?? '') }}</textarea>
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="published" id="published" class="form-check-input"
           {{ old('published', $post->published ?? false) ? 'checked' : '' }}>
    <label for="published" class="form-check-label">Published</label>
</div>
