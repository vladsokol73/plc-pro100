@extends("layouts.app")

@section("title", $user->name ?? 'Каталог')

@section("content")
    <body>

    <ul class="step">
        <li><a href="{{ route('home') }}">Главная</a></li>
        <li><a href="{{ route('catalog') }}">Каталог</a></li>

        @if($category->exists)
            <li>
                <span>{{ $category->title }}</span>
            </li>
        @endif
    </ul>
    <section class="dropdown">
        <div class="dropdown-category" x-data="{ open: false }">
            <button @click="open = true"><h3>Категории</h3></button>

            <ul
                x-show="open"
                @click.away="open = false"
            >
                Содержимое дропдаун
            </ul>
        </div>

        <div x-data="{ open: false }">
            <button @click="open = true"><h3 class="mb-4">Бренды</h3></button>

            <ul
                x-show="open"
                @click.away="open = false"
            >
                @foreach($brands as $brand)
                    <input name="filters[brands][{{ $brand->id }}]"
                           value="{{ $brand->id }}"
                           type="checkbox"
                           @checked(request('filters.brands.'.$brand->id))
                           id="filters-brands-{{ $brand->id }}">

                    <label for="filters-brands-{{ $brand->id }}" class="form-checkbox-label">
                        {{ $brand->title }}
                    </label>
                @endforeach
            </ul>
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

                <!-- Filter item -->


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
        <div>
            Найдено: {{ $products->total() }} товаров
        </div>

        <div x-data="{}">
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

        <!-- Product list -->
        <div class="container">
            <div class="cards">
                @each('components.product', $products, 'item')
            </div>


            <div class="paginator">
                {{ $products->withQueryString()->links('vendor.pagination.bootstrap-4')}}
            </div>
        </div>
    </section>
    </body>
@endsection
