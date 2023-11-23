<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function register() {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->get();

        return view("auth.register", ['categories' => $categories]);
    }

    public function login() {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->get();

        return view("auth.login", ['categories' => $categories]);
    }

    public function loginSubmit(LoginFormRequest $request): RedirectResponse
    {
        if(!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'Неверный логин или пароль',
            ])->onlyInput("email");
        }

        $request->session()->regenerate();

        return redirect()->intended(route("home"))
            ->with('success', 'Вы авторизовались');
    }

    public function registerSubmit(RegisterFormRequest $request): RedirectResponse
    {
        if ($request->get("password")!= $request->get("password_confirmation")) {

        }
        $user = User::query()->create([
            "name" => $request->get("name"),
            "email" => $request->get("email"),
            "password" => bcrypt($request->get("password"))
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->intended(route("home"))
            ->with('success', 'Авторизация прошла успешно');
    }

    public function logOut(): RedirectResponse
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->intended(route("home"));
    }
}
