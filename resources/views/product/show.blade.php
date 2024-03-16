@extends("layouts.app")

@section("title")
    Купить {{ $product->title }} по самой выгодной цене с доставкой по России
@endsection

@section("content")
    <form method="post" action="{{ route('basketAdd', ['id' => $product->id]) }}">
        @csrf
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
                @if($product->file != null)
                    <p><a href="{{ $product->filePath() }}">Документация: </a></p>
                @endif
                <div class="price-btn">
                    <span class="product-price">{{ $product->price }} &#8381; </span>
                    {{--            <span class="product-actual-price">$200</span>--}}
                    {{--            <span class="product-discount">( 50% off )</span>--}}



                    {{--            <input type="radio" name="size" value="s" checked hidden id="s-size">--}}
                    {{--            <label for="s-size" class="size-radio-btn check">s</label>--}}
                    {{--            <input type="radio" name="size" value="m" hidden id="m-size">--}}
                    {{--            <label for="m-size" class="size-radio-btn">m</label>--}}
                    {{--            <input type="radio" name="size" value="l" hidden id="l-size">--}}
                    {{--            <label for="l-size" class="size-radio-btn">l</label>--}}
                    {{--            <input type="radio" name="size" value="xl" hidden id="xl-size">--}}
                    {{--            <label for="xl-size" class="size-radio-btn">xl</label>--}}
                    {{--            <input type="radio" name="size" value="xxl" hidden id="xxl-size">--}}
                    {{--            <label for="xxl-size" class="size-radio-btn">xxl</label>--}}

                    <p>
                        <button class="btn cart-btn">В Корзину</button>
                    </p>
                </div>
            </div>
        </section>
    </form>
@endsection
