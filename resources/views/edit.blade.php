<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Book</h2>

        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Book Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $book->name }}" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" name="author" id="author" value="{{ $book->author }}" required>
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea class="form-control" name="review" id="review" rows="3" required>{{ $book->review }}</textarea>
            </div>
            <div class="mb-3">
                <label for="read_date" class="form-label">Read Date</label>
                <input type="date" class="form-control" name="read_date" id="read_date" value="{{ $book->read_date }}" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select class="form-select" name="rating" id="rating" required>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $book->rating == $i ? 'selected' : '' }}>
                            {{ str_repeat('★', $i) }}
                        </option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Book</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
