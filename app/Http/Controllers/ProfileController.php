<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //профиль покупателя с заказами
    public function profile(Request $request) {
        $user_id = auth()->check() ? auth()->user()->id : null;
        $orders = User::query()
            ->findOrFail($user_id)
            ->orders;
        return view('profile.user', compact('orders'));
    }

    //деталка заказа
    public function userOrder(Order $order) {
        return view('profile.order', compact('order'));
    }

    //профиль продавца
    public function sellerProfile() {
        $user_id = auth()->check() ? auth()->user()->id : null;
        $products = Product::query()
            ->where('user_id', '=', $user_id)
            ->where('on_catalog_page', '=', false)
        ->get();
        return view('profile.seller', compact('products'));
    }
}
