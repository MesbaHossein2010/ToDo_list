<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Task</h1>
    <form method="post" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="taskName" class="form-label">Task Name</label>
            <input type="text" class="form-control" name="name" id="taskName" value="{{ $task->name }}" required>
        </div>
        <div class="mb-3">
            <label for="taskDescription" class="form-label">Description</label>
            <textarea class="form-control" id="taskDescription" name="description" rows="3" required>{{ $task->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
