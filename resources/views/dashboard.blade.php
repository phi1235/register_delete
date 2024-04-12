<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS để tạo viền xung quanh từ trái qua phải màn hình */
        .navbar-nav {
            display: flex;
            justify-content: center;
            border: 1px solid black;
            padding: 5px;
            border-radius: 5px;
            width: 1500px;
            
        }

        .nav-item {
            margin: 0 5px;
            color: black; /* Chữ màu đen */
            text-decoration: none; /* Loại bỏ gạch chân */
        }

        .nav-item:last-child {
            margin-right: 0;
        }

        .nav-item::after {
            content: "|";
            margin-left: 5px;
            margin-right: 5px;
        }

        .nav-item:last-child::after {
            content: none;
        }
        .footer{
            display: fixed;
            border: 1px solid black;
            padding: 5px;
            border-radius: 5px;
            width: 1500px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg mb-5">
    <div class="container">
        <div class="navbar-nav">
            @guest
            <a class="nav-item" href="{{ route('login') }}">Home</a>
                <a class="nav-item" href="{{ route('login') }}">Login</a>
                <a class="nav-item" href="{{ route('register-user') }}">Register</a>
                @else
                <a class="nav-item" href="{{ route('login') }}">Home</a>
                <a class="nav-item" href="{{ route('signout') }}">Sign out</a>
                @endguest
            </div>
    </div>
</nav>
@yield('content')
<footer class="footer fixed-bottom bg-light py-3">
    <div class="container text-center">
        <span>@ 2024 Group I</span>
        </div>
</footer>
</body>
</html>
