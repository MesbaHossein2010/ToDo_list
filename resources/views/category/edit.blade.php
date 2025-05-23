<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Category</h1>
    <form autocomplete="off" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label">Category Name*</label>
            <input value="{{ $category->name }}" type="text" class="form-control" id="name" name="name" required>
        </div>
        @error('name')
        <strong style="color: red;">{{$message}}</strong>
        @enderror

        <div class="mb-4">
            <label class="form-label">Tasks</label>
            <div class="category-checkboxes">
                @foreach($tasks as $task)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="tasks[]" value="{{ $task->id }}"
                               id="cat-{{ $task->id }}"
                            {{ $category->tasks->contains($task->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="cat-{{ $task->id }}">
                            {{ $task->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @error('tasks')
        <strong style="color: red;">{{$message}}</strong>
        @enderror

        <div class="d-flex justify-content-between mt-5">
            <a href="/categories" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
</body>
</html>
