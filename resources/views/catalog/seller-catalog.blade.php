@extends("layouts.app")

@section("title", $user->name ?? 'Каталог')

@section("content")
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

            <div class="card-columns">
                <section class="mt-16 lg:mg-24">
                    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
                        @each('components.product', $products, 'item')
                    </div>
                </section>
            </div>

            <div class="card-columns">
                <section class="mt-16 lg:mg-24">
                    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
                        @each('components.brand', $brands, 'item')
                    </div>
                </section>
            </div>
        @endif
    @endauth

    <div class="paginator">
        {{ $products->withQueryString()->links('pagination::bootstrap-4')}}
    </div>
@endsection
