<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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

        return view('catalog.seller-catalog', [
            'products' => $products,
            'brands' => $brands,
        ]);
    }

    //страница добавления продукта
    public function addProduct(Request $request)
    {
        $brands = Brand::query()->paginate(9);
        return view('product.add', ['brands' => $brands]);
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
        Product::query()->create(
            ['user_id' => $user_id, 'thumbnail' => $path] + $request->all()
        );
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

    //страница добавления бренда
    public function addBrand(Request $request)
    {
        return view('brand.add');
    }

    //сохранить брэнд
    public function saveBrand(Request $request)
    {
        $name = 'public/images/brands/' . Str::random(6) . '.jpg';
        $path = '/storage/' . $name;
        Storage::put(
            $name,
            file_get_contents($request->file('thumbnail'))
        );
        Brand::query()->create(
            ['thumbnail' => $path] + $request->all()
        );
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

    //отправить ред.брэнд
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

    //отправить ред. продукт
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
}
