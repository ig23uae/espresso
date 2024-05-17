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
                <li><a href="/" class="nav-link px-2 text-white">Главная</a></li>
                <li><a href="/menu" class="nav-link px-2 text-secondary">Меню</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Акции</a></li>
            </ul>

            <div class="text-end">
                <a href="#" class="px-5 text-white text-decoration-none">
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
<main>
    <div class="row container-fluid object-fit-cover">
        <div class="col-2">
            <div class="offcanvas-md offcanvas-end" tabindex="999" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-body pt-lg-3 overflow-x-hidden">
                    <div class="flex-shrink-0 w-100">
                        <br class="px-3">
                        <ul class="list-unstyled ps-0">
                            <li class="mb-1">
                                <button class="btn text-light btn-toggle d-inline-flex align-items-center justify-content-between rounded border-0 collapsed w-100" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                                    <h2>Кофе</h2>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                </button>
                                <div class="collapse show" id="home-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <li><a href="{{route('client_menu', ['type' => 'hot'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>Популярное</h5></a></li>
                                        <li><a href="{{route('client_menu', ['type' => 'hot'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>Горячее</h5></a></li>
                                        <li><a href="{{route('client_menu', ['type' => 'hot'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>Холодное</h5></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="mb-1">
                                <button class="btn text-light btn-toggle d-inline-flex align-items-center justify-content-between rounded border-0 collapsed w-100" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                                    <h3>Выпечка</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                </button>
                                <div class="collapse show" id="dashboard-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded"><h5>пирожное</h5></a></li>
                                        <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded"><h5>круассаны</h5></a></li>
                                        <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded"><h5>торты</h5></a></li>
                                        <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded"><h5>эклеры</h5></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="mb-1">
                                <button class="btn text-light btn-toggle d-inline-flex align-items-center justify-content-between rounded border-0 collapsed w-100" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                                    <h3>Чаи</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                </button>
                                <div class="collapse show" id="orders-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <li><a href="{{route('client_menu', ['type' => 'tea'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>чай-латте</h5></a></li>
                                        <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded"><h5>черный</h5></a></li>
                                        <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded"><h5>зеленый</h5></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <hr class="my-3">
                </div>
            </div>
        </div>

        <div class="col-10">
            <div class="align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-light">Меню</h1>
                <div class="row p-3 gap-4">
                    @foreach($products as $product)
                        <div class="card" style="width: 22rem;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Cappuccino_at_Sightglass_Coffee.jpg/640px-Cappuccino_at_Sightglass_Coffee.jpg" class="card-img-top pt-2" alt="{{$product->name}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text">{{ substr($product->description, 0, 50) }}{{ strlen($product->description) > 50 ? '...' : '' }}</p>
                                <p class="card-text">{{$product->price}}₽</p>
                                @guest()
                                    <button class="btn btn-success add-to-cart disabled" data-product-id="{{ $product->id }}">Для заказа необходимо авторизоваться</button>
                                @else
                                    <button class="btn btn-success add-to-cart" data-product-id="{{ $product->id }}">Добавить в корзину</button>
                                    <button class="btn btn-primary minus d-none" data-product-id="{{ $product->id }}">-</button>
                                    <button class="btn btn-primary plus d-none" data-product-id="{{ $product->id }}">+</button>
                                @endguest
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr class="my-5">
    <div class="container text-white mt-5">
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        const plusButtons = document.querySelectorAll('.plus');
        const minusButtons = document.querySelectorAll('.minus');

        function updateCart(productId, quantityChange) {
            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ product_id: productId, quantity: quantityChange })
            }).then(response => response.json())
                .then(data => {
                    const cartButton = document.querySelector(`button[data-product-id="${productId}"].add-to-cart`);
                    const plusButton = document.querySelector(`button[data-product-id="${productId}"].plus`);
                    const minusButton = document.querySelector(`button[data-product-id="${productId}"].minus`);
                    if (data.quantity > 0) {
                        cartButton.textContent = `В корзине: ${data.quantity}`;
                        cartButton.classList.add('disabled');
                        plusButton.classList.remove('d-none');
                        minusButton.classList.remove('d-none');
                    } else {
                        cartButton.textContent = 'Добавить в корзину';
                        cartButton.classList.remove('disabled');
                        plusButton.classList.add('d-none');
                        minusButton.classList.add('d-none');
                    }
                });
        }

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                updateCart(productId, 1);
            });
        });

        plusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                updateCart(productId, 1);
            });
        });

        minusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                updateCart(productId, -1);
            });
        });
    });
</script>
</body>
</html>
