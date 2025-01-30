<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Project 2 - {{ $title }}</title>
    <meta name="description" content="Web Technologies Project 2">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">

    <!-- Custom CSS for Black & White Theme -->
    <style>
        body {
            background-color: #000;
            color: #fff;
        }
        a, .navbar-brand {
            color: #fff !important;
        }
        .navbar, .footer {
            background-color: #222 !important;
        }
        .container, .row {
            background-color: #111;
            padding: 10px;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #444 !important;
            border-color: #666 !important;
        }
        .btn-primary:hover {
            background-color: #666 !important;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-dark bg-dark mb-3">
        <header class="container">
            <a class="navbar-brand" href="#">Project 2 - {{ $title }}</a>
        </header>
    </nav>

    <!-- Main Content -->
    <main class="container">
        <div class="row">
            <div class="col">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer text-light text-center mt-3">
        <div class="container">
            <div class="row py-5">
                <div class="col">
                    Polats Didzis Ozdemirs, 2024
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
