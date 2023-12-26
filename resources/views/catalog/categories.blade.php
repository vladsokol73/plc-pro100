@extends("layouts.app")

@section("title", 'Категории')

@section("content")
    <body>
    <div>
        @each('components.category', $categories, 'item')
    </div>
    </body>
@endsection
