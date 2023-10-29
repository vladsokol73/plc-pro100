<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProductController extends Controller
{
    //деталка продукта
    public function __invoke(Product $product): View|Application|Factory
    {

        return view('product.show', [
            'product' => $product,
        ]);
    }
}
