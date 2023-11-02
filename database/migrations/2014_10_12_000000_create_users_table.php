<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("slug");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("name");
            $table->string('password');
            $table->enum("role", ['продавец', 'покупатель'])->default('покупатель');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('users');
        }
    }
};
