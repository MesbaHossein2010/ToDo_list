@if(!isset($search))
    <?php $search = null ?>
@endif
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

    <!-- Display number of results -->
    <div class="mb-3">
        <strong>Number of results: {{ count($tasks) }}</strong>
    </div>

    <form class="search-form" action="" method="post" autocomplete="off">
        @csrf
        @if($search == null)
            <input type="text" class="form-control" placeholder="Search tasks..." name="search">
            <button type="submit" class="btn btn-info">Search</button>
        @else
            <input type="text" class="form-control" placeholder="Search tasks..." name="search" value="{{ $search }}">
            <button type="submit" class="btn btn-info">Search</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="location.href='/';">Cancel search</button>
        @endif
    </form>

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
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    <span class="badge bg-{{ $task->status == 'not completed'? 'info':'success' }}">
                        {{ $task->status == 'not completed'? 'Not completed':'Completed!' }}
                    </span>
                </td>
                <td>
                    <a href="/edit/{{ $task->id }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/delete/{{ $task->id }}" class="btn btn-sm btn-danger">Delete</a>
                    <a href="/complete/{{ $task->id }}"
                       class="btn btn-sm btn-{{ $task->status == 'completed'? 'info':'success' }}">{{ $task->status == 'completed'? 'Set as not completed':'Set as complete' }}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
