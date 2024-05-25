<div class="card" style="width: 22rem;">
    <img src="{{ $product->image }}" class="card-img-top pt-2" alt="{{ $product->name }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        @if(isset($product->price))
            <div class="card-text">Цена: <span id="price">{{ $product->price }}</span> руб.</div>
        @else
            <div class="card-text">Цена: <span id="price">{{ $product->sizes->first()->pivot->price ?? 'Цена не указана' }}</span>@if($product->sizes->isNotEmpty()) руб. @endif</div>
            <div class="btn-group" role="group">
                <div class="btn-group" role="group">
                    @foreach($product->sizes as $index => $size)
                        <button type="button" class="btn btn-secondary {{ $index == 0 ? 'active' : '' }}" id="size-button" data-product-id="{{ $product->id }}" data-size-id="{{ $size->id }}" data-price="{{$size->pivot->price}}">{{$size->size_name}}</button>
                    @endforeach
                </div>
            </div>
        @endif
        <hr>
        @guest()
            <button class="btn btn-success add-to-cart disabled" data-product-id="{{ $product->id }}">Для заказа необходимо авторизоваться</button>
        @else
            @php
                $products = session()->get('cart');

                $productDisplayed = false;
                $product_count = 1;
            @endphp
            @if($type == 'drinks')
                @foreach($products['drinks'] as $index => $product_drink)
                    @if($product_drink['product_id'] == $product->id)
                        @php
                            $product_count = $product_count*$product_drink['quantity'];
                        @endphp
                    @endif
                @endforeach
                @if(count($products['drinks']) > 0)
                    @foreach($products['drinks'] as $index => $product_drink)
                        @if($product_drink['product_id'] == $product->id && !$productDisplayed)
                            <button class="btn btn-success add-to-cart disabled" data-product-id="{{ $product->id }}">В корзине: {{$product_count}}</button>
                            <button class="btn btn-primary minus" data-product-type="{{$type}}" data-product-id="{{ $product->id }}" data-size-id="{{ $product->sizes->first()->id ?? '' }}">-</button>
                            <button class="btn btn-primary plus" data-product-type="{{$type}}" data-product-id="{{ $product->id }}" data-size-id="{{ $product->sizes->first()->id ?? '' }}">+</button>
                            @php
                                $productDisplayed = true; // Устанавливаем флаг в true после вывода кнопок
                            @endphp
                        @endif
                    @endforeach
                @else
                    <button class="btn btn-success add-to-cart" data-product-type="{{$type}}" data-product-id="{{ $product->id }}" data-size-id="{{ $product->sizes->first()->id ?? '' }}">Добавить в корзину</button>
                    <button class="btn btn-primary minus d-none" data-product-type="{{$type}}" data-product-id="{{ $product->id }}" data-size-id="{{ $product->sizes->first()->id ?? '' }}">-</button>
                    <button class="btn btn-primary plus d-none" data-product-type="{{$type}}" data-product-id="{{ $product->id }}" data-size-id="{{ $product->sizes->first()->id ?? '' }}">+</button>
                @endif
            @elseif($type == 'foods')
                @if(count($products['foods']) > 0)
                    @foreach($products['foods'] as $index => $product_food)
                        @if($product_food['id'] == $product->id)
                            <button class="btn btn-success add-to-cart disabled" data-product-id="{{ $product->id }}">В корзине: {{$product_food['quantity']}}</button>
                            <button class="btn btn-primary minus" data-product-type="{{$type}}" data-product-id="{{ $product->id }}">-</button>
                            <button class="btn btn-primary plus" data-product-type="{{$type}}" data-product-id="{{ $product->id }}">+</button>
                        @endif
                    @endforeach
                @else
                    <button class="btn btn-success add-to-cart" data-product-type="{{$type}}" data-product-id="{{ $product->id }}">Добавить в корзину</button>
                    <button class="btn btn-primary minus d-none" data-product-type="{{$type}}" data-product-id="{{ $product->id }}">-</button>
                    <button class="btn btn-primary plus d-none" data-product-type="{{$type}}" data-product-id="{{ $product->id }}">+</button>
                @endif
            @endif
        @endguest
    </div>
</div>
