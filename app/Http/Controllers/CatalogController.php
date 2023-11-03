<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cookie;

class CatalogController extends Controller
{
    //каталог для покупателя
    public function __invoke(?Category $category): View|Application|Factory
    {
        $brands = Brand::query()
            ->select(['id', 'title'])
            ->has('products')
            ->get();

        $products = Product::query()
            ->when(request('s'), function (Builder $query) {
                $query->whereFullText(['title', 'article'], request('s'));
            })
            ->when($category->exists, function (Builder $query) use ($category) {
                $query->whereRelation(
                    'categories',
                    'categories.id',
                    '=',
                    $category->id
                );
            })
            ->filtered()
            ->sorted()
            ->paginate(12);

        $categories = Category::query()
            ->select(['id', 'title', 'slug'])
            ->has('products')
            ->get();

        return view('catalog.catalog', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'category' => $category
        ]);
    }
}
