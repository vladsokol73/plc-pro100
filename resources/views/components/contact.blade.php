<body>
<div class="contact">

    <p class="contact-p">Создано: {{$item->created_at}}</p>

    <p class="contact-p">Имя: {{$item->name}}</p>

    <p class="contact-p">Почта: {{$item->email}}</p>

    <p class="contact-p">Телефон: {{$item->phone}}</p>

    <p class="contact-p">Сообщение: {{$item->message}}</p>

    <form method="post" action="{{ route('removeContact', $item->id) }}">
        @csrf
        <button type="submit" class="btn-admin">Удалить</button>
    </form>
</div>
</body>
