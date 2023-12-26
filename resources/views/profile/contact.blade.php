@extends("layouts.app")

@section("title", 'Обратная связь')

@section("content")
    <body>
    <div>
        <h1 class="page-title">Обратная связь</h1>
        <div class="contacts">
            @each('components.contact', $contacts, 'item')
        </div>
    </div>
    </body>
@endsection
