<li class="mix">
    <div class="product-card">
        <div class="product-image">
{{--            <span class="discount-tag">50% off</span>--}}
            <a href="{{ route('product', $item) }}"><img src="{{$item->makeThumbnail('345x320')}}" alt="{{ $item->title }}" class="product-thumb"></a>
            <form method="post" action="{{ route('basketAdd', ['id' => $item->id]) }}" class="imdiz-product__buy-form">
                @csrf
                @auth()
                    @if(auth()->user()->role != 'продавец')
                        <button type="submit" class="card-btn">В корзину</button>
                    @endif
                @elseguest()
                    <button type="submit" class="card-btn">В корзину</button>
                @endguest
            </form>

            @auth()
                @if(auth()->user()->role == 'продавец')
                    <button
                        onclick="window.location.href = '{{ route('editProduct', $item->id) }}'"
                        type="button"
                        class="card-btn">
                        Редактировать товар
                    </button>
                @endif
            @endauth
        </div>
        <div class="product-info">
            <h2 class="product-brand">Название: {{ $item->title }}</h2>
            <p class="product-short-des">артикул: {{ $item->article }}</p>
            <p class="product-short-des">производитель: {{ $item->brand->title }}</p>
{{--            <span class="price"><a href="tel:+79297949431">Узнать цену</a></span>--}}
            <span class="price">{{ $item->price }}</span>
{{--            <span class="actual-price"></span>--}}
            @auth()
                @if(auth()->user()->role == 'продавец')
                    <form method="post" action="{{ route('removeProduct', $item->id) }}">
                        @csrf
                        <button type="submit" class="card-btn2">Удалить товар</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
</li>
