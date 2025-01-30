@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if (count($items) > 0)
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td>{{ $genre->name }}</td>
                        <td>
                            <!-- Edit button linked to the edit page -->
                            <a href="/genres/update/{{ $genre->id }}" class="btn btn-sm btn-outline-primary">Edit</a>

                            <!-- Delete button using a form to prevent accidental GET requests -->
                            <form action="/genres/delete/{{ $genre->id }}" method="post" class="deletionform d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No entries found in the database.</p>
    @endif

    <!-- Button to create a new Genre -->
    <a href="/genres/create" class="btn btn-primary mt-3">Add New</a>

@endsection
