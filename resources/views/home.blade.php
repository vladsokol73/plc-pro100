<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/header.css">
    <title>@yield("title")</title>
</head>

</html>

@section("title")
    Главная
@endsection
@include("inc.header")
@section("content")
    <body>
    <section class="home">
        <div class="home-detail">
            <h3>PLC_Pro-100</h3>
            <h3>Интернет Магазин Продуктов Промышленной Автоматизации</h3>
            <p>Мы-поставщик новых деталей для автоматизации, поставляем промышленное электронное оборудование и
                компоненты для его ремонта в России.
                Наша компания помогает решить проблему в максимально короткие сроки.</p>
            <button onclick="Livewire.emit('openModal', 'contact-modal')">Написать нам</button>
        </div>
    </section>
    </body>
    @include("inc.footer")
@endsection


@yield("content")


