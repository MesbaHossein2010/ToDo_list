<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Category List</h1>
    <div class="d-flex justify-content-between mb-4">
        <a href="/categories/create" class="btn btn-primary">Add New Category</a>
        <a href="/" class="btn btn-primary">Tasks</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Tasks</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td class="task-categories align-middle">
                    <br>
                    <br>
                    @foreach($category->tasks as $CatTask)
                        <span class="badge bg-secondary">{{ $CatTask['name'] }}</span>
                    @endforeach
                    <br>
                    <br>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="/categories/edit/{{ $category->id }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/categories/delete/{{ $category->id }}" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
