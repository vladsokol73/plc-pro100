@extends("layouts.app")

@section("title")
    Корзина
@endsection

@section('content')
    <div class="top-bar">
        <a href="{{route('catalog')}}">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Продолжить покупки</span>
    </div>

    @if (count($products))
        <div class="bag">
            <p class="bag-head"><span style="text-transform: uppercase">В вашей корзине</span> - {{count($products)}}
                товар(ов)</p>
        </div>
        @php
            $basketCost = 0;
        @endphp

        @foreach($products as $product)
            @php
                $count = 1;
                $itemPrice = $product->price * $count;
                $basketCost = $basketCost + $itemPrice;
            @endphp
            <div class="cart-product">
            <section class="product-details">
                <div class="image-slider">
                    <img src="{{$product->makeThumbnail('345x320')}}" alt="{{ $product->title }}">
                </div>

                <div class="details">
                    <h2 class="product-brand">{{ $product->title }}</h2>
                    <p class="product-short-des">{{ $product->description }}</p>
                    <p class="product-sub-heading">Спецификация</p>
                    <p>Тип: @foreach($product->categories as $category)
                            {{ $category->title }}
                        @endforeach</p>
                    <p>Производитель: {{ $product->brand->title }}</p>
{{--                    <p>--}}
{{--                    <label for="count" style="margin-right: 0.5rem;">Количество:</label>--}}
{{--                    <select name="count" id="count">--}}
{{--                        <option value disabled>Выберите</option>--}}
{{--                        <option value="1" selected>1</option>--}}
{{--                        <option value="2">2</option>--}}
{{--                        <option value="3">3</option>--}}
{{--                    </select>--}}
{{--                    </p>--}}
                    <span class="product-price">{{ $product->price}} &#8381; </span>
                    <form action="{{ route('basketRemove', ['id' => $product->id]) }}"
                          method="post" class="basket-remove">
                        @csrf
                        <button type="submit" class="btn btn-remove">Удалить</button>
                    </form>
                </div>
            </section>
            </div>
        @endforeach
        <div class="bag-total">
            <div class="delivery">
                <p class="small">Доставка: не входит в стоимость<br>
            </div>
            <div class="total">
                <h3>Итого: {{ $basketCost }} &#8381;</h3>
            </div>

            @auth()
                <button onclick="window.location='{{ route('checkout') }}'" class="btn-go-checkout">
                    <i class="fas fa-lock"></i>
                    <span>Оформить заказ</span>
                </button>
            @elseguest()
                <button onclick="window.location='{{ route('login') }}'" class="btn-go-checkout">
                    <i class="fas fa-lock"></i>
                    <span>Оформить заказ</span>
                </button>
            @endguest
        </div>

        <div class="help">
            <p>Нужна помощь? Звоните бесплатно <a href="tel:+79297949431">+7(929)794-94-31</a></p>
        </div>
    @else
        <p>Ваша корзина пуста</p>
    @endif
@endsection

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
      integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
