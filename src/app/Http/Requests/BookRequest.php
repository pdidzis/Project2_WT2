<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    // Allow all users to access this request
    public function authorize(): bool
    {
        return true;
    }

    // Define validation rules
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:256',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'display' => 'nullable',
        ];
    }

    // Custom error messages in Latvian
    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
            'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
            'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
        ];
    }

    // Custom attribute names in Latvian
    public function attributes(): array
    {
        return [
            'name' => 'nosaukums',
            'author_id' => 'autors',
            'genre_id' => 'žanrs',
            'description' => 'apraksts',
            'price' => 'cena',
            'year' => 'gads',
            'image' => 'attēls',
            'display' => 'publicēt',
        ];
    }
}
