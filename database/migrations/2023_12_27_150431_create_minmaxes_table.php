<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('minmaxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')->on('product_items');
            $table->integer('stock')->nullable();
            $table->integer('stock_min')->nullable();
            $table->integer('stock_max')->nullable();
            $table->integer('safety_stock')->nullable();
            $table->integer('lead_time')->nullable();
            $table->integer('max_per')->nullable();
            $table->integer('rata_per')->nullable();
            $table->integer('restock')->nullable();
            $table->date('date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minmaxes');
    }
};
