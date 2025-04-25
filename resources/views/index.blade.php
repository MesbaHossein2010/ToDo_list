@if(!isset($search))
{{ $search = null }}
@endif
@if(!isset($user))
{{ $user = false }}
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
<div class="container">
    <h1>My To-Do List</h1>

    <div class="auth-buttons d-flex justify-content-end gap-2 mb-3">
        @if(!$user)
            <a href="/login" style="text-align: left" class="btn btn-outline-primary">Login</a>
            <a href="/register" style="text-align: left" class="btn btn-outline-success">Register</a>
        @else
            <button onclick="location.href='/logout';" type="button" class="btn btn-outline-danger">Logout</button>
        @endif
    </div>

    <a href="/create" class="btn btn-primary">Add New Task</a>
    <a href="/categories" class="btn btn-primary">Categories</a>
    <br>
    <br>

    <form class="search-form" action="" method="post" autocomplete="off">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search tasks..." name="search" value="{{ $search }}">
            <button type="submit" class="btn btn-primary">Search</button>
        @if($search != null)
                <button type="button" class="btn btn-danger" onclick="location.href='/';">Cancel</button>
            @endif
        </div>
    </form>

    <div class="mb-3">
        <strong>Number of tasks: {{ count($tasks) }}</strong>
        <br>
        <h2 style="background: {{ $user ? 'green' : 'red' }}; color: white; text-align: center">
            {{ $user ? 'Access granted' : 'Access denied. Please login' }}
        </h2>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Task Name</th>
            <th>Description</th>
            <th>Categories</th>
            <th>user</th>
            <th>Status</th>
            @if($user)
                <th>Actions</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="task-row">
                <td class="fw-semibold align-middle">{!! str_ireplace($search, "<span class='bg-info'>".$search."</span>", e($task->name)) !!}</td>
                <td class="task-description align-middle">{!! str_ireplace($search, "<span class='bg-info'>".$search."</span>", e($task->description)) !!}</td>
                <td class='task-categories align-middle'>
                    @foreach($task->categories as $TaskCat)
                        <span class="badge bg-secondary">{{ $TaskCat['name'] }}</span><br>
                    @endforeach
                </td>
                <td>
                    {{ $task->user->username }}
                </td>
                <td class="align-middle">
                    <span class="badge bg-{{ $task->status == 'not completed' ? 'info' : 'success' }}">
                        {{ $task->status == 'not completed' ? 'Not completed' : 'Completed!' }}
                    </span>
                </td>
                @if($user == $task->user->username)
                    <td class="task-actions align-middle">
                        <a href="/edit/{{ $task->id }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/delete/{{ $task->id }}" class="btn btn-sm btn-danger">Delete</a>
                        <a href="/complete/{{ $task->id }}"
                           class="btn btn-sm btn-{{ $task->status == 'completed' ? 'info' : 'success' }}">
                            {{ $task->status == 'completed' ? 'Undo' : 'Complete' }}
                        </a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
