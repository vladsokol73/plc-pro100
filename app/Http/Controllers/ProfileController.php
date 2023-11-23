<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //профиль покупателя с заказами
    public function profile(Request $request) {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->get();

        $user_id = auth()->check() ? auth()->user()->id : null;
        $orders = User::query()
            ->findOrFail($user_id)
            ->orders;
        return view('profile.user', ['orders' => $orders, 'categories' => $categories]);
    }

    //деталка заказа
    public function userOrder(Order $order) {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->get();

        if (auth()->check()) {
        $user_id = auth()->user()->id;
        if ($user_id == $order->user_id or $user_id == 1) {
            return view('profile.order', ['order' => $order, 'categories' => $categories]);
        } else {
            abort(404);
        }
        } else {
            return view('auth.login');
        }
    }

    //профиль продавца
    public function sellerProfile() {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->get();

        $user_id = auth()->check() ? auth()->user()->id : null;
        $orders = Order::query()->get();

        return view('profile.seller', ['orders' => $orders, 'categories' => $categories]);
    }
}
