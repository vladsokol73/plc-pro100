<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BasketController extends Controller
{
    //Страница корзины
    public function index(Request $request) {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->get();

        $basket_id = $request->cookie('basket_id');
        if (empty($basket_id)) {
            $basket = Basket::query()->create();
            $basket_id = $basket->id;
            $products = Basket::query()->findOrFail($basket_id)->products;
            return view('basket.index', ['products' => $products, 'categories' => $categories]);
        } else {
            $products = Basket::query()->findOrFail($basket_id)->products;
            return view('basket.index', ['products' => $products, 'categories' => $categories]);
        }
    }

    //Страница заказа
    public function checkout(Request $request) {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->get();

        return view('basket.checkout', ['categories' => $categories]);
    }

    //Добавление в корзину
    public function add(Request $request, $id) {
        $basket_id = $request->cookie('basket_id');
        //Если корзины ещё нет, создаем
        if (empty($basket_id)) {
            $basket = Basket::query()->create();
            $basket_id = $basket->id;

        // корзина уже существует, получаем объект корзины
        } else {
            $basket = Basket::query()->findOrFail($basket_id);
        }

        //обновляем зависимость
        if(!$basket->products->contains($id)) {
            $basket->products()->attach($id);
        }

        // выполняем редирект обратно на страницу, где была нажата кнопка «В корзину»
        return redirect()->route('catalog')->withCookie(cookie('basket_id', $basket_id, 525600));
    }

    //удаление из корзины
    public function remove(Request $request, $id) {
        $basket_id = $request->cookie('basket_id');
        if (empty($basket_id)) {
            abort(404);
        }
        $basket = Basket::query()->findOrFail($basket_id);
        if ($basket->products->contains($id)) {
            $pivotRow = $basket->products()->where('product_id', $id)->first()->pivot;
            $pivotRow->delete();
        }
        return redirect()
            ->route('basket')
            ->withCookie(cookie('basket_id', $basket_id, 525600));
    }

    //сохранение заказа
    public function saveOrder(Request $request) {
        $basket = Basket::query()->find($request->cookie('basket_id'));
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::query()->create(
            $request->all() + ['amount' => $basket->getAmount(), 'user_id' => $user_id]
        );

        foreach ($basket->products as $product) {
            $product->save();
            $order->items()->create([
                'product_id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
            ]);
        }
        // уничтожаем корзину
        Cookie::queue(Cookie::forget('basket_id'));
        $basket->delete();


        return redirect()
            ->route('basketSuccess')
            ->with('order_id', $order->id);
    }

    public function success(Request $request) {
        if ($request->session()->exists('order_id')) {
            $categories = Category::query()
                ->select(['id', 'title', 'slug'])
                ->has('products')
                ->get();
            // сюда покупатель попадает сразу после успешного оформления заказа
            $order_id = $request->session()->pull('order_id');
            $order = Order::query()->findOrFail($order_id);
            return view('basket.success', ['order' => $order, 'categories' => $categories]);
        } else {
            // если покупатель попал сюда случайно, не после оформления заказа, ему здесь делать нечего — отправляем на страницу корзины
            return redirect()->route('basket');
        }
    }
}
