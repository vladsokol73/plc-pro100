<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerCatalogController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Support\Facades\Route;

//Аутентификация
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', "register")->name("register");
    Route::post('/register', "registerSubmit")->name("registerSubmit");

    Route::get('/login', "login")->name("login");
    Route::post('/login', "loginSubmit")->name("loginSubmit");

    Route::post("/logout", "logOut")->name("logout");
});

//Каталог, деталка продукта, thumbnail
Route::middleware('web')->group(function () {
    Route::get('/catalog/{category:slug?}', CatalogController::class)->name('catalog');
    Route::get('/product/{product:slug?}', ProductController::class)->name('product');
    Route::get('/storage/images/{dir}/{method}/{size}/{file}', ThumbnailController::class)
    ->where('method', 'resize|crop|fit')
    ->where('size', '\d+x\d+')
    ->where('file', '.+\.(png|jpg|gif|bmp|jpeg)$')
    ->name('thumbnail');
});

//Управление корзиной
Route::controller(BasketController::class)->group(function () {
    //корзина
    Route::post('/basket/add/{id}', 'add')->name('basketAdd');
    Route::get('/basket', 'index')->name('basket');
    Route::post('/basket/remove/{id}', 'remove')->name('basketRemove');

    //оформление заказа
    Route::get('/basket/checkout', 'checkout')->name('checkout');
    Route::post('/basket/saveOrder', 'saveOrder')->name('saveOrder');
    Route::get('/basket/success', 'success')->name('basketSuccess');
});

//Профиль заказов
Route::controller(ProfileController::class)->group(function () {
    //Профиль заказов и деталка покупателя
    Route::get('user/orders', 'profile')->name('userOrders');
    Route::get('user/{order:id?}', 'userOrder')->name('userOrder');

    //Профиль продавца
    Route::get('seller/sold', 'sellerProfile')->name('sellerProfile');
});

//Панель управления продуктами продавца
Route::controller(SellerCatalogController::class)->group(function () {
    Route::get('/seller-catalog', 'show')->name('sellerCatalog');
    Route::get('/product-add', 'addProduct')->name('addProduct');
    Route::get('/edit-product/{id}', 'editProduct')->name('editProduct');
    Route::get('/blade-add', 'addBrand')->name('addBrand');
    Route::get('/edit-brand/{id}', 'editBrand')->name('editBrand');
    Route::post('/brand-save', 'saveBrand')->name('saveBrand');
    Route::post('/remove-brand/{id}', 'removeBrand')->name('removeBrand');
    Route::post('/update-brand/{id}', 'editBrandSubmit')->name('editBrandSubmit');
    Route::post('/product-save', 'saveProduct')->name('saveProduct');
    Route::post('/remove-product/{id}', 'removeProduct')->name('removeProduct');
    Route::post('/update-product/{id}', 'editProductSubmit')->name('editProductSubmit');
});

//Домой
Route::get('/', HomeController::class)->name("home");
