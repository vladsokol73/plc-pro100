<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class GenerateYandexFeed extends Command
{

// Вызов команды

    protected $signature = 'export:products {file}';

// Описание команды

    protected $description = 'Export products to an XML file';

// URL сайта

    public $SITE_URL = 'https://plc-pro100.ru/';

// Название сайта

    public $SITE_NAME = 'plc-pro100';
    public function handle()
    {
        $fileName = $this->argument('file');
        $filePath = 'public/export/' . $fileName;

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><yml_catalog date="'.date('Y-m-d\TH:i:sP').'"></yml_catalog>');
        $shop = $xml->addChild('shop');

        // Add static data
        $shop->addChild('name', $this->SITE_NAME);
        $shop->addChild('company', $this->SITE_NAME);
        $shop->addChild('url', $this->SITE_URL);
        $shop->addChild('platform', 'BSM/Yandex/Market');
        $shop->addChild('version', '2.6.2');

        // Add currencies
        $currencies = $shop->addChild('currencies');
        $currency = $currencies->addChild('currency');
        $currency->addAttribute('id', 'RUR');
        $currency->addAttribute('rate', '1');

        // Add categories
        $categories = $shop->addChild('categories');

        $productCategories = Category::query()->whereNull('parent_id')->get();

        // Get categories tree
        foreach ($productCategories as $productCategory) {
            $xmlCategory1 = $categories->addChild('category', $productCategory->title);
            $xmlCategory1->addAttribute('id', $productCategory->id);

            $productSubCategories = Category::query()->where('parent_id', $productCategory->id)->get();

            foreach ($productSubCategories as $productSubCategory) {
                $xmlCategory2 = $categories->addChild('category', $productSubCategory->title);
                $xmlCategory2->addAttribute('id', $productSubCategory->id);
                $xmlCategory2->addAttribute('parentId', $productCategory->id);
            }
        }

        // Add offers (products)
        $offers = $shop->addChild('offers');

        $products = Product::all();

        foreach ($products as $product) {
            $categoryId = 'null';
            foreach ($product->categories as $category) {
                if ($category->parent_id != null) {
                    $categoryId = $category->id;
                }
            }


            // Получаем  URL товара

            $url = $this->SITE_URL . 'product/' . $product->slug . '/';

            $offer = $offers->addChild('offer');
            $offer->addAttribute('id', $product->id);
            $offer->addAttribute('available', 'true');

            $offer->addChild('url', $url);
            $offer->addChild('price', $product->price);
            $offer->addChild('currencyId', 'RUR');
            $offer->addChild('categoryId', $categoryId);
            $offer->addChild('picture', $this->SITE_URL . str_replace('/storage/public/images/products', 'storage/images/products/resize/345x320', $product->thumbnail));
            $offer->addChild('name', $product->title);
            $offer->addChild('model', $product->article);
            $offer->addChild('vendor', $this->SITE_NAME);
            $offer->addChild('vendorCode', 1);
            $offer->addChild('description', $product->description);
        }

        // Save the XML to a file
        $xmlContent = $xml->asXML();
        Storage::put($filePath, $xmlContent);
        //dd($xmlContent);

        $this->info('Products exported successfully to ' . $filePath);
        return 0;
    }
}
