<header>
    <nav class="navbar">
        <div class="navbar-container container">
            <input type="checkbox" name="" id="">
            <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
            <a class="brand-logo" href="{{ route('home') }}"><img src="/storage/images/logotip.jpg" class="brand-logo" alt=""></a>
            <div class="nav-items">
                <li>
                    <div class="search">
                        <form class="search" action="{{ route('catalog') }}">
                            <input id="search" name="s" value="{{ request('s') }}" type="search" class="search-box"
                                   placeholder="поиск по названию, артиклу">
                            <button class="search-btn" type="submit">найти</button>
                        </form>
                    </div>
                </li>
                <li><a href="{{ route('catalog') }}">Каталог товаров</a></li>
                @auth()
                    @if(auth()->user()->role == "покупатель")
                        <li><a href="{{ route('showBrands') }}">Бренды</a></li>
                        <li><a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a></li>

                    @else
                        <li><a href="{{ route('sellerCatalog') }}">Админ панель</a></li>
                    @endif
                @endauth
                @guest()
                    <li><a href="{{ route('showBrands') }}">Бренды</a></li>
                    <li><a href="{{ route('basket') }}"><img src="/storage/images/cart.png" alt=""></a></li>
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
                <li><a class="a-contact" href="{{ route('contact') }}">Задать вопрос</a></li>
            </div>
        </div>
    </nav>

    <ul class="links-container">
        <div class="dropdown list">

            <li class="link-item categories">
                <button class='glowing-btn'><span class='glowing-txt'>К<span
                            class='faulty-letter'>А</span>ТЕГОРИИ</span></button>
            </li>

            <div class="dropdown-content list">
                <ul>
                    @foreach($categories as $category)
                        @if($category->parent_id == null)
                            <li><span><a href="{{route('catalog', $category)}}">{{$category->title}}
                                    </a></span><ion-icon name="chevron-forward-outline"></ion-icon>
                            <ul>
                                @foreach($categories as $subcategory)
                                    @if($subcategory->parent_id == $category->id)
                                        <li><span><a href="{{route('catalog', $subcategory)}}">{{$subcategory->title}}</a></span></li>
                                    @endif
                                @endforeach
                            </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </ul>
</header>
