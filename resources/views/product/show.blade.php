@extends("layouts.card")

@section("title")
    {{ $product->title }} - купить по самой низкой цене с доставкой по россии - plc-pro100
@endsection
<head>
    <meta name="description"
          content="купить {{ $product->title }} от производителя {{ $product->brand->title }}! {{ $product->description }}. Низкая цена по России, быстрая доставка и лучшее качество 8 (929) 794-94-31">
    <meta name="keywords" content="{{ $product->brand->title }}, {{ $product->title }}, {{ $product->article }}">
</head>

@section("content")
    {{--    <form method="post" action="{{ route('basketAdd', ['id' => $product->id]) }}">--}}
    {{--        @csrf--}}
    {{--        <section class="product-details">--}}
    {{--            <div class="image-slider">--}}
    {{--                <img src="{{$product->makeThumbnail('345x320')}}" alt="{{ $product->title }}">--}}
    {{--            </div>--}}

    {{--            <div class="details">--}}
    {{--                <h1 class="product-brand">{{ $product->title }}</h1>--}}
    {{--                <p class="product-short-des"><h2>{{ $product->description }}</h2></p>--}}
    {{--                <h3><p class="product-sub-heading">Спецификация</p></h3>--}}
    {{--                <p>Тип: @foreach($product->categories as $category)--}}
    {{--                        {{ $category->title }}--}}
    {{--                    @endforeach</p>--}}
    {{--                <p>Производитель: {{ $product->brand->title }}</p>--}}
    {{--                @if($product->file != null)--}}
    {{--                    <p><a href="{{ $product->filePath() }}">Документация: </a></p>--}}
    {{--                @endif--}}
    {{--                <div class="price-btn">--}}
    {{--                    <span class="product-price">{{ $product->price }}</span>--}}
    {{--                    --}}{{--            <span class="product-actual-price">$200</span>--}}
    {{--                    --}}{{--            <span class="product-discount">( 50% off )</span>--}}



    {{--                    --}}{{--            <input type="radio" name="size" value="s" checked hidden id="s-size">--}}
    {{--                    --}}{{--            <label for="s-size" class="size-radio-btn check">s</label>--}}
    {{--                    --}}{{--            <input type="radio" name="size" value="m" hidden id="m-size">--}}
    {{--                    --}}{{--            <label for="m-size" class="size-radio-btn">m</label>--}}
    {{--                    --}}{{--            <input type="radio" name="size" value="l" hidden id="l-size">--}}
    {{--                    --}}{{--            <label for="l-size" class="size-radio-btn">l</label>--}}
    {{--                    --}}{{--            <input type="radio" name="size" value="xl" hidden id="xl-size">--}}
    {{--                    --}}{{--            <label for="xl-size" class="size-radio-btn">xl</label>--}}
    {{--                    --}}{{--            <input type="radio" name="size" value="xxl" hidden id="xxl-size">--}}
    {{--                    --}}{{--            <label for="xxl-size" class="size-radio-btn">xxl</label>--}}

    {{--                    <p>--}}
    {{--                        <button class="btn cart-btn">Купить</button>--}}
    {{--                    </p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--    </form>--}}




    <div id=content class=content>
        <div id=breadcrumbs>
<span id=breadcrumbs_items>
<a href="{{ route('home') }}">Главная</a> › <a href="{{ route('catalog') }}">Каталог</a>
    @foreach($product->categories as $category)
        › <a href="{{route('catalog', $category)}}">{{ $category->title}}</a>
    @endforeach› <span class=bc__item>{{ $product->title }}</span> </span>
        </div>

        <div id=content_main class=content_main>
            <div itemscope itemtype=http://schema.org/Product>
                <div class=main-header>
                    <div class=main-header__extra id=headerextra>
                    </div>
                    <h1 itemprop=name>{{ $product->title }}</h1>
                    <div class=clear></div>
                </div>
                <div class=product_main>
                    <div class=product_main-photo>
                        <div class=product__image-previews id=productphotobox>
                            <div class=item__image_medium_wrapper>
                                <span
                                    title="{{ $product->title }}" class=galery
                                    data-fancybox-group=galery><img src="{{$product->makeThumbnail('345x320')}}"
                                                                    alt="{{ $product->title }}"
                                                                    class="product__image-preview item__image_medium"
                                                                    alt="750-556, Output Module DIN Rail -10 ~ 10VDC"
                                                                    itemprop=image></span>
                                <div class="product__image-warning subnote">Изображения служат только для
                                    ознакомления,<br><span class=nw>см. техническую документацию</span></div>
                            </div>
                        </div>
                    </div>
                    <div class=product_main-controls>
                        {{--                        <div class="product__extrainfo ptext">--}}
                        {{--                            <div class=product__extrainfo-row><span--}}
                        {{--                                    class="item__avail item__avail_delivery item__avail_float"><b>8 шт.</b>, <span--}}
                        {{--                                        class=nw>срок 7-9 недель</span></span></div>--}}
                        {{--                            <div class=product__extrainfo-row><span--}}
                        {{--                                    class="item__avail item__avail_delivery item__avail_float">Бесплатная доставка 5Post, СДЭК и Я.Доставка</span>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="product__ordering clear" itemprop=offers itemscope
                             itemtype=http://schema.org/AggregateOffer>
                            <link itemprop=url href=https://www.chipdip.ru/product1/8033904209>
                            <link itemprop=availability href=http://schema.org/InStock>
                            <div id=ordering>
                                <div class=ordering-price-w>
                                    <div class=ordering-mainoffer-price-w>
                                        <div class="ordering-mainoffer-price nw"><span class=ordering__value
                                                                                       id=price_8033904209> {{ $product->price }}</span><span
                                                class=rub> руб.</span></div>
                                    </div>
                                    <div class=font-mini>
                                    </div>
                                </div>
                                <div class=ordering-calc-w>
                                    <div class=ordering__quantity>
                                        <button class="input__decrementer input__decrementer_disabled" disabled>−
                                        </button>
                                        <input autocomplete=off
                                               class="input input_qty ordering__value ordering__value_quantity"
                                               data-discounts=[[1,139400.00]] data-itemid=8033904209 data-min=1
                                               data-pricemode=0 data-reset=false data-step=1 id=qty_8033904209
                                               maxlength=4 placeholder=1 type=search value=1>
                                        <button class=input__incrementer>+</button>
                                    </div>
                                    <div class=font-mini>
                                    </div>
                                </div>
                                <div class="ordering-verification-w ptext">
                                </div>
                                <div class="ordering-tocart-info ptext nw not-print">
<span>
<svg class=ordering-tocart-info-arrow fill=none height=11 viewBox="0 0 15 11" width=15><g id=main_slider-button-next>
 <path d="M0.800049 5.34283H13.8286M13.8286 5.34283L9.48576 0.35582M13.8286 5.34283L9.48576 10.6415"
       stroke=#1C2D38></path>
 </g><use xlink:href=#main_slider-button-next></use></svg> <span id=totalQty>1</span> <span>шт.</span>
</span>
                                    <span class=nw>
на сумму <span id=totalPrice>{{ $product->price }}</span><span><span class=rub> руб.</span></span>
</span>
                                </div>
                                <div class="ordering-buttons not-print">
                                    <form method="post" id="basket_add" action="{{ route('basketAdd', ['id' => $product->id]) }}">
                                        @csrf
                                    </form>
                                    <button class="button button_red button_big add2cart"
                                            data-widebutton=true type=submit form="basket_add"><span>Добавить в корзину</span></button>

                                    <button id="item_oneclick" class="button button_big button_light oneclick"
                                            data-id=qty_8033904209>Купить в 1 клик
                                    </button>
                                </div>
                                <div id=platichastyami class="platichastyami not-display sf-hidden"
                                     data-href=/products/platichastyami data-minprice=1000 data-maxprice=70000
                                     data-summa=139400>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_main-ids ptext">
                        {{--                        <div class=product_main-id><span class=summary__label>Номенклатурный номер:</span> <span>8033904209</span>--}}
                        {{--                        </div>--}}
                        <div class=product_main-id><span class=summary__label>Артикул:</span> <span
                                itemprop=model>{{ $product->article }}</span>
                        </div>
                        <div class=product_main-id><span class=summary__label>Бренд:</span> <a
                                itemprop=brand>{{ $product->brand->title }}</a>
                        </div>
                        <div class="product_main-id mnf_logo_wrap not-print"><a><img
                                    src="{{$product->brand->makeThumbnail('280x140')}}"
                                    alt="{{ $product->brand->title }}"
                                    class="mnf_logo img-optimize"></a></div>
                    </div>
                </div>
                <div class=product_content>
                    <div class=product_content-main id=specification>
                        <div class=product_content-w>
                            <h3>Описание</h3>
                            <div class="showhide item_desc" itemprop=description style=max-height:none>
                                <div>{{ $product->description }}</div>
                            </div>
                            <h3>Технические параметры</h3>
                            <div class=clear>
                                <div class=product__params-w>
                                    <div class=noop>
                                        <table class="product__params ptext" id=productparams>
                                            <tbody>
                                            <tr>
                                                <td class=product__param-name>Документация</td>
                                                <td class=product__param-value><a href="{{ $product->filePath() }}">открыть</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=product_content-add>
                        <div class=product_content-add-block>
                            <div class=product_content-w2><h3>Сроки доставки</h3>
                                <div class="item_tabs_content item_tabs_delivery" id=deliveryinfo>
                                    <p>Доставка по <b class=nw>России</b></p>
                                    <table class="product__params w100 ptext no-visited">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <span
                                                    data-fancybox-href="/products/delivmap?shopid=0&amp;data=2+%D0%BD%D0%BE%D1%8F%D0%B1%D1%80%D1%8F"
                                                    class="link_pseudo nw">До выбранного пункта выдачи</span><sup></sup>
                                            </td>
                                            <td class=nw><em></em></td>
                                            <td class="tright nw">
                                                <span class=green_text>до месяца</span><sup></sup></td>
                                        </tr>

                                    </table>
                                    <div class=item_tabs_delivery_comments>
                                        <div><sup>1</sup> <span class=subnote>ориентировочно, дата доставки зависит от даты оплаты или подтверждения заказа</span>
                                        </div>
                                        {{--                                        <div><sup>2</sup> <span--}}
                                        {{--                                                class=subnote>для посылок массой до&nbsp;1&nbsp;кг</span></div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=product_content-add-block>
                            <div class=product_content-w2><h3>Цена и наличие в магазинах</h3>
                                <div class="item_tabs_content item_tabs_av">
                                    <div class="city_shops ptext">
                                        <table class="product__params product__params_1 w100" id=avinfo>
                                            <tbody>
                                            <tr>
                                                <td class=shops><span
                                                        class="">По России</span>
                                                </td>
                                                <td class="q nw">индивидуально</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=clear></div>
    </div>
    </div>


{{--    Всплывающее окно--}}
    <div id="popup" class="fancybox-overlay fancybox-overlay-fixed" style=width:auto;height:auto;>
        <div class="fancybox-wrap fancybox-desktop fancybox-type-ajax fancybox-strict fancybox-opened" tabindex=-1 style=width:640px;height:auto;position:absolute;top:198px;left:612px;opacity:1;overflow:visible>
            <div class=fancybox-skin style=padding:30px;width:auto;height:auto>
                <div class=fancybox-outer>
                    <div id="popup_box" class=fancybox-inner style=overflow:auto;width:580px;height:auto>
                        <h3>Заказ в один клик</h3>
                        <div style=min-width:580px;min-height:380px id=oneclick_wrapper>
                            <p>
                                <span>Пожалуйста, заполните краткую контактную информацию.</span><br>
                                <span>Получив заказ, наши сотрудники свяжутся с Вами.</span>
                            </p>
                            <form class="form form__big w7em" action="{{ route('oneclick-save', ['product_name' => $product->title]) }}" style="margin-top: 5%" method=post id=oneclick_form>
                                @csrf
                                <dl class="form__row clear">
                                    <dt class="form__label">Ваш телефон</dt>
                                    <dd class=form__field><input name=phone type=text value placeholder class="input input_medium required servercheck" maxlength=15></dd>
                                </dl>
                                <dl class="form__row clear">
                                    <dt class=form__label>Имя</dt>
                                    <dd class=form__field><input name=name type=text value placeholder class="input input_big" minlength="2" maxlength=25></dd>
                                </dl>
                                <dl class="form__row clear">
                                    <dt class=form__label>Комментарий</dt>
                                    <dd class=form__field><textarea id=notes maxlength="255" name=message class="input input_textarea" value></textarea></dd>
                                </dl>
                                <dl class="form__row clear required_one" data-error-msg="Требуется подтверждение согласия">
                                    <dt class=form__label></dt>
                                    <dd class=form__field><div class="like-input like-input-w"><input id=privacy class="radio unselectable chi-input chi-checkbox" name=privacy type=checkbox required value=on> <label for=privacy><span>я принимаю условия <a href="{{ route('police') }}" class="" target=_blank>политики конфиденциальности</a></span></label></div></dd>
                                </dl>
                                <dl class="form__row clear">
                                    <dt class=form__label></dt>
                                    <dd class=form__field><button type=submit class="button button_w100">Оформить заказ</button></dd>
                                </dl>
                            </form>
                            <p>&nbsp;</p>
                            <p style=max-width:580px>Вопросы несвязанные с заказом и доставкой товара, вы можете задать по <a href="{{ route('contact') }}" class="link nw">обратной связи</a>.</p>
                        </div>
                    </div></div><a title=Закрыть class="fancybox-item fancybox-close" id="close_popup"></a></div></div></div>
    <script src="/js/productcart.js"></script>
@endsection
