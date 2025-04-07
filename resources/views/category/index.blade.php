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
<div class="container mt-5">
    <h1 class="text-center mb-4">Category List</h1>
    <div class="d-flex justify-content-between mb-3">
        <a href="/categories/create" class="btn btn-primary">Add New Category</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- Example row, replace {categories} with actual data from your backend -->
        <tr>
            <td>{category_id}</td>
            <td>{category_name}</td>
            <td>
                <a href="/categories/edit/{category_id}" class="btn btn-sm btn-warning">Edit</a>
                <form action="/categories/delete/{category_id}" method="POST" style="display:inline;">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                </form>
            </td>
        </tr>
        <!-- Repeat for each category -->
        </tbody>
    </table>
</div>
</body>
</html>
