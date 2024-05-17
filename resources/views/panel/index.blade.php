<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    <!--<script src="{{asset("../../js/panel/timer.js")}}"></script>-->--}}
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Keeper</title>
</head>
<!-- notification area -->
<div class="hidden absolute my-3 w-full">
    <div class="absolute top-0 right-0 w-fit text-gray-400">
        <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">Item moved successfully.</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
</div>
<!--/notification -->
<body class="bg-gray-700 text-sans overflow-hidden">
<main class="flex flex-col h-screen relative w-screen">
    <!-- Header -->
    <nav class="bg-gray-800 rounded-xl">
        <div class="mx-auto max-w-7xl px-2 md:px-6 lg:px-8">
            <div class="relative flex flex-row h-16 items-center justify-between">
                <div class="flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <!-- Auth -->
                        <div class="relative">
                            <div>
                                <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{$user->position??'user'}}&background=random&size=160" alt="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400 mt-3 ml-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute left-0 mt-2 w-40 rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none opacity-0" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="user-menu-item-0">Профиль</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="user-menu-item-1">Настройки</a>
                                <a href="auth" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="user-menu-item-2">Выйти</a>
                            </div>
                        </div>
                        <!-- /Auth -->
                    </div>
                </div>
                <!-- Logo -->
                <!-- Menu -->
                <div class="flex items-end justify-items-end">
                    <div class="block">
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white text-xl rounded-md px-3 py-2" aria-current="page">Заказы</a>
                            <a href="#" class="bg-gray-900 text-white rounded-md px-3 py-2 text-xl font-medium">Новый заказ</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white text-xl rounded-md px-3 py-2  font-medium">Панель</a>
                        </div>
                    </div>
                </div>
                <!-- /Menu -->
            </div>
        </div>
    </nav>
    <!-- /Header-->
    <!--Row-->
    <div class="w-full h-full text-white mt-5 grid grid-cols-3 gap-x-5">
        <!-- Order -->
        <div class="flex flex-col p-5 gap-x-3 bg-gray-800 rounded-xl">
            <div class="text-center bg-gray-700 rounded-t-xl w-90 p-3">
                <p>Заказ</p>
            </div>
            <div id="cart" class="overflow-y-scroll max-h-96">
                <div class="w-90 p-3 bg-gray-700 flex justify-between">
                    <span>
                        Заказ
                    </span>
                    <div>
                        <span id="price">200</span>
                        <span>₽</span>
                    </div>
                </div>
                <div class="w-90 p-3 bg-gray-700 flex justify-between items-center" data-price="200" id="item1">
                    <span>Латте</span>
                    <div class="flex items-center">
                        <span>200₽</span>
                        <button class="ml-2" onclick="removeItem('item1', 200)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Order -->
        <!-- Menu sections -->
        <div class="flex flex-col p-5 gap-x-3 gap-y-1 bg-gray-800 rounded-xl">
            <div class="text-center bg-gray-700 rounded-t-xl">
                <p>Меню</p>
            </div>
            <div></div>
            <div class="grid grid-rows-3 grid-flow-col gap-4 place-items-stretch text-lg h-96 w-full">
                <div class="col bg-gray-950 hover:bg-gray-700 h-full w-full flex justify-center items-center relative">
                    <button class="text-white font-bold py-2 px-4 rounded h-full w-full" id="hot-coffee-btn">
                        Горячий кофе
                    </button>
                </div>
                <div class="col bg-gray-900 hover:bg-gray-700 h-full w-full flex justify-center items-center relative">
                    <button class="text-white font-bold py-2 px-4 h-full w-full rounded" id="ice-coffee-btn">
                        Холодный кофе
                    </button>
                </div>
                <div class="col bg-gray-900 hover:bg-gray-700 h-full w-full flex justify-center items-center relative">
                    <button class="text-white font-bold py-2 px-4 h-full w-full rounded" id="tea-btn">
                        Чай
                    </button>
                </div>
                <div class="col bg-gray-900 hover:bg-gray-700 h-full w-full flex justify-center items-center relative">
                    <button class="text-white font-bold py-2 px-4 h-full w-full rounded" id="other-btn">
                        Проч. напитки
                    </button>
                </div>
                <div class="col bg-gray-900 hover:bg-gray-700 h-full w-full flex justify-center items-center relative">
                    <button class="text-white font-bold py-2 px-4 h-full w-full rounded" id="addons-btn">
                        Добавки
                    </button>
                </div>
                <div class="col bg-gray-900 hover:bg-gray-700 h-full w-full flex justify-center items-center relative">
                    <button class="text-white font-bold py-2 px-4 h-full w-full rounded" id="pastry-btn">
                        Выпечка
                    </button>
                </div>
            </div>
        </div>
        <!-- /Menu sections -->
        <!-- Menu list -->
        <div class="flex flex-col p-5 gap-x-3 gap-y-1 bg-gray-800 rounded-xl overflow-y-scroll overflow-x-hidden">
            <div class="text-center bg-gray-700 rounded-t-xl">
                <p>Горячий кофе</p>
            </div>
            <div class="grid grid-cols-2 gap-x-5 gap-y-2 place-items-stretch text-lg h-96 w-fit break-words" id="products-container">
                @foreach($coffee as $cof)
                    <div class="flex-col bg-gray-900 hover:bg-gray-700 h-32 lg:w-44 md:w-52 flex justify-center items-center relative">
                        <button class="text-white font-bold py-2 px-4 rounded" type="button" onclick="addToCart({{$cof->id}}, '{{$cof->name}}', {{$cof->price}})">
                            {{$cof->name}}
                        </button>
                        <span class="block text-white">{{$cof->price}}₽</span>
                        <button class="absolute top-0 right-0 p-1" id="description_{{$cof->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /Menu list -->
    </div>
    <!--/Row-->
    <!--Row-->
    <div class="w-full h-fit text-white mt-5 grid grid-cols-3 gap-5">
        <!-- Order -->
        <div class="flex flex-col w-full p-5 gap-x-3 bg-gray-800 rounded-xl">
            <button type="button" class="text-white bg-gray-950 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-lg text-lg px-5 py-2.5 me-2 w-full">
                Оплата
            </button>
        </div>
        <!-- /Order -->
        <!-- Menu sections -->
        <div class="flex flex-col p-5 gap-x-3 bg-gray-800 rounded-xl">
            <div class="grid grid-cols-2 justify-between">
                <div class="col w-full text-center">
                    <button type="button" class="text-white bg-gray-950 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-lg text-lg px-5 py-2.5 me-2 w-40">
                        Клиент
                    </button>
                </div>
                <div class="col w-full text-center">
                    <button type="button" class="text-white bg-gray-950 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-lg text-lg px-5 py-2.5 me-2 w-40">
                        Акции
                    </button>
                </div>
            </div>
        </div>
        <!-- /Menu sections -->
        <!-- Menu list -->
        <div class="flex flex-col p-5 gap-x-3 bg-gray-800 rounded-xl h-fit">
            <button type="button" class="text-white bg-gray-950 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-lg text-lg px-5 py-2.5 me-2 w-full">
                Сохранить заказ
            </button>
        </div>
        <!-- /Menu list -->
    </div>
    <!--/Row-->
    <!-- /Main-->
    <!-- If sleep for 2-3 minute Logout-->
    <!-- Main modal -->
</main>
<div id="popup" class="hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class=" px-4 pb-4 pt-5 sm:p-6 sm:pb-4 bg-gray-950">
                    <div class="sm:flex sm:items-start ">
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="font-bold text-lg leading-6 text-gray-50" id="coffee-name">coffee-nam</h3>
                            <div class="mt-2">
                                <p class="text-md text-gray-500" id="coffee-description"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-950 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" id="close-popup" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // Открытие
    function openPopup(name, description) {
        document.getElementById('coffee-name').textContent = name;
        document.getElementById('coffee-description').textContent = description;
        document.getElementById('popup').classList.remove('hidden');
    }

    // Закрытие
    document.getElementById('close-popup').addEventListener('click', function() {
        document.getElementById('popup').classList.add('hidden');
    });

    function addToCart(id, name, price) {
        const cartContainer = document.getElementById('cart');
        const cartItemHtml = `
        <div class="w-90 p-3 bg-gray-700 flex justify-between items-center" data-price="${price}" id="item${id}">
                    <span>${name}</span>
                    <div class="flex items-center">
                        <span>${price}₽</span>
                        <button class="ml-2" onclick="removeItem('item${id}', ${price})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>`;

        cartContainer.innerHTML += cartItemHtml;

        let cartPriceElement = document.getElementById('price');
        let currentPrice = parseFloat(cartPriceElement.textContent); // Получаем текущую цену и преобразуем в число
         // Прибавляем цену нового товара
        cartPriceElement.textContent = currentPrice + price; // Обновляем отображаемое значение и форматируем его с двумя знаками после запятой

        //todo Добавить добавление input hidden
    }

    function removeItem(id, price) {
        const itemElement = document.getElementById(id);
        itemElement.remove(); // Удаляем элемент товара из DOM

        // Обновляем общую цену
        const totalPriceElement = document.getElementById('price');
        let currentTotal = parseFloat(totalPriceElement.textContent);
        currentTotal -= price;
        totalPriceElement.textContent = currentTotal.toString(); // Обновляем текст цены
    }

    function renderMenu(data) {
        const container = document.getElementById('products-container');
        let htmlContent = ''; // Подготовить HTML строку для всех элементов

        data.forEach(cof => {
            htmlContent += `
    <div class="flex-col bg-gray-900 hover:bg-gray-700 min-h-32 max-h-44 w-44 flex justify-center items-center relative">
        <button class="text-white font-bold py-2 px-4 rounded" type="button" onclick="addToCart(${cof.id},'${cof.name}', ${cof.price})">
            ${cof.name}
        </button>
        <span class="block text-white">${cof.price}₽</span>
        <div class="hidden" id="id">${cof.id}</div>
        <button class="absolute top-0 right-0 p-1" id="description_${cof.id}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
        </button>
    </div>`;
        });

        // Теперь обновляем весь HTML контейнера один раз
        container.innerHTML = htmlContent;

        // Добавляем обработчики событий после того как весь HTML добавлен в DOM
        data.forEach(cof => {
            const descButton = document.getElementById(`description_${cof.id}`);
            descButton.addEventListener('click', function (){
                openPopup(`Описание ${cof.name}`, `${cof.description}`);
            });
        });
    }


    document.getElementById('hot-coffee-btn').addEventListener('click', function() {
        fetch('/panel/fetch_menu?i=hot')
            .then(response => response.json())
            .then(data => renderMenu(data));
    });

    document.getElementById('ice-coffee-btn').addEventListener('click', function() {
        fetch('/panel/fetch_menu?i=ice')
            .then(response => response.json())
            .then(data => renderMenu(data));
    });

    @foreach($coffee as $cof)
    // Формируем обработчик для каждого напитка по названию
    document.getElementById('description_{{$cof->id}}').addEventListener('click', function() {
        openPopup('Описание {{$cof->name}}', "{{$cof->description}}");
    });
    @endforeach


    document.addEventListener('DOMContentLoaded', function() {
        // Find the button that toggles the dropdown
        const userMenuButton = document.getElementById('user-menu-button');

        // Find the dropdown menu
        const menu = document.querySelector('[aria-labelledby="user-menu-button"]');

        // Function to toggle the dropdown visibility
        function toggleMenu() {
            // Check if the menu is currently visible
            const isMenuOpen = menu.getAttribute('aria-expanded') === 'true';

            // Toggle the aria-expanded attribute
            menu.setAttribute('aria-expanded', !isMenuOpen);

            // Toggle menu visibility using CSS classes for animation
            if (!isMenuOpen) {
                menu.classList.add('transition', 'ease-out', 'duration-100', 'transform', 'opacity-100', 'scale-100');
                menu.classList.remove('opacity-0', 'scale-95');
            } else {
                menu.classList.add('transition', 'ease-in', 'duration-75', 'transform', 'opacity-0', 'scale-95');
                menu.classList.remove('opacity-100', 'scale-100');
            }
        }

        // Event listener for clicking the button
        userMenuButton.addEventListener('click', toggleMenu);

        // Optional: Close the dropdown when clicking outside of it
        document.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !menu.contains(event.target)) {
                if (menu.getAttribute('aria-expanded') === 'true') {
                    toggleMenu();  // Close the menu if it's open
                }
            }
        });

        const closeButton = document.querySelector('[data-dismiss-target="#toast-success"]');

        closeButton.addEventListener('click', function() {
            const toastElement = document.getElementById('toast-success');

            // Start the fade out effect
            toastElement.style.transition = 'opacity 0.5s ease-out';
            toastElement.style.opacity = '0';

            // Wait for the transition to end before removing the element from the document
            setTimeout(() => {
                toastElement.parentNode.removeChild(toastElement);
            }, 500); // Match the duration of the fade-out effect
        });
    });
</script>
</body>
</html>
