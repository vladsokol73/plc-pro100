@extends("layouts.auth")
@section("title")
    Регистрация
@endsection
@section("content")

    <section>
        <div class="form-box-register">
            <div class="form-value">
                <form method="post" action="{{ route("registerSubmit") }}">
                    @csrf
                    <h2>Регистрация</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <x-forms.text-input
                            name="name"
                            type="text"
                            required="true"
                            value="{{ old('name') }}"
                            :isError="$errors->has('email')"
                        />
                        <label for="">Имя Фамилия</label>
                    </div>

                    @error("name")
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror

                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <x-forms.text-input
                            name="email"
                            type="email"
                            required="true"
                            value="{{ old('email') }}"
                            :isError="$errors->has('email')"
                        />
                        <label for="">Почта</label>
                    </div>

                    @error("email")
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <x-forms.text-input
                            type="password"
                            name="password"
                            required="true"
                            :isError="$errors->has('password')"
                        />
                        <label for="">Пароль</label>
                    </div>

                    @error("password")
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <x-forms.text-input
                            type="password"
                            name="password_confirmation"
                            required="true"
                            :isError="$errors->has('password_confirmation')"
                        />
                        <label for="">Повторите пароль</label>
                    </div>

                    @error("password_confirmation")
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror

                    <x-forms.primary-button>Зарегестрироваться</x-forms.primary-button>
                    <div class="register">
                        <p>Уже есть аккаунт? <a href="{{ route("login") }}">Войти</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
