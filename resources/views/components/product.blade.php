<section>
<li class="imdiz-product">
    <div class="imdiz-product__inner">
        <div class="imdiz-product__image-wrap">
            <a href="{{ route('product', $item) }}" class="imdiz-product__img-link">
                <img src="{{$item->makeThumbnail('345x320')}}" alt="{{ $item->slug }}">
            </a>
        </div>

        <div class="imdiz-product__info">
            <a href="{{ route('product', $item) }}" class="imdiz-product__name">{{ $item->title }}</a>
            <p class="imdiz-product__price">
                <span class="imdiz-product__cost">{{ $item->price }}</span>
                <span class="imdiz-product__currency">&#8381;</span>
            </p>
                                <p class="imgiz-product__article"></p>
        </div>

        <form method="post" action="{{ route('basketAdd', ['id' => $item->id]) }}" class="imdiz-product__buy-form">
            @csrf
            @auth()
                @if(auth()->user()->role != 'продавец')
                    <input type="hidden">
                    <button type="submit" class="imdiz-product__submit">В КОРЗИНУ</button>
                @endif
            @elseguest()
                <input type="hidden">
                <button type="submit" class="imdiz-product__submit">В КОРЗИНУ</button>
            @endguest
        </form>

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
    </div>
</li>
</section>
