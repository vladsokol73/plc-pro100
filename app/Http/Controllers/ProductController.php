<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactInfo;
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
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();

        $contact = ContactInfo::query()->first();

        return view('product.show', [
            'product' => $product, 'categories' => $categories, 'contact' => $contact
        ]);
    }
}
