<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopted</title>
    <link rel="stylesheet" href="{{ asset('css/initial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">
</head>

<body>
    <header>
        <section>
            <picture>
                <img src="{{asset('img/logo/dog.svg')}}" alt="Cão" />
                <img src="{{asset('img/logo/cat.svg')}}" alt="Gato" />
            </picture>
            <h1>Adopted</h1>
        </section>
        @if (Route::has('login'))
        <div>
            @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
            <a href="{{ route('login') }}">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </header>
    <main>
        <section class="carousel">
            <ol>
                @foreach($imagens as $image)
                <li>
                    <img src="{{asset($image['url'])}}" alt="{{$image['nome']}}" />
                </li>
                @endforeach
            </ol>
        </section>
        <h1>
            Registro de Animais Adotados
        </h1>
    </main>
</body>

</html>
