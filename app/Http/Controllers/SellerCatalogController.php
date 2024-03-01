<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class SellerCatalogController extends Controller
{
    //каталог продуктов продавца
    public function show(): View|Application|Factory
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->orderBy('title')
            ->get();

        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                return view('catalog.seller-catalog', ['categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    public function showBrands() {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->orderBy('title')
            ->get();

        $brands = Brand::query()
            ->orderBy('title')
            ->get();
        return view('catalog.brands', ['categories' => $categories, 'brands' => $brands]);
    }

    public function showCategories() {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->orderBy('title')
            ->get();

        if (auth()->check()) {
            if (auth()->user()->id == 1) {
        return view('catalog.categories', ['categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //страница добавления продукта
    public function addProduct(Request $request)
    {
        $categories = Category::query()->orderBy('title')->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $brands = Brand::query()->get();
                return view('product.add', ['brands' => $brands, 'categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //сохранение продукта
    public function saveProduct(Request $request)
    {
        $categories = Category::query()->findOrFail($request->get('category_id'));
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $user_id = auth()->check() ? auth()->user()->id : null;
                //переносим фотку на сервер
                $name = 'public/images/products/' . Str::random(6) . '.jpg';
                $path = '/storage/' . $name;
                Storage::put(
                    $name,
                    file_get_contents($request->file('thumbnail'))
                );
                if ($request->get('subcategory_id') != null) {
                    $subcategories = Category::query()->findOrFail($request->get('subcategory_id'));
                } else {
                    $subcategories = null;
                }
                $request->request->remove('category_id');
                $request->request->remove('subcategory_id');
                $product = Product::query()->create(
                    ['user_id' => $user_id, 'thumbnail' => $path] + $request->all()
                );
                $product->categories()->attach($categories);
                if ($subcategories != null) {
                    $product->categories()->attach($subcategories);
                }
                return redirect()->route('sellerCatalog');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //удаление продукта
    public function removeProduct(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $format = str_replace('/storage/', '', Product::query()->findOrFail($id)->thumbnail);
                Storage::delete($format);
                Product::query()->findOrFail($id)->delete();
                return redirect()->route('sellerCatalog');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }

    }

    //страница редактирования продукта
    public function editProduct(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->orderBy('title')
            ->get();
        $brands = Brand::query()->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $product = Product::query()->findOrFail($id);
                return view('product.edit', ['product' => $product, 'brands' => $brands, 'categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //сохр. ред. продукт
    public function editProductSubmit(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {

                //если передали новую фотку-обновляем
                if ($request->hasFile('thumbnail')) {
                    $format = str_replace('/storage/', '', Product::query()->findOrFail($id)->image);
                    Storage::delete($format);
                    $name = 'public/images/products/' . Str::random(6) . '.jpg';
                    $path = '/storage/' . $name;
                    Storage::put(
                        $name,
                        file_get_contents($request->file('thumbnail'))
                    );
                    Product::query()->findOrFail($id)->update(['thumbnail' => $path]);
                    $request->request->remove('thumbnail');
                }
                $category = Category::query()->findOrFail($request->get('category_id'));
                if ($request->get('subcategory_id') != null) {
                    $subcategory = Category::query()->findOrFail($request->get('subcategory_id'));
                } else {
                    $subcategory = null;
                }
                $request->request->remove('category_id');
                $request->request->remove('subcategory_id');
                $product = Product::query()->findOrFail($id)->update($request->all());
                $product->categories()->attach($category);
                if ($subcategory != null) {
                    $product->categories()->attach($subcategory);
                }
                return redirect()->route('sellerCatalog');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //страница добавления бренда
    public function addBrand(Request $request)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                return view('brand.add', ['categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //сохранить брэнд
    public function saveBrand(Request $request)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                if ($request->hasFile('thumbnail')){
                    $name = 'public/images/brands/' . Str::random(6) . '.jpg';
                    $path = '/storage/' . $name;
                    Storage::put(
                        $name,
                        file_get_contents($request->file('thumbnail'))
                    );
                }
                if ($request->hasFile('thumbnail')) {
                    Brand::query()->create(
                        ['thumbnail' => $path] + $request->all()
                    );
                } else {
                    Brand::query()->create($request->all());
                }
                return redirect()->route('showBrands');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //удалить брэнд
    public function removeBrand(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $format = str_replace('/storage/', '', Brand::query()->findOrFail($id)->thumbnail);
                Storage::delete($format);
                Brand::query()->findOrFail($id)->delete();
                return redirect()->route('showBrands');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //страница ред. брэнда
    public function editBrand(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $brand = Brand::query()->findOrFail($id);
                return view('brand.edit', ['brand' => $brand, 'categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //сохр. ред.брэнд
    public function editBrandSubmit(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $data = $request->all();
                if ($request->hasFile('thumbnail')) {
                    $format = str_replace('/storage/', '', Brand::query()->findOrFail($id)->thumbnail);
                    Storage::delete($format);
                    $name = 'public/images/brands/' . Str::random(6) . '.jpg';
                    $path = '/storage/' . $name;
                    Storage::put(
                        $name,
                        file_get_contents($request->file('thumbnail'))
                    );
                    $data['thumbnail'] = $path;
                }
                Brand::query()->findOrFail($id)->update($data);
                return redirect()->route('showBrands');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //страница добавления category
    public function addCategory(Request $request)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->where('parent_id', '=', null)
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                return view('category.add', ['categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //сохранить category
    public function saveCategory(Request $request)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->where('parent_id', '=', null)
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $category = Category::query()->create($request->all());
                return redirect()->route('showCategories');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //удалить category
    public function removeCategory(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->where('parent_id', '=', null)
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                Category::query()->findOrFail($id)->delete();
                return redirect()->route('showCategories');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //страница ред. category
    public function editCategory(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();

        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                $category = Category::query()->findOrFail($id);
                return view('category.edit', ['category' => $category, 'categories' => $categories]);
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }

    //сохр. ред.category
    public function editCategorySubmit(Request $request, $id)
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();
        if (auth()->check()) {
            if (auth()->user()->id == 1) {
                Category::query()->findOrFail($id)->update($request->all());
                return redirect()->route('showCategories');
            } else {
                abort(403);
            }
        } else {
            return view('auth.login', ['categories' => $categories]);
        }
    }
}
