<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ContactUsFormController extends Controller
{
    public function contact()
    {
        return view("contact");
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
        Contact::query()->create($request->all());
        //
        return redirect()->route('catalog')->with('Успешно', 'Мы свяжемся с вами в ближайшее время.');
    }
}
