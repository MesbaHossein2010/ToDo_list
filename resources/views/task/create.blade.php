<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Create New Task</h1>

    <form autocomplete="off" action="" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label">Task Name*</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        @error('name')
        <strong style="color: red;">{{$message}}</strong>
        @enderror

        <div class="mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>
        @error('description')
        <strong style="color: red;">{{$message}}</strong>
        @enderror

        <div class="mb-4">
            <label class="form-label">Categories</label>
            <div class="category-checkboxes">
                @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="categories[]" value="{{ $category->id }}"
                               id="cat-{{ $category->id }}">
                        <label class="form-check-label" for="cat-{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @error('categories')
        <strong style="color: red;">{{$message}}</strong>
        @enderror

        <div class="d-flex justify-content-between mt-5">
            <a href="/" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </div>
    </form>
</div>
</body>
</html>
