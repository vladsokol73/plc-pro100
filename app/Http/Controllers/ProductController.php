<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = $product->categories;
        foreach ($categories as $category)
        $categories_titles = $category->title;

        return view('product.show', [
            'product' => $product,
        ]);
    }
}
