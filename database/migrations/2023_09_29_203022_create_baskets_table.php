<?php

use App\Models\Basket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('basket_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('quantity')->default(1);

            $table->foreignIdFor(Basket::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\Product::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('basket_product');
            Schema::dropIfExists('baskets');
        }
    }
};
