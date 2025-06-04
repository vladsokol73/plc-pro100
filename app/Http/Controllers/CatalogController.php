<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactInfo;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;

class CatalogController extends Controller
{
    //каталог для покупателя
    public function __invoke(?Category $category): View|Application|Factory
    {
        $brands = Brand::query()
            ->select(['id', 'title'])
            ->has('products')
            ->get();

        $products = Product::search(request('s'))
            ->query(function (Builder $query) use ($category) {
            $query->when($category->exists, function (Builder $query) use ($category) {
                $query->whereRelation(
                    'categories',
                    'categories.id',
                    '=',
                    $category->id
                );
            })
                ->filtered()
                ->sorted();
        })
            ->paginate(16);

        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();

        $contact = ContactInfo::query()->first();

        return view('catalog.catalog', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'category' => $category,
            'contact' => $contact,
        ]);
    }
}
