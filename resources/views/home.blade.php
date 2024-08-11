<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! htmlScriptTagJsApi() !!}
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="shortcut icon" href="{{ url("/storage/images/icon.png") }}">
    <title>PLC Pro100 - интернет-магазин приборов и электронных компонентов</title>
    <meta name="description" content="PLC Pro100 - розничная и мелкооптовая продажа измерительных приборов, электронных компонентов, паяльного оборудования, инструментов, средств разработки и отладки, домашней техники и электроники, сопутствующих товаров">
    <meta name="keywords" content="автоматизация, электроника, газовое оборудование, микросхемы, гидравлика, датчик, контроллер, блок питания, коммутатор, реле, пневматика, привод, тормоз, разъем, china, siemens, wago, sew">
    <!-- Yandex.Metrika counter -->
    <meta name="yandex-verification" content="7ff4569a97fed783" />
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(95528226, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/95528226" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>

</html>

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
            <p>Цены на наши товары вы всегда можете уточнить связавшись с нами<br/>
                по почте burdin100@mail.ru или burdin100@outlook.com<br/>
                по номеру +7(929)794-94-31</p>
            <button class="button-write-us" onclick='location.href = "{{ route('contact') }}";'>Написать нам</button>
        </div>
    </section>
    <script src="js/home.js"></script>
    </body>
    @include("inc.footer")
@endsection


@yield("content")
