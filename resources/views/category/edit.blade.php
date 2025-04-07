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
    <form method="post" autocomplete="off">
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" id="categoryName" value="{category_name}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/categories" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
