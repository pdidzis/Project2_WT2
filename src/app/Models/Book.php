<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'author_id',
        'genre_id',
        'description',
        'price',
        'year',
        'image',
        'display',
    ];

    /**
     * Get the author associated with the book.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the genre associated with the book.
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Serialize the book data for JSON response.
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author->name ?? null, // Avoids errors if no author
            'genre' => $this->genre->name ?? null, // Avoids errors if no genre
            'price' => number_format($this->price, 2),
            'year' => intval($this->year),
            'image' => $this->image ? asset('images/' . $this->image) : null, // Handles missing image
        ];
    }
}
