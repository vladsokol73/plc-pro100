<body>
<div class="col-md-4">
    <div class="product">
        @auth()
            @if(auth()->user()->role != 'продавец')
        <div class="image">
            <img src="{{$item->makeThumbnail('70x70')}}" alt="{{ $item->title }}">
        </div>
            @endif
        @endauth

        <div class="info">
            <h3>{{ $item->title }}</h3>
        </div>
        @auth()
            @if(auth()->user()->role == 'продавец')
                <form method="post" action="{{ route('removeBrand', $item->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Удалить брэнд</button>
                </form>

                <button
                    onclick="window.location.href = '{{ route('editBrand', $item->id) }}'"
                    type="button"
                    class="btn btn-warning">
                    Редактировать брэнд
                </button>
            @endif
        @endauth
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
