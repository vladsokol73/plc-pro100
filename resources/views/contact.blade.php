@extends("layouts.contact")

@section("title", 'Обратная связь')

@section("content")
    <body>
    <div class="formBox">
        <h2>Связаться с нами</h2>
        <form onsubmit="document.querySelector('.info.container').textContent = 'Успешно отправлено.';"  method="post" action="{{ route('contact-save') }}">
            @csrf
            <div class="nameInp">
                <i class="fa fa-user icon"></i>
                <input type="text" placeholder="Имя" name="name" id="name" value="{{ old('name') }}" required min="2" max="15">
            </div>
            <div class="mailInp">
                <i class="fa fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Почта" required value="{{ old('email') }}">
            </div>
            <div class="phoneInp">
                <i class="fa-solid fa-phone"></i>
                <input type="number"  name="phone" id="phone" value="{{ old('phone') }}" placeholder="Телефон">
            </div>
            <div class="queryInp">
                    <textarea name="message" id="message" cols="30" rows="5"
                              placeholder="Ваше сообщение" minlength="10" maxlength="255"></textarea>
            </div>
            <div class="submitBtn">
                <button class="contact-btn" id="btn" type="submit">Отправить</button>
            </div>
            <div class="info container"></div>
        </form>
        <p class="extra">Вы так же можете связаться с нами: plc-pro100@mail.ru</p>
    </div>
    </body>
@endsection
