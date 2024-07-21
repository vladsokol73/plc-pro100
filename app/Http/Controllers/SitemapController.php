<?php
namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $product = Product::query()->orderBy('updated_at', 'desc')->first();
        $category = Category::query()->orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'product' => $product,
            'category' => $category
        ])->header('Content-Type', 'text/xml');
    }

    public function products(): Response
    {
        $products = Product::query()->orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.products', [
            'products' => $products,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories(): Response
    {
        $categories = Category::query()->orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}
