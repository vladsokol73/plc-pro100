<?php

namespace App\Http\Controllers;

use App\Mail\ContactSend;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactInfo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsFormController extends Controller
{
    public function contact()
    {
        $categories = Category::query()
            ->select(['id', 'title', 'slug', 'parent_id'])
            ->has('products')
            ->orderBy('title')
            ->get();

        $contact = ContactInfo::query()->first();

        return view("contact", ['categories' => $categories, 'contact' => $contact]);
    }

    // Store Contact Form data
    public function SubmitForm(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:20',
            'message' => 'required'
        ]);
        //  Store data in database
        $contact = ContactInfo::query()->create($request->all());
        Mail::to("Kirill18i.93@mail.ru")->queue(new ContactSend($contact));
        return redirect()->route('catalog')->with('Успешно', 'Мы свяжемся с вами в ближайшее время.');
    }
}
