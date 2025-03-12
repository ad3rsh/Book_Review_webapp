<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgb(61, 142, 235);
            color: #FFFFFF; /* White text */
        }
        h2 {
            color: #FFFFFF; /* White heading */
        }
        .btn {
            background-color: #FFD700; /* Yellow button */
            color: #000000; /* Black text on buttons */
            border: none;
        }
        .btn:hover {
            background-color: #FFC300; /* Slightly darker yellow on hover */
        }
        .table {
            background-color: #FFFFFF;
            color: #000000; /* Black text */
        }
        .table th, .table td {
            color: #000000; /* Black text */
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header p {
            margin: 0;
        }
        .logout-btn {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <header>
        @if (session()->has('user'))
            <p>Welcome, {{ session('user')->name }}!</p>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;" class="logout-btn">
                @csrf
                <button type="submit" class="btn btn-sm">Logout</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}" class="btn btn-sm">Login</a> or <a href="{{ route('register') }}" class="btn btn-sm">Register</a>.</p>
        @endif
    </header>

    <div class="container mt-5">
        <h2>Book Dashboard</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('books.create') }}" class="btn mb-3">Create New Book</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Review</th>
                    <th>Read Date</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->review }}</td>
                        <td>{{ $book->read_date }}</td>
                        <td>{{ str_repeat('★', $book->rating) }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
