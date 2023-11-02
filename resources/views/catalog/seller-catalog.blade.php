@extends("layouts.app")

@section("title", $user->name ?? 'Каталог')

@section("content")
    <body>
    @auth()
        @if(auth()->user()->role == "продавец")
            <button
                onclick="window.location.href = '{{ route('addProduct') }}'"
                type="button"
                class="btn btn-warning">
                Добавить товар
            </button>

            <button
                onclick="window.location.href = '{{ route('addBrand') }}'"
                type="button"
                class="btn btn-warning">
                Добавить производителя
            </button>

            <button
                onclick="window.location.href = '{{ route('addCategory') }}'"
                type="button"
                class="btn btn-warning">
                Добавить категорию
            </button>

            <div class="container">
                    <div class="cards">
                        @each('components.product', $products, 'item')
                    </div>
            </div>

            <div class="container1">
                    <div class="cards1">
                        @each('components.brand', $brands, 'item')
                    </div>
            </div>

            <div class="container1">
                    <div class="cards1">
                        @each('components.category', $category, 'item')
                    </div>
            </div>
        @endif
    @endauth

    <div class="paginator">
        {{ $products->withQueryString()->links('pagination::bootstrap-4')}}
    </div>
    </body>
@endsection
