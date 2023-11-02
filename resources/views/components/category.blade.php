<body>
<div class="col-md-4">
    <div class="product">
        <div class="info">
            <a href="{{route('catalog', $item)}}">{{ $item->title }}</a>
        </div>
        @auth()
            @if(auth()->user()->role == 'продавец')
                <form method="post" action="{{ route('removeCategory', $item->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Удалить категорию</button>
                </form>

                <button
                    onclick="window.location.href = '{{ route('editCategory', $item->id) }}'"
                    type="button"
                    class="btn btn-warning">
                    Редактировать категорию
                </button>
            @endif
        @endauth
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
