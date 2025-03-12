<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('dashboard', compact('books'));
    }

    public function create()
    {
        return view('create'); // Ensure the view name is correct
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'review' => 'required',
            'read_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Book::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Book added successfully!');
    }



    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'review' => 'required',
            'read_date' => 'required|date',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('dashboard')->with('success', 'Book deleted successfully!');
    }

    // Show login form
    public function showLogin()
    {
        return view('login');
    }

    // Handle login without auth
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        session(['user' => $user]);
        return redirect()->route('dashboard')->with('success', 'Logged in successfully!');
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}


    // Show registration form
    public function showRegister()
    {
        return view('register');
    }

    // Handle registration without auth
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Registration failed: ' . $e->getMessage());

            return back()->withErrors(['registration' => 'Registration failed. Please try again.']);
        }
    }

    // Handle logout
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
