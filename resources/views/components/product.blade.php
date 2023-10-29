<section class="section-card">
    <div class="card">
        @auth()
            @if(auth()->user()->role != 'продавец')
        <div class="img-container">
            <a href="{{ route('product', $item) }}" class="card__image">
                <img src="{{$item->makeThumbnail('345x320')}}" alt="{{ $item->slug }}">
            </a>
        </div>
            @endif
        @elseguest()
            <div class="img-container">
                <a href="{{ route('product', $item) }}" class="card__image">
                    <img src="{{$item->makeThumbnail('345x320')}}" alt="{{ $item->slug }}">
                </a>
            </div>
        @endguest

        <div class="infos">
            <div class="name">
                <h3 class="name">
                    {{ $item->title }}
                </h3>
{{--                <h1 class="article">{{ $item->article }}</h1>--}}
{{--                <h1 class="brand">{{ $item->brand }}</h1>--}}
                <h2 class="price">{{ $item->price }}<small> ₽</small></h2>
            </div>
        </div>

        <button class="btn btn-buy">В корзину</button>


{{--        @auth()--}}
{{--            <form action="{{ route('basketAdd', ['id' => $item->id]) }}"--}}
{{--                  method="post" class="form-inline">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="card__add">--}}
{{--                    <ion-icon name="cart-outline"></ion-icon>--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        @elseguest()--}}
{{--            <form action="{{ route('login') }}"--}}
{{--                  method="get" class="form-inline">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="card__add">--}}
{{--                    <ion-icon name="cart-outline"></ion-icon>--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        @endauth--}}
{{--    </div>--}}
</div>
@auth()
    @if(auth()->user()->role == 'продавец')
        <form method="post" action="{{ route('removeProduct', $item->id) }}">
            @csrf
            <button type="submit" class="btn btn-success">Удалить товар</button>
        </form>

        <button
            onclick="window.location.href = '{{ route('editProduct', $item->id) }}'"
            type="button"
            class="btn btn-warning">
            Редактировать товар
        </button>
    @endif
@endauth
</section>
