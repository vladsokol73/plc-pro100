@extends("layouts.app")

@section("title", $user->name ?? 'Каталог')

@section("content")
    <body>
    <section>
        <ul class="step">
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('catalog') }}">Каталог</a></li>

            @if($category->exists)
                <li>
                    <span>{{ $category->title }}</span>
                </li>
            @endif
        </ul>
    </section>

    <section>
        <div class="category">
        <h3>Категории</h3>
        <div>
            @each('components.category', $categories, 'item')
        </div>
        </div>
    </section>

    <section>
        <aside class="filter">
            <form action="{{ route('catalog', $category) }}" method="get" class="filter">
                <div>
                    <h5 class="filter-price">Цена</h5>
                    <div>
                        <span class="from">От, ₽</span>
                        <span class="to">До, ₽</span>
                    </div>
                </div>

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
                <div>
                    <h3>Бренды</h3>
                    @foreach($brands as $brand)
                        <div>
                            <input name="filters[brands][{{ $brand->id }}]"
                                   value="{{ $brand->id }}"
                                   type="checkbox"
                                   @checked(request('filters.brands.'.$brand->id))
                                   id="filters-brands-{{ $brand->id }}">

                            <label for="filters-brands-{{ $brand->id }}" class="form-checkbox-label">
                                {{ $brand->title }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div>
                    <button type="submit">Поиск</button>
                </div>
                @if(@request('filters'))
                    <div>
                        <a href="{{ route('catalog', $category) }}">Сбросить фильтры</a>
                    </div>
                @endif
            </form>
        </aside>
        <div class="total">
            Найдено: {{ $products->total() }} товаров

        <div class="sort" x-data="{}">
            <span>Сортировать по</span>

            <form x-ref="sortForm" action="{{ route('catalog', $category) }}">
                <select name="sort" x-on:change="$refs.sortForm.submit()" class="form-select">
                    <option value="" class="text-dark">по умолчанию</option>
                    <option @selected(request('sort') === 'price') value="price" class="text-dark">от дешевых к
                        дорогим
                    </option>
                    <option @selected(request('sort') === '-price') value="-price" class="text-dark">от дорогих к
                        дешевым
                    </option>
                    <option @selected(request('sort') === 'title') value="title" class="text-dark">наименованию</option>
                </select>
            </form>
        </div>
        </div>

        <!-- Product list -->
        <div class="container products__container">
        <ul class="imdiz-products imdiz-products_row">
            <li class="product-wrapper">
                @each('components.product', $products, 'item')
            </li>
        </ul>
        </div>
        <div class="paginator">
            {{ $products->withQueryString()->links('vendor.pagination.bootstrap-4')}}
        </div>
    </section>
    </body>
@endsection
