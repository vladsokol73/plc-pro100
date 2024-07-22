@extends("layouts.catalog")

@section("title")
    {{ $category->title }}  купить в розницу и оптом продукты промышленной автоматизации
@endsection

<head>
    <meta name="description" content="Вы можете выбрать {{ $category->title }} по приемлемой цене. Товары известных производителей SEW EURODRIVE, Kromschroder, Honeywell, SIEMENS, ASM, CHINA, DEMAG. Все средства разработки, конструкторы, модули содержат подробные описания, технические характеристики, фотографии, цены. Свыше 400 моделей в ассортименте для вас. Доставка по всей России.">
</head>


@section("content")
    <body>

    <main class="cd-main-content">
        <div class="cd-tab-filter-wrapper">
            <div class="cd-tab-filter">
                <ul class="cd-filters">
                    <div class="total">
                        Найдено: {{ $products->total() }} товаров

                        <div class="sort" x-data="{}">
                            <span>Сортировать</span>

                            <form x-ref="sortForm" action="{{ route('catalog', $category) }}">
                                <select name="sort" x-on:change="$refs.sortForm.submit()" class="form-select">
                                    <option value="" class="text-dark">по умолчанию</option>
                                    <option @selected(request('sort') === 'price') value="price" class="text-dark">от
                                        дешевых к
                                        дорогим
                                    </option>
                                    <option @selected(request('sort') === '-price') value="-price" class="text-dark">от
                                        дорогих
                                        к
                                        дешевым
                                    </option>
                                    <option @selected(request('sort') === 'title') value="title" class="text-dark">
                                        наименованию
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>
                </ul> <!-- cd-filters -->
            </div> <!-- cd-tab-filter -->
        </div> <!-- cd-tab-filter-wrapper -->
        <ul class="step">
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('catalog') }}">Каталог</a></li>
            @if($category->exists)
                @if($category->parent_id != null)
                    @foreach($categories as $item)
                        @if($item->id == $category->parent_id)
                            <li><a href="{{route('catalog', $item)}}">{{$item->title}}</a></li>
                        @endif
                    @endforeach
                @endif
                <li>
                    <span>{{ $category->title }}</span>
                </li>
            @endif
        </ul>
        <!-- ВСЕ ПРОДУКТЫ -->
        <section class="cd-gallery">
            <ul>
                @each('components.product', $products, 'item')
                <li class="gap"></li>
                <li class="gap"></li>
                <li class="gap"></li>
            </ul>
            <div class="cd-fail-message"><p>Не нашли что искали?<a href="{{route('contact')}}"> Напишите нам</a> и мы рассчитаем стоимость нужного вам товара.</p></div>
            {{ $products->withQueryString()->links()}}
        </section> <!-- cd-gallery -->

        <div class="cd-filter">
            <form action="{{ route('catalog', $category) }}" method="get">

                <div class="cd-filter-block">
                    <h4>Цена</h4>
                    <div class="cd-filter-content">
                        <span class="from">От, ₽</span>
                        <span class="to">До, ₽</span>
                        <div class="cost-filter">
                            <input name="filters[price][from]"
                                   value="{{ request('filters.price.from', 0) }}"
                                   type="number"
                                   class="price-from"
                                   placeholder="От">
                            <span>-</span>
                            <input name="filters[price][to]"
                                   value="{{ request('filters.price.to', 999999) }}"
                                   type="number"
                                   class="price-to"
                                   placeholder="До">
                        </div>
                    </div> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h4>Бренды</h4>
                    <ul class="cd-filter-content cd-filters list">
                        @foreach($brands as $brand)
                            <li>
                                <input
                                        class="filter"
                                        name="filters[brands][{{ $brand->id }}]"
                                        value="{{ $brand->id }}"
                                        type="checkbox"
                                        @checked(request('filters.brands.'.$brand->id))
                                        id="filters-brands-{{ $brand->id }}">

                                <label for="filters-brands-{{ $brand->id }}" class="checkbox-label">
                                    {{ $brand->title }}
                                </label>
                            </li>
                        @endforeach
                    </ul> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->

                <div>
                    <button class="button-filter" type="submit">Поиск</button>
                </div>
                @if(@request('filters'))
                    <div class="btn-fresh">
                        <a href="{{ route('catalog', $category) }}">Сбросить фильтры</a>
                    </div>
                @endif
            </form>

            <a href="#0" class="cd-close">Закрыть</a>
        </div> <!-- cd-filter -->

        <a href="#0" class="cd-filter-trigger">Фильтры</a>
    </main> <!-- cd-main-content -->
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/jquery.mixitup.min.js"></script>
    <script src="/js/main.js"></script> <!-- Resource jQuery -->
    </body>
@endsection
