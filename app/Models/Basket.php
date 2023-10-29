<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Basket extends Model
{
    protected $fillable =[
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function getAmount()
    {
        $amount = 0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price;
        }
        return $amount;
    }
}
