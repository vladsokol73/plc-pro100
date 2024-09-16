<?php

namespace App\Http\Controllers;

use App\Mail\OneClickSend;
use App\Models\Oneclick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OneClickController extends Controller
{
    public function SubmitForm(Request $request, $product_name)
    {
        // Form validation
        $this->validate($request, [
            'name' => 'required|max:30|min:2',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:20',
            'message' => 'required|max:255',
        ]);
        //  Store data in database
        $oneclick = Oneclick::query()->create(['product_name' => $product_name] + $request->all());
        Mail::to("Kirill18i.93@mail.ru")->queue(new OneClickSend($oneclick));
        return redirect()->back()->with('Успешно', 'Мы свяжемся с вами в ближайшее время.');
    }
}
