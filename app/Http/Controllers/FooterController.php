<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactInfo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function police()
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();

        $contact = ContactInfo::query()->first();

        return view("footer.police", ['categories' => $categories, 'contact' => $contact]);
    }

    public function agreement()
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();

        $contact = ContactInfo::query()->first();

        return view("footer.agreement", ['categories' => $categories, 'contact' => $contact]);
    }
}
