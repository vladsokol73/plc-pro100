<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oneclick extends Model
{
    use HasFactory;
    public $fillable = ['name', 'phone', 'message', 'product_name'];
}
