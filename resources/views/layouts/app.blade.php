<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortening</title><style>
        /* Optional custom styles */
        nav {
            background-color: #f8f9fa; /* Light gray background */
            padding: 10px; /* Add padding to the navigation */
            display: flex;
            justify-content: flex-end; /* Align items on both ends */
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="display:flex; justify-content: end;">
        @guest
            <ul class="navbar-nav ml-auto"> <!-- Align items to the right -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            </ul>
        @else
            <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Logout</button>
            </form>
        @endguest
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>