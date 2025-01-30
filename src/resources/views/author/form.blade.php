@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">Please fix the errors!</div>
    @endif

    <!-- Author creation/editing form -->
    <form method="post" action="{{ $author->exists ? '/authors/patch/' . $author->id : '/authors/put' }}">
        @csrf

        <!-- Author Name Input Field -->
        <div class="mb-3">
            <label for="author-name" class="form-label">Author Name</label>

            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror"
                id="author-name"
                name="name"
                value="{{ old('name', $author->name) }}" 
            >

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection
