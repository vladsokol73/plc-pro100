{{--<header class="header">--}}
{{--    <div class="logo">--}}
{{--        <a href="{{ route('home') }}">PLC_Pro-100</a>--}}
{{--    </div>--}}
{{--    <div class="container">--}}
{{--        <form action="{{ route('catalog') }}">--}}
{{--            <input class="search-box" placeholder="Поиск по товарам" id="search" name="s" value="{{ request('s') }}" type="search">--}}
{{--            <button class="search-btn" type="submit">--}}
{{--                <box-icon name='search-alt-2'></box-icon>--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    <nav class="navbar">--}}
{{--        @auth()--}}
{{--            @if(auth()->user()->role == "покупатель")--}}
{{--                <a href="{{ route('catalog') }}">Каталог товаров</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('sellerCatalog') }}">Просмотр товаров</a>--}}
{{--            @endif--}}
{{--        @endauth--}}
{{--        @guest()--}}
{{--            <a href="{{ route('catalog') }}">Каталог товаров</a>--}}
{{--            <a href="{{ route('basket') }}">Корзина</a>--}}
{{--        @endguest--}}

{{--        @auth()--}}
{{--            @if(auth()->user()->role == "покупатель")--}}
{{--                <a href="{{ route('basket') }}">Корзина</a>--}}

{{--                <a href="{{ route('userOrders') }}">Профиль</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('sellerProfile') }}">Профиль</a>--}}

{{--            @endif--}}
{{--            <form id="logout" method="post" action="{{ route("logout") }}" class="button-logout">--}}
{{--                @csrf--}}
{{--                <a href="#" onclick="document.getElementById('logout').submit()">--}}
{{--                    Выйти--}}
{{--                </a>--}}
{{--            </form>--}}
{{--        @elseguest()--}}
{{--            <a href="{{ route('login') }}">Войти</a>--}}
{{--            <a href="{{ route('register') }}">Зарегистрироваться</a>--}}
{{--        @endauth--}}
{{--    </nav>--}}
{{--</header>--}}
<nav class="navbar">
    <div class="nav">
        <a href="{{ route('home') }}"><img src="/storage/images/logotip.jpg" class="brand-logo" alt=""></a>
        <div class="nav-items">
            <div class="search">
                <input type="search" class="search-box" placeholder="search brand, product">
                <button class="search-btn">search</button>
            </div>
            @auth()
                        @if(auth()->user()->role == "покупатель")
                            <a href="{{ route('catalog') }}">Каталог товаров</a>
                        @else
                            <a href="{{ route('sellerCatalog') }}">Просмотр товаров</a>
                        @endif
                    @endauth
                    @guest()
                        <a href="{{ route('catalog') }}">Каталог товаров</a>
                        <a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a>
                    @endguest

                    @auth()
                        @if(auth()->user()->role == "покупатель")
                            <a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a>

                            <a href="{{ route('userOrders') }}"><img src="/storage/images/user.png" alt=""></a>
                        @else
                            <a href="{{ route('sellerProfile') }}"><img src="/storage/images/user.png" alt=""></a>

                        @endif
                        <form id="logout" method="post" action="{{ route("logout") }}" class="button-logout">
                            @csrf
                            <a href="#" onclick="document.getElementById('logout').submit()">
                                <img src="/storage/images/logout.png" alt="">
                            </a>
                        </form>
                    @elseguest()
                        <a href="{{ route('login') }}">Войти</a>
                        <a href="{{ route('register') }}">Зарегистрироваться</a>
                    @endauth
        </div>
    </div>
</nav>

<ul class="links-container">
    <li class="link-item"><a href="#" class="link">Категории</a></li>
    <li class="link-item"><a href="#" class="link">Бренды</a></li>
    <li class="link-item"><a href="#" class="link">Способы покупки</a></li>
    <li class="link-item"><a href="#" class="link">Задать вопрос</a></li>
</ul>
