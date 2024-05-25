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
                    <li><a href="{{route('client_menu', ['type' => 'top'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>Популярное</h5></a></li>
                    <li><a href="{{route('client_menu', ['type' => 'hot coffee'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>Горячее</h5></a></li>
                    <li><a href="{{route('client_menu', ['type' => 'cold coffee'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>Холодное</h5></a></li>
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
                    <li><a href="{{route('client_menu', ['type' => 'black tea'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>черный</h5></a></li>
                    <li><a href="{{route('client_menu', ['type' => 'green tea'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>зеленый</h5></a></li>
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
                    <li><a href="{{route('client_menu', ['type' => 'brownie'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>пирожное</h5></a></li>
                    <li><a href="{{route('client_menu', ['type' => 'croissants'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>круассаны</h5></a></li>
                    <li><a href="{{route('client_menu', ['type' => 'cakes'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>торты</h5></a></li>
                    <li><a href="{{route('client_menu', ['type' => 'eclairs'])}}" class="link-light d-inline-flex text-decoration-none rounded"><h5>эклеры</h5></a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
