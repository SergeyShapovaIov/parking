<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body class="antialiased">
<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">


    <div class="container text-center vertical-alignment-center main-container">
        <div class="container text-center content-container">
            @auth
                <div class="row justify-content-md-center">
                    <div class="col col-lg-5">
                        <a href="{{ route('car-list') }}">
                            <button type="button" class="btn btn-primary"> Моя парковка </button>
                        </a>

                    </div>
                </div>
            @else
                <div class="row justify-content-md-center">
                    <div class="col col-lg-5">
                        <a href="{{ route('register') }}">
                            <button type="button" class="btn btn-primary"> Завести новую парковку</button>
                        </a>

                    </div>
                </div>
                <div class="row justify-content-md-center mt-4">
                    <div class="col col-lg-5">
                        <a href="{{ route('login') }}">
                            <button type="button" class="btn btn-info"> Продолжить управлять парковкой</button>
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>


    {{--</div>--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>

    <style>
        body {
            height: 100vh;
        }

        .main-container {
            height: 100%;
        }

        .content-container {
            position: absolute;
            top: 40%;
        }
    </style>
</body>
</html>
