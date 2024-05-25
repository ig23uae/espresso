@php
    $totalQuantity = session()->get('total_items');
    //@dd($cart['total_items'])
    //$totalQuantity = $cart['total_items'];
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
                <li><a href="/" class="nav-link px-2 text-white">Главная</a></li>
                <li><a href="{{route('client_menu', ['type' => 'top'])}}" class="nav-link px-2 text-secondary">Меню</a></li>
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
    <div class="row container-fluid object-fit-cover">
        <div class="col-2">
            <div class="offcanvas-md offcanvas-end" tabindex="999" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-body pt-lg-3 overflow-x-hidden">
                    @include('client.menu-component')
                    <hr class="my-3">
                </div>
            </div>
        </div>

        <div class="col-10">
            <div class="align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-light">Меню</h1>
                <div class="row p-3 gap-4">
                    <!-- Это для напитков -->
                    <!-- Это для еды -->
                    @foreach($drinks as $product)
                        @include('client.product-card', ['product' => $product, 'type' => 'drinks'])
                    @endforeach

                    @foreach($foods as $product)
                        @include('client.product-card', ['product' => $product, 'type' => 'foods'])
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
        const buttons = document.querySelectorAll('#size-button');
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        const plusButtons = document.querySelectorAll('.plus');
        const minusButtons = document.querySelectorAll('.minus');
        const priceDisplay = document.getElementById('price');  // Убедитесь, что этот элемент существует

        // Обработчик кнопок размера напитка
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const price = this.getAttribute('data-price');
                const sizeId = this.getAttribute('data-size-id');
                const productId = this.getAttribute('data-product-id');
                priceDisplay.textContent = price;
                buttons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Обновляем размер и цену для всех связанных кнопок
                const relatedAddToCartButtons = document.querySelectorAll(`button.add-to-cart[data-product-id="${productId}"]`);
                const relatedPlusButtons = document.querySelectorAll(`button.plus[data-product-id="${productId}"]`);
                const relatedMinusButtons = document.querySelectorAll(`button.minus[data-product-id="${productId}"]`);

                // Обновляем атрибут 'data-size-id' для кнопок 'Добавить в корзину', 'Плюс' и 'Минус'
                [...relatedAddToCartButtons, ...relatedPlusButtons, ...relatedMinusButtons].forEach(btn => {
                    btn.setAttribute('data-size-id', sizeId);
                });

                //Отображаем количество товаров в корзине
            });
        });

        // Обработчики для кнопок корзины
        const updateCartButtons = [...addToCartButtons, ...plusButtons, ...minusButtons];
        updateCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productType = this.getAttribute('data-product-type');
                const sizeId = this.getAttribute('data-size-id');
                const quantityChange = button.classList.contains('plus') ? 1 : button.classList.contains('minus') ? -1 : 1;
                updateCart(productId, productType, sizeId, quantityChange);
            });
        });
    });
    //Здесь делаем запрос
    function updateCart(productId, productType, sizeId, quantityChange) {
        const cart = document.getElementById('cart');
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ product_id: productId, product_type: productType, size_id: sizeId, quantity: quantityChange })
        }).then(response => response.json())
            .then(data => {
                const cartButton = document.querySelector(`button[data-product-id="${productId}"].add-to-cart`);
                const plusButton = document.querySelector(`button[data-product-type="${productType}"][data-product-id="${productId}"].plus`);
                const minusButton = document.querySelector(`button[data-product-type="${productType}"][data-product-id="${productId}"].minus`);
                if (data.total_items > 0) {
                    cartButton.textContent = `В корзине: ${data.total_items}`;
                    cartButton.classList.add('disabled');
                    plusButton.classList.remove('d-none');
                    minusButton.classList.remove('d-none');
                } else {
                    cartButton.textContent = 'Добавить в корзину';
                    cartButton.classList.remove('disabled');
                    plusButton.classList.add('d-none');
                    minusButton.classList.add('d-none');
                }
                cart.textContent = `${data.total_items}`;
            });
    }
</script>
</body>
</html>
