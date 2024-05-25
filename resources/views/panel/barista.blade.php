<!doctype html>
<html lang="en">
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
    <title>Панель заказов</title>
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
        background-color: var(--main-background-color);
        color: var(--text-color);
    }

    main {
        background-color: var(--main-background-color);
    }

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container py-5">
    <h1>Заказы: </h1>
    <div class="row row-cols-1 row-cols-md-3 g-4" id="orders-container">
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Pusher.logToConsole = true;
        const pusher = new Pusher('13497658b33063c4d983', {
            cluster: 'eu',
        });

        const channel = pusher.subscribe('order-channel');
        channel.bind('order-status', function(data) {
            console.log("Полученные данные:", data);  // Логирование данных для отладки
            if (data && data.order) {
                console.log("Новый заказ ID:", data.order);
                loadOrderDetails(data.order);
            } else {
                console.error("Ошибка: ID заказа не получен");
            }
        });

        function loadOrderDetails(orderId) {
            fetch(`/barista/get-order-details/${orderId}`)
                .then(response => response.json())
                .then(orderData => {
                    if (orderData && orderData.drink_details) {
                        displayOrder(orderData);
                    } else {
                        console.error("Ошибка: Детали заказа не загружены", orderData);
                    }
                })
                .catch(error => {
                    console.error("Ошибка при загрузке деталей заказа:", error);
                });
        }

        function displayOrder(orderData){
            const ordersContainer = document.getElementById('orders-container');

            // Создание основного контейнера для нового заказа
            const orderCol = document.createElement('div');
            orderCol.className = 'col';
            orderCol.id = 'order-' + orderData.id;

            // Создание карточки заказа
            const card = document.createElement('div');
            card.className = 'card';

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body';

            // Заголовок карточки
            const cardTitle = document.createElement('h5');
            cardTitle.className = 'card-title';
            cardTitle.innerHTML = 'Заказ <span id="order-number">' + orderData.order_number + '</span>';

            // Список напитков в заказе
            const cardText = document.createElement('ul');
            cardText.className = 'card-text';
            orderData.drink_details.forEach(drink => {
                const drinkItem = document.createElement('li');
                drinkItem.textContent = drink.drink_size_pivot.drink.name + ' - ' + drink.drink_size_pivot.size.size_name;

                const additionsList = document.createElement('ul');
                // Предположим, что у тебя есть добавки в модели, здесь мы добавляем примерную структуру
                //const addition = document.createElement('li');
                //addition.textContent = 'Добавка'; // Замени 'Добавка' на реальные данные, если они есть
                //additionsList.appendChild(addition);

                drinkItem.appendChild(additionsList);
                cardText.appendChild(drinkItem);
            });

            // Кнопки управления
            const buttonRow = document.createElement('div');
            buttonRow.className = 'row';

            const warningBtnCol = document.createElement('div');
            warningBtnCol.className = 'col';
            const warningBtn = document.createElement('button');
            warningBtn.className = 'btn btn-warning';
            warningBtn.textContent = 'Списание';
            warningBtnCol.appendChild(warningBtn);

            const successBtnCol = document.createElement('div');
            successBtnCol.className = 'col';
            const successBtn = document.createElement('button');
            successBtn.onclick = function() { changeOrderStatus(orderData.id, 'ready'); };
            successBtn.className = 'btn btn-success';
            successBtn.textContent = 'Готово';
            successBtnCol.appendChild(successBtn);

            buttonRow.appendChild(warningBtnCol);
            const emptyCol = document.createElement('div');
            buttonRow.appendChild(emptyCol); // Пустой столбец для выравнивания
            emptyCol.className = 'col';
            buttonRow.appendChild(successBtnCol);

            // Сборка всего вместе
            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardText);
            cardBody.appendChild(buttonRow);
            card.appendChild(cardBody);
            orderCol.appendChild(card);

            // Добавление в DOM
            ordersContainer.appendChild(orderCol);

            // Логика обработки данных здесь
            //alert(JSON.stringify(data))
            //console.log(data);
        }


        // Весь ваш код здесь

        // Функция для изменения статуса заказа на 'готово'
        function changeOrderStatus(orderId, status) {
            fetch(`/barista/ready/${orderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: status })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Статус изменён:', data);
                        // Удалить элемент заказа из DOM
                        const orderElement = document.getElementById('order-' + orderId);
                        if (orderElement) {
                            orderElement.remove();
                        }
                    } else {
                        console.error('Ошибка при изменении статуса:', data);
                    }
                })
                .catch(error => console.error('Ошибка:', error));
        }
    });
</script>
</body>
</html>
