<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('variant_id');
            $table->integer('quantity');
            $table->timestamp('added_at')->useCurrent();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('variant_id')->references('variant_id')->on('product_variants');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};