@extends("layouts.app")

@section("title", 'Бренды')

@section("content")
    <body>
    <div>
        <h1 class="page-title">Все бренды</h1>
        @each('components.brand', $brands, 'item')
    </div>
    </body>
@endsection
