<body>
        <div class="categories">
            <a class="category-filter" href="{{route('catalog', $item)}}">{{ $item->title }}</a>
        @auth()
            @if(auth()->user()->role == 'продавец')
                <form method="post" action="{{ route('removeCategory', $item->id) }}">
                    @csrf
                    <button type="submit" class="btn-admin">Удалить категорию</button>
                </form>

                <button
                    onclick="window.location.href = '{{ route('editCategory', $item->id) }}'"
                    type="button"
                    class="btn-admin">
                    Редактировать категорию
                </button>
            @endif
        @endauth
        </div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
