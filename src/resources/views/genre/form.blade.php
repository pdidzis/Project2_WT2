@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">Please fix the errors!</div>
    @endif

    <!-- Genre creation/editing form -->
    <form method="post" action="{{ $genre->exists ? '/genres/patch/' . $genre->id : '/genres/put' }}">
        @csrf

        <!-- Genre Name Input Field -->
        <div class="mb-3">
            <label for="genre-name" class="form-label">Genre Name</label>

            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror"
                id="genre-name"
                name="name"
                value="{{ old('name', $genre->name) }}" 
            >

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
