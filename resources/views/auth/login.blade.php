@extends("layouts.auth")
@section("title", "Авторизация")

@section("content")
    <section>
    <div class="form-box">
        <div class="form-value">
        <form method="post" action="{{ route("loginSubmit") }}">
            @csrf
            <h2>Авторизация</h2>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <x-forms.text-input
                    name="email"
                    type="email"
                    required="true"
                    value="{{ old('email') }}"
                    :isError="$errors->has('email')"/>
                <label for="">Почта</label>
            </div>

            @error("email")
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror


            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input
                    type="password"
                    name="password"
                    required="true"
                    minlength="8"
                    :isError="$errors->has('email')"/>
                <label for="">Пароль</label>
            </div>

            @error("password")
            <x-forms.error>
                {{ $message }}
            </x-forms.error>
            @enderror

{{--            <div class="forget">--}}
{{--                <label for=""><input type="checkbox">Запомнить меня</label>--}}
{{--                <a href="#">Забыли пароль</a>--}}
{{--            </div>--}}

            <x-forms.primary-button>Войти</x-forms.primary-button>
    <div class="register">
        <p>Ещё нет аккаунта? <a href="{{ route("register") }}">Регистрация</a> </p>
    </div>
        </form>
        </div>
    </div>
    </section>
@endsection

