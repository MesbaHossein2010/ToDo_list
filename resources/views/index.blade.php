<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">My To-Do List</h1>
    <div class="d-flex justify-content-between mb-3">
        <a href="/create" class="btn btn-primary">Add New Task</a>
    </div>
    @dd($tasks)
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Task Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task['name'] }}</td>
            <td>{{ $task['description'] }}</td>
            <td><span class="badge bg-success">Completed</span></td>
            <td>
                <a href="/edit/{{ $task['id'] }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="/delete/{{ $task['id'] }}" class="btn btn-sm btn-danger">delete</a>
                <a href="/complete/{{ $task['id'] }}" class="btn btn-sm btn-success">Complete!</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
