<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Http\Requests\BookRequest; // Import BookRequest
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
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
    public function put(BookRequest $request): RedirectResponse
    {
        $book = new Book();
        $this->saveBookData($book, $request);
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
    public function patch(Book $book, BookRequest $request): RedirectResponse
    {
        $this->saveBookData($book, $request);
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

    /**
     * Private method to handle validating and saving Book data.
     */
    private function saveBookData(Book $book, BookRequest $request): void
    {
        $validatedData = $request->validated(); // Use BookRequest validated data

        // Assign validated data to the book object
        $book->fill($validatedData);

        // Convert display checkbox value to boolean
        $book->display = (bool) ($validatedData['display'] ?? false);

        // Handle image upload and delete old one if needed
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
    }
}
