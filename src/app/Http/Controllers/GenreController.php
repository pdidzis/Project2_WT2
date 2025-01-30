<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class GenreController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    // Display all Genres
    public function list(): View
    {
        $items = Genre::orderBy('name', 'asc')->get();

        return view(
            'genre.list',
            [
                'title' => 'Genres',
                'items' => $items,
            ]
        );
    }

    // Display new Genre form
    public function create(): View
    {
        return view(
            'genre.form',
            [
                'title' => 'Add New Genre',
                'genre' => new Genre() // Passing an empty object for create mode
            ]
        );
    }

    // Create new Genre
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre = new Genre();
        $genre->name = $validatedData['name'];
        $genre->save();

        return redirect('/genres');
    }

    // Display Genre editing form
    public function update(Genre $genre): View
    {
        return view(
            'genre.form',
            [
                'title' => 'Edit Genre',
                'genre' => $genre
            ]
        );
    }

    // Update existing Genre data
    public function patch(Genre $genre, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->name = $validatedData['name'];
        $genre->save();

        return redirect('/genres');
    }

    // Delete a Genre
    public function delete(Genre $genre): RedirectResponse
    {
        $genre->delete();
        return redirect('/genres')->with('success', 'Genre deleted successfully.');
    }
}
