<body>
<div class="brand">
    <form action="{{ route('catalog') }}" method="get">
        @if($item->thumbnail != null)
            @auth()
                @if(auth()->user()->role != 'продавец')
                    <div class="image">
                        <button class="button-filter" type="submit">
                            <input
                                class="filter"
                                name="filters[brands][{{ $item->id }}]"
                                value="{{ $item->id }}"
                                @checked(request('filters.brands.'.$item->id))
                                id="filters-brands-{{ $item->id }}">
                            <label for="filters-brands-{{ $item->id }}" class="checkbox-label">
                                <img src="{{$item->makeThumbnail('280x140')}}" alt="{{ $item->title }}">
                            </label>
                        </button>
                    </div>
                @endif

                @if(auth()->user()->role == 'продавец')
                    <div class="info">
                        <button class="button-filter" type="submit">
                        <input
                            class="filter"
                            name="filters[brands][{{ $item->id }}]"
                            value="{{ $item->id }}"
                            @checked(request('filters.brands.'.$item->id))
                            id="filters-brands-{{ $item->id }}">
                        <label for="filters-brands-{{ $item->id }}" class="checkbox-label">
                            <h3 class="category-title">{{ $item->title }}</h3>
                        </label>
                        </button>
                    </div>
                    <form method="post" action="{{ route('removeBrand', $item->id) }}">
                        @csrf
                        <button type="submit" class="btn-admin">Удалить брэнд</button>
                    </form>

                    <button
                        onclick="window.location.href = '{{ route('editBrand', $item->id) }}'"
                        type="button"
                        class="btn-admin">
                        Редактировать брэнд
                    </button>
                @endif

            @elseguest()
                <div class="image">
                    <button class="button-filter" type="submit">
                        <input
                            class="filter"
                            name="filters[brands][{{ $item->id }}]"
                            value="{{ $item->id }}"
                            @checked(request('filters.brands.'.$item->id))
                            id="filters-brands-{{ $item->id }}">
                        <label for="filters-brands-{{ $item->id }}" class="checkbox-label">
                            <img src="{{$item->makeThumbnail('280x140')}}" alt="{{ $item->title }}">
                        </label>

                    </button>
                </div>
            @endguest
        @endif
    </form>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
