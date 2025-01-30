<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthorController extends Controller
{
    // Display all Authors
    public function list(): View
    {
        $items = Author::orderBy('name', 'asc')->get();

        return view(
            'author.list',
            [
                'title' => 'Authors',
                'items' => $items,
            ]
        );
    }

    // Display new Author form
    public function create(): View
    {
        return view(
            'author.form',
            [
                'title' => 'Add New Author',
                'author' => new Author() // Passing an empty object for create mode
            ]
        );
    }

    // Create new Author
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = new Author();
        $author->name = $validatedData['name'];
        $author->save();

        return redirect('/authors');
    }

    // Display Author editing form
    public function update(Author $author): View
    {
        return view(
            'author.form',
            [
                'title' => 'Edit Author',
                'author' => $author
            ]
        );
    }

    // Update existing Author data
    public function patch(Author $author, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->name = $validatedData['name'];
        $author->save();

        return redirect('/authors');
    }

    // Delete an Author
    public function delete(Author $author): RedirectResponse
    {
        $author->delete();
        return redirect('/authors')->with('success', 'Author deleted successfully.');
    }
}
