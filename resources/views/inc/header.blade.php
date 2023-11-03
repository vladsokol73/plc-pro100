<header>
<nav class="navbar">
    <div class="nav">
        <a href="{{ route('home') }}"><img src="/storage/images/logotip.jpg" class="brand-logo" alt=""></a>
        <div class="nav-items">
            <div class="search">
                <form class="search" action="{{ route('catalog') }}">
                    <input id="search" name="s" value="{{ request('s') }}" type="search" class="search-box"
                           placeholder="поиск по названию, артиклу">
                    <button class="search-btn" type="submit">найти</button>
                </form>
            </div>
            @auth()
                @if(auth()->user()->role == "покупатель")
                    <a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a>
                    <a href="{{ route('catalog') }}">Каталог товаров</a>
                @else
                    <a href="{{ route('sellerCatalog') }}">Просмотр товаров</a>
                @endif
            @endauth
            @guest()
                <a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a>
                <a href="{{ route('catalog') }}">Каталог товаров</a>
            @endguest

            @auth()
                @if(auth()->user()->role == "покупатель")
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
    <li class="link-item"><a href="{{ route('contact') }}" class="link">Задать вопрос</a></li>
</ul>
</header>
