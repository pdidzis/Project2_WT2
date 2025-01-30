@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>
    <hr>

    <!-- Display authentication error message -->
    @if ($errors->any())
        <div class="alert alert-danger">
            Failed to authenticate. Please try again!
        </div>
    @endif

    <!-- Login Form -->
    <form method="post" action="/auth">
        @csrf

        <!-- Username Field -->
        <div class="mb-3">
            <label for="login-name" class="form-label">User Name</label>
            <input 
                type="text" 
                id="login-name" 
                name="name" 
                class="form-control" 
                autocomplete="off" 
                autofocus
            >
        </div>

        <!-- Password Field -->
        <div class="mb-3">
            <label for="login-password" class="form-label">Password</label>
            <input 
                type="password" 
                id="login-password" 
                name="password" 
                class="form-control"
            >
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

@endsection
