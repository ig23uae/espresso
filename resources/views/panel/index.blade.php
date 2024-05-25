<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="manifest" href="build/manifest.json">
    <title>Keeper</title>
</head>
@if(session('success'))
    <script>
        alert({{ session('success') }})
    </script>
@endif
<body class="text-sans overflow-hidden">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('panel_index')}}">R-Keeper</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Меню
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Заказы</a></li>
                        <li><a class="dropdown-item" href="#">Новый заказ</a></li>
                        <li><a class="dropdown-item" href="#">Выйти</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="row g-1">
        <div class="col-md-4">
            <div class="p-3 border bg-light overflow-scroll" style="height: 600px;">
                <h5 class="text-center">Заказ</h5>
                <hr>
                <div id="cart">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 border bg-light overflow-scroll" style="height: 600px;">
                <h5 class="text-center">Категории</h5>
                <hr>
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="drink" data-fetch-product="2">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Горячий кофе</span>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="drink" data-fetch-product="3">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Холодный кофе</span>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="drink" data-fetch-product="5">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Черный чай</span>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="drink" data-fetch-product="6">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Зеленый чай</span>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="food" data-fetch-product="1">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Пирожное</span>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="food" data-fetch-product="2">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Круассаны</span>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="food" data-fetch-product="3">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Торты</span>
                            </div>
                        </a>
                    </div>
                    <div class="col mb-2">
                        <a href="" class="link-underline-light" data-fetch-type="food" data-fetch-product="4">
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>Эклеры</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 menu-items-container">
            <div class="p-3 border bg-light overflow-scroll" style="height: 600px;">
                <h5 class="text-center">Позиции</h5>
                <hr>
                <div class="row row-cols-1 row-cols-md-2">

                </div>
            </div>
        </div>
    </div>
    <form id="orderForm" action="/worker_panel/submit-order" method="post">
        @csrf
        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-primary btn-client" style="width: 350px;">Клиент</button>
            </div>
            <div class="col text-center">
                <button class="btn btn-primary" style="width: 350px;">Акции</button>
            </div>
            <div class="col text-center">
                <button type="submit" class="btn btn-success" style="width: 350px;">Оплатить</button>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sizeModalLabel">Выберите размер</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="btn-group" role="group">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Client Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientModalLabel">Поиск клиента</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="searchClientForm">
                    <div class="form-group">
                        <label for="clientEmail">Email клиента</label>
                        <input type="email" class="form-control" id="clientEmail" placeholder="Введите email">
                    </div>
                    <button type="button" class="btn btn-primary mt-3" onclick="searchClient()">Найти</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clientButton = document.querySelector('.btn-client');  // Предположим, что у кнопки есть класс btn-client
        const clientModal = new bootstrap.Modal(document.getElementById('clientModal'), {
            keyboard: false
        });

        clientButton.addEventListener('click', function() {
            clientModal.show();
        });

        const links = document.querySelectorAll('a[data-fetch-type]');
        const modal = new bootstrap.Modal(document.getElementById('sizeModal'), {
            keyboard: false
        });
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const typeId = this.getAttribute('data-fetch-product');
                const typeProduct = this.getAttribute('data-fetch-type');
                const itemsContainer = document.querySelector('.menu-items-container .row');
                itemsContainer.innerHTML = '';
                // Запрос всех напитков данного типа
                fetch(`/worker_panel/drinks/${typeProduct}/${typeId}`)
                    .then(response => response.json())
                    .then(drinks => {
                        const modalBody = document.querySelector('#sizeModal .modal-body');
                        modalBody.innerHTML = ''; // Очищаем предыдущие напитки
                        drinks.forEach(drink => {
                            const drinkCol = document.createElement('div');
                            drinkCol.className = 'col mb-2';
                            drinkCol.innerHTML = `
                            <div class="card d-flex justify-content-center align-items-center" style="height: 105px;">
                                <span>${drink.name}</span>
                            </div>
                        `;
                            if (typeProduct === 'drink'){
                                itemsContainer.appendChild(drinkCol);
                                drinkCol.addEventListener('click', () => {
                                    fetchSizes(drink.id, modal, drink.name);
                                });
                            }else if(typeProduct === 'food'){
                                itemsContainer.appendChild(drinkCol);
                                drinkCol.addEventListener('click', () => {
                                    addToCartFood(drink.name, drink.id, drink.price);
                                });
                            }

                        });
                    })
                    .catch(error => console.error('Ошибка:', error));
            });
        });
    });

    function fetchSizes(drinkId, modal, drinkName) {
        fetch(`/worker_panel/drink_sizes/${drinkId}/sizes`)
            .then(response => response.json())
            .then(sizes => {
                const modalBody = document.querySelector('#sizeModal .modal-body');
                modalBody.innerHTML = ''; // Очищаем предыдущий контент
                const buttonGroup = document.createElement('div');
                buttonGroup.className = 'btn-group';
                buttonGroup.setAttribute('role', 'group');
                buttonGroup.setAttribute('aria-label', 'Sizes');
                modalBody.appendChild(buttonGroup);

                sizes.forEach(size => {
                    const sizeButton = document.createElement('button');
                    sizeButton.className = 'btn btn-primary';
                    sizeButton.innerText = `${size.size_name} - ${size.pivot.price} руб.`;
                    sizeButton.onclick = () => addToCart(size, size.pivot.price, drinkName, drinkId, modal);
                    buttonGroup.appendChild(sizeButton);
                });

                modal.show();
            })
            .catch(error => console.error('Ошибка при получении размеров:', error));
    }

    function addToCart(item, price, drinkName, drinkId, modal) {
        const uniqueKey = `${drinkId}_${item.id}`;
        const cart = document.getElementById('cart');
        const form = document.getElementById('orderForm');

        // Создаем элемент корзины
        const cartItem = document.createElement('div');
        cartItem.className = 'card mb-2';
        cartItem.innerHTML = `
        <div class="card-body d-flex justify-content-between pt-2 px-2 pb-0">
            <div>
                <p class="mb-0">${drinkName}</p>
                <p class="pt-0">— ${item.size_name}</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="me-2">${price} руб.</p>
                <span class="text-danger" style="cursor: pointer;">&times;</span>
            </div>
        </div>
    `;

        // Обработчик для удаления элемента из корзины
        const removeBtn = cartItem.querySelector('span.text-danger');
        removeBtn.addEventListener('click', function() {
            cartItem.remove();
            form.removeChild(form.querySelector(`input[name='drinks[${uniqueKey}][drink_id]']`));
            form.removeChild(form.querySelector(`input[name='drinks[${uniqueKey}][size_id]']`));
        });

        cart.appendChild(cartItem);
        modal.hide();

        // Добавляем скрытые поля в форму
        addHiddenInput(form, `drinks[${uniqueKey}][drink_id]`, drinkId);
        addHiddenInput(form, `drinks[${uniqueKey}][size_id]`, item.id);
    }

    function addToCartFood(foodName, foodId, price) {
        const uniqueKey = `food_${Date.now()}`;
        const form = document.getElementById('orderForm');
        const cart = document.getElementById('cart');
        const cartItem = document.createElement('div');
        cartItem.innerHTML = `
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between pt-2 px-2 pb-0">
                <div>
                    <p class="mb-0">${foodName}</p>
                </div>
                <div class="d-flex">
                    <p class="me-2">${price} руб.</p>
                    <span class="text-danger" style="cursor: pointer;">&times;</span>
                 </div>
            </div>
        </div>
    `;

        // Обработчик для удаления элемента из корзины
        const removeBtn = cartItem.querySelector('span.text-danger');
        removeBtn.addEventListener('click', function() {
            cartItem.remove();
            form.removeChild(form.querySelector(`input[name='foods[${uniqueKey}][food_id]']`));
            form.removeChild(form.querySelector(`input[name='foods[${uniqueKey}][price]']`));
        });

        cart.appendChild(cartItem);

        // Добавляем скрытые поля в форму
        addHiddenInput(form, `foods[${uniqueKey}][food_id]`, foodId);
        addHiddenInput(form, `foods[${uniqueKey}][price]`, price);
    }

    function searchClient() {
        const email = document.getElementById('clientEmail').value;
        const form = document.getElementById('orderForm');
        const modal = document.getElementById('clientModal');
        fetch(`/worker_panel/find_client?email=${email}`)
            .then(response => response.json())
            .then(data => {
                if (data.found) {
                    const existingInput = form.querySelector('input[name="client_id"]');
                    if (existingInput) {
                        existingInput.value = data.client_id;  // Обновляем существующее поле, если пользователь уже был найден
                    } else {
                        addHiddenInput(form, 'client_id', data.client_id);
                    }
                    alert('Клиент найден: ' + data.client_name);
                    modal.hide; // Закрываем модальное окно, если используете jQuery
                } else {
                    alert('Клиент не найден.');
                }
            })
            .catch(error => console.error('Ошибка при поиске клиента:', error));
    }

    function addHiddenInput(form, name, value) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
    }
</script>
</body>
</html>
