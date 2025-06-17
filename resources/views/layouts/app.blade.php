<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Book Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/stylesheet.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">BookStore</a>
            <div class="d-flex">
                @guest
                    <a href="{{ route('login.form') }}" class="btn btn-secondary me-2">Login</a>
                    <a href="{{ route('register.form') }}" class="btn btn-primary">Register</a>
                @endguest
                @auth
                    <a href="{{ route('cart.index') }}" class="btn btn-warning me-3">
                        <i class="bi bi-cart"></i> Cart
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, {{ Auth::user()->username }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            @if(Auth::user()->role === 'admin')
                            <li><a class="dropdown-item" href="{{ route('admin.books.index') }}">Dashboard Admin</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py4 bg-dark flex-grow-1">
        @yield('content')
    </main>
    <footer class="text-center mt-5 py-3 text-white mt-auto">
        <div class="container">
            <p class="mb-0">BNCC FINAL PROJECT LNT BACK</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
