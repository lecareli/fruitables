<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('is_active')->default(true);
            $table->string('name');
            $table->double('price');
            $table->string('description');
            $table->string('image');
            $table->double('weight');
            $table->double('min_weight');
            $table->string('country_origin');
            $table->string('quality');
            $table->string('check');
            $table->foreignIdFor(Category::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
