@php
    $totalQuantity = session()->get('total_items');
@endphp
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.0/examples/product/product.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('panel/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Espresso</title>
</head>
<body>
<style>
    :root {
        --starbucks-dark-green: #006241;
        --starbucks-light-green: #00704A;
        --main-background-color: #092635;
        --text-color: #9EC8B9;
    }

    body {
        background-color: var(--starbucks-dark-green);
        color: var(--text-color);
    }

    main {
        background-color: var(--main-background-color);
    }

    .btn-success {
        background-color: var(--starbucks-light-green);
    }

    .img-pers{
        background-image: url('assets/coffee.jpg');
        background-blend-mode: color-burn;
        /*filter: blur(3px);
        -webkit-filter: blur(3px);*/

        /* Full height */
        height: 100%;

        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

</style>
<header class="p-3 text-bg-dark sticky-top">
    <div class="px-3">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="/assets/logo.png" alt="" style="height: 50px;">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Главная</a></li>
                <li><a href="{{route('client_menu', ['type' => 'top'])}}" class="nav-link px-2 text-white">Меню</a></li>
                @role('user')
                <li><a href="{{route('admin_index')}}" class="nav-link px-2 text-white">Админ панель</a></li>
                @endrole
                <li>
                    @if(auth()->user())
                        <a href="{{route('cart', ['user_id' => auth()->user()->getAuthIdentifier()])}}" class="nav-link px-2 text-white">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cart">{{$totalQuantity}}</span>
                        </a>
                    @endif
                </li>
            </ul>

            <div class="text-end">
                <a href="{{route('near')}}" class="px-5 text-white text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                    </svg>
                    Кофейни рядом
                </a>
                @guest()
                    <a href="/login"><button type="button" class="btn btn-outline-light me-2">Войти</button></a>
                    <a href="/register"><button type="button" class="btn btn-success">Зарегистрироваться</button></a>
                @else
                    <span>Привет, {{ Auth::user()->name }}</span>
                @endguest
            </div>
        </div>
    </div>
</header>
<main style="height: -webkit-fill-available">
    <div class="container py-4">
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="ms-3">
                                <h5>Заказ {{$order->order_number}}</h5>
                                @php
                                    \Carbon\Carbon::setLocale('ru');
                                @endphp
                                <p class="mb-0">{{ \Carbon\Carbon::make($order->created_at)->translatedFormat('d F Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <div style="width: 180px;">
                                <h5 class="mb-0"><a href="{{route('order', ['order_id' => $order->id])}}" class="link-underline-light">Перейти к заказу</a></h5>
                                <p>{{$order->status}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container text-white">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 mt-4 border-top">
            <p class="col-md-4 mb-0">© 2024 Espresso</p>

            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Главная</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Меню</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-light">Акции</a></li>
            </ul>
        </footer>
    </div>

</main>
</body>
</html>
