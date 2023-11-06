<header>
<nav class="navbar">
    <div class="navbar-container container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <a href="{{ route('home') }}"><img src="/storage/images/logotip.jpg" class="brand-logo" alt=""></a>
        <div class="nav-items">
            <li><div class="search">
                <form class="search" action="{{ route('catalog') }}">
                    <input id="search" name="s" value="{{ request('s') }}" type="search" class="search-box"
                           placeholder="поиск по названию, артиклу">
                    <button class="search-btn" type="submit">найти</button>
                </form>
            </div>
            </li>
            @auth()
                @if(auth()->user()->role == "покупатель")
                    <li><a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a></li>
                    <li><a href="{{ route('catalog') }}">Каталог товаров</a></li>
                @else
                    <li><a href="{{ route('sellerCatalog') }}">Просмотр товаров</a></li>
                @endif
            @endauth
            @guest()
                <li><a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a></li>
                <li><a href="{{ route('catalog') }}">Каталог товаров</a></li>
            @endguest

            @auth()
                @if(auth()->user()->role == "покупатель")
                    <li><a href="{{ route('userOrders') }}"><img src="/storage/images/user.png" alt=""></a></li>
                @else
                    <li><a href="{{ route('sellerProfile') }}"><img src="/storage/images/user.png" alt=""></a></li>

                @endif
                <form id="logout" method="post" action="{{ route("logout") }}" class="button-logout">
                    @csrf
                    <li><a href="#" onclick="document.getElementById('logout').submit()">
                        <img src="/storage/images/logout.png" alt="">
                    </a></li>
                </form>
            @elseguest()
                <li><a href="{{ route('login') }}">Войти</a></li>
                <li><a href="{{ route('register') }}">Зарегистрироваться</a></li>
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
