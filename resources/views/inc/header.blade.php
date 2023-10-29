<header class="header">
    <div class="logo">
        <a href="{{ route('home') }}">PLC_Pro-100</a>
    </div>
    <div class="container">
        <form action="{{ route('catalog') }}">
            <input placeholder="Поиск по товарам" id="search" name="s" value="{{ request('s') }}" type="search">
            <button type="submit"><box-icon name='search-alt-2'></box-icon></button>
        </form>
    </div>
    <nav class="navbar">
        @auth()
            @if(auth()->user()->role == "покупатель")
                <a href="{{ route('catalog') }}">Каталог товаров</a>
            @else
                <a href="{{ route('sellerCatalog') }}">Просмотр товаров</a>
            @endif
        @endauth
        @guest()
            <a href="{{ route('catalog') }}">Каталог товаров</a>
        @endguest

            @auth()
                @if(auth()->user()->role == "покупатель")
                   <a href="{{ route('basket') }}">Корзина</a>

                    <a href="{{ route('userOrders') }}">Профиль</a>
                @else
                    <a href="{{ route('sellerProfile') }}">Профиль</a>

                @endif
                <form id="logout" method="post" action="{{ route("logout") }}" class="button-logout">
                    @csrf
                        <a href="#" onclick="document.getElementById('logout').submit()">
                        Выйти
                        </a>
                </form>
            @elseguest()
                <a href="{{ route('login') }}">Войти</a>
                <a href="{{ route('register') }}">Зарегистрироваться</a>
        @endauth
    </nav>
</header>
