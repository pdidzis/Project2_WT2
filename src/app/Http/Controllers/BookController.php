<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class BookController extends Controller implements HasMiddleware
{
    /**
     * Assign authentication middleware.
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    // Display all Books
    public function list(): View
    {
        $items = Book::orderBy('name', 'asc')->get();

        return view(
            'book.list',
            [
                'title' => 'Books',
                'items' => $items,
            ]
        );
    }

    // Display new Book form
    public function create(): View
    {
        $authors = Author::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();

        return view(
            'book.form',
            [
                'title' => 'Add new book',
                'book' => new Book(),
                'authors' => $authors,
                'genres' => $genres,
            ]
        );
    }

    // Create new Book entry
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'display' => 'nullable',
        ]);

        $book = new Book();
        $book->name = $validatedData['name'];
        $book->author_id = $validatedData['author_id'];
        $book->genre_id = $validatedData['genre_id'];
        $book->description = $validatedData['description'];
        $book->price = $validatedData['price'];
        $book->year = $validatedData['year'];
        $book->display = (bool) ($validatedData['display'] ?? false);

        // Handle image upload
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $book->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }

        $book->save();
        return redirect('/books');
    }

    // Display Book edit form
    public function update(Book $book): View
    {
        $authors = Author::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();

        return view(
            'book.form',
            [
                'title' => 'Edit Book',
                'book' => $book,
                'authors' => $authors,
                'genres' => $genres,
            ]
        );
    }

    // Update existing Book entry
    public function patch(Book $book, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'display' => 'nullable',
        ]);

        $book->name = $validatedData['name'];
        $book->author_id = $validatedData['author_id'];
        $book->genre_id = $validatedData['genre_id'];
        $book->description = $validatedData['description'];
        $book->price = $validatedData['price'];
        $book->year = $validatedData['year'];
        $book->display = (bool) ($validatedData['display'] ?? false);

        // Handle image upload and delete old one
        if ($request->hasFile('image')) {
            if ($book->image) {
                @unlink(public_path('images/' . $book->image)); // Delete old image
            }
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $book->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }

        $book->save();
        return redirect('/books/update/' . $book->id);
    }

    // Delete a Book
    public function delete(Book $book): RedirectResponse
    {
        if ($book->image) {
            @unlink(public_path('images/' . $book->image)); // Delete image file
        }
        $book->delete();
        return redirect('/books');
    }
}
