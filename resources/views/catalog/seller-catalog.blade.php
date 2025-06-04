@extends("layouts.app")

@section("title", 'Админ панель')

@section("content")
    <body>
    @auth()
        @if(auth()->user()->role == "продавец")
            <div class="buttons">
            <button
                onclick="window.location.href = '{{ route('addProduct') }}'"
                type="button"
                class="btn-admin">
                Добавить товар
            </button>

            <button
                onclick="window.location.href = '{{ route('addBrand') }}'"
                type="button"
                class="btn-admin">
                Добавить производителя
            </button>

            <button
                onclick="window.location.href = '{{ route('addCategory') }}'"
                type="button"
                class="btn-admin">
                Добавить категорию
            </button>
            </div>

            <div class="buttons">
                <button
                    onclick="window.location.href = '{{ route('showBrands') }}'"
                    type="button"
                    class="btn-admin">
                    Все производители
                </button>

                <button
                    onclick="window.location.href = '{{ route('showCategories') }}'"
                    type="button"
                    class="btn-admin">
                    Все категории
                </button>

                <button
                    onclick="window.location.href = '{{ route('sellerContacts') }}'"
                    type="button"
                    class="btn-admin">
                    Обратная связь
                </button>

                <button
                    onclick="window.location.href = '{{ route('showContactInfo') }}'"
                    type="button"
                    class="btn-admin">
                    Информация для обратной связи
                </button>
            </div>
        @endif
    @endauth
    </body>
@endsection
