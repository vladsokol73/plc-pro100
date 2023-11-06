@extends("layouts.app")

@section("title", $product->title)

@section("content")
    <section class="product-details">
        <div class="image-slider">
            <img src="" alt="">
            <div class="product-images">
                <img src="img/product image 1.png" class="active" alt="">
                <img src="img/product image 2.png" alt="">
                <img src="img/product image 3.png" alt="">
                <img src="img/product image 4.png" alt="">
            </div>
        </div>

        <div class="details">
            <h2 class="product-brand">calvin klein</h2>
            <p class="product-short-des">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
            <span class="product-price">$99</span>
            <span class="product-actual-price">$200</span>
            <span class="product-discount">( 50% off )</span>

            <p class="product-sub-heading">select size</p>

            <input type="radio" name="size" value="s" checked hidden id="s-size">
            <label for="s-size" class="size-radio-btn check">s</label>
            <input type="radio" name="size" value="m" hidden id="m-size">
            <label for="m-size" class="size-radio-btn">m</label>
            <input type="radio" name="size" value="l" hidden id="l-size">
            <label for="l-size" class="size-radio-btn">l</label>
            <input type="radio" name="size" value="xl" hidden id="xl-size">
            <label for="xl-size" class="size-radio-btn">xl</label>
            <input type="radio" name="size" value="xxl" hidden id="xxl-size">
            <label for="xxl-size" class="size-radio-btn">xxl</label>

            <button class="btn cart-btn">add to cart</button>
            <button class="btn">add to wishlist</button>
        </div>
    </section>
@endsection
