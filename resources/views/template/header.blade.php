<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stok Yönetimi - Volkan KALAY</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Ubuntu&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}} ">
    <style>
        * {
            font-family: Ubuntu, sans-serif;
        }

        a {
            text-decoration: none;
        }

        .navbar {
            justify-content: center;
        }

        label, button {
            color: #0c63e4;
            font-family: "Poppins", sans-serif !important;
            font-weight: bolder;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-md navbar-light bg-black bg-opacity-10 px-5 border mb-5">
    <a class="navbar-brand" href="{{ route('home') }}">Stok Yönetimi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Ana Sayfa</a>
                </li>
                <li class="nav-item bg-danger bg-opacity-10">
                    <a class="nav-link" href="{{ route('logout') }}">Çıkış Yap</a>
                </li>
            @else
                <li class="nav-item fw-bold">
                    <a class="nav-link border border-secondary bg-secondary bg-opacity-25" style="border-radius: 8px;" href="{{ route('login') }}">Giriş Yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        |
                    </a>
                </li>
                <li class="nav-item fw-bold">
                    <a class="nav-link border border-secondary bg-success bg-opacity-25" style="border-radius: 8px;" href="{{ route('register') }}">Kayıt Ol</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="p-5">
