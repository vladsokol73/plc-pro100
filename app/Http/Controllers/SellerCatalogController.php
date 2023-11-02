<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerCatalogController extends Controller
{
    //каталог продуктов продавца
    public function show(): View|Application|Factory
    {
        $user_id = auth()->check() ? auth()->user()->id : null;
        $products = Product::query()
            ->where('user_id', '=', $user_id)
            ->paginate(9);

        $brands = Brand::query()
            ->paginate(9);

        $category = Category::query()->paginate(999);

        return view('catalog.seller-catalog', [
            'products' => $products,
            'brands' => $brands,
            'category' => $category
        ]);
    }

    //страница добавления продукта
    public function addProduct(Request $request)
    {
        $brands = Brand::query()->paginate(999);
        $categories = Category::query()->paginate(999);
        return view('product.add', ['brands' => $brands, 'categories' => $categories]);
    }

    //сохранение продукта
    public function saveProduct(Request $request)
    {
        $user_id = auth()->check() ? auth()->user()->id : null;
        //переносим фотку на сервер
        $name = 'public/images/products/' . Str::random(6) . '.jpg';
        $path = '/storage/' . $name;
        Storage::put(
            $name,
            file_get_contents($request->file('thumbnail'))
        );
        $categories = Category::query()->findOrFail($request->get('category_id'));
        $request->request->remove('category_id');
        $product = Product::query()->create(
            ['user_id' => $user_id, 'thumbnail' => $path] + $request->all()
        );
        $product->categories()->attach($categories);
        return redirect()->route('sellerCatalog');
    }

    //удаление продукта
    public function removeProduct(Request $request, $id)
    {
        $format = str_replace('/storage/', '', Product::query()->findOrFail($id)->thumbnail);
        Storage::delete($format);
        Product::query()->findOrFail($id)->delete();
        return redirect()->route('sellerCatalog');
    }

    //страница редактирования продукта
    public function editProduct(Request $request, $id)
    {
        $product = Product::query()->findOrFail($id);
        return view('product.edit', ['product' => $product]);
    }

    //сохр. ред. продукт
    public function editProductSubmit(Request $request, $id)
    {
        $data = $request->all();
        //если передали новую фотку-обновляем
        if ($request->hasFile('image')) {
            $format = str_replace('/storage/', '', Product::query()->findOrFail($id)->image);
            Storage::delete($format);
            $name = 'images/' . Str::random(6) . '.jpg';
            $path = '/storage/' . $name;
            Storage::put(
                $name,
                file_get_contents($request->file('image'))
            );
            $data['image'] = $path;
        }
        Product::query()->findOrFail($id)->update($data);
        return redirect()->route('sellerCatalog');
    }

    //страница добавления бренда
    public function addBrand(Request $request)
    {
        return view('brand.add');
    }

    //сохранить брэнд
    public function saveBrand(Request $request)
    {
        if ($request->hasFile('image')){
            $name = 'public/images/brands/' . Str::random(6) . '.jpg';
            $path = '/storage/' . $name;
            Storage::put(
                $name,
                file_get_contents($request->file('thumbnail'))
            );
        }
        if ($request->hasFile('image')) {
            Brand::query()->create(
                ['thumbnail' => $path] + $request->all()
            );
        } else {
            Brand::query()->create($request->all());
        }
        return redirect()->route('sellerCatalog');
    }

    //удалить брэнд
    public function removeBrand(Request $request, $id)
    {
        $format = str_replace('/storage/', '', Brand::query()->findOrFail($id)->thumbnail);
        Storage::delete($format);
        Brand::query()->findOrFail($id)->delete();
        return redirect()->route('sellerCatalog');
    }

    //страница ред. брэнда
    public function editBrand(Request $request, $id)
    {
        $brand = Brand::query()->findOrFail($id);
        return view('brand.edit', ['brand' => $brand]);
    }

    //сохр. ред.брэнд
    public function editBrandSubmit(Request $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $format = str_replace('/storage/', '', Brand::query()->findOrFail($id)->thumbnail);
            Storage::delete($format);
            $name = 'images/' . Str::random(6) . '.jpg';
            $path = '/storage/' . $name;
            Storage::put(
                $name,
                file_get_contents($request->file('image'))
            );
            $data['image'] = $path;
        }
        Brand::query()->findOrFail($id)->update($data);
        return redirect()->route('sellerCatalog');
    }

    //страница добавления category
    public function addCategory(Request $request)
    {
        return view('category.add');
    }

    //сохранить category
    public function saveCategory(Request $request)
    {
        Category::query()->create($request->all());
        return redirect()->route('sellerCatalog');
    }

    //удалить category
    public function removeCategory(Request $request, $id)
    {
        Category::query()->findOrFail($id)->delete();
        return redirect()->route('sellerCatalog');
    }

    //страница ред. category
    public function editCategory(Request $request, $id)
    {
        $category = Category::query()->findOrFail($id);
        return view('category.edit', ['category' => $category]);
    }

    //сохр. ред.category
    public function editCategorySubmit(Request $request, $id)
    {
        $data = $request->all();
        Category::query()->findOrFail($id)->update($data);
        return redirect()->route('sellerCatalog');
    }
}
