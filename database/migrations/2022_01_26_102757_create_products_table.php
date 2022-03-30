<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->double('cost_price', 9, 2);
            $table->double('selling_price', 9, 2);
            $table->text('tags')->nullable();
            $table->enum('discount_type', ['flat', 'percent'])->nullable();
            $table->integer('discount')->nullable();
            $table->boolean('is_taxable')->default(TRUE);
            $table->integer('quantity')->default(0); // unit
            $table->string('min_purchase_unit')->default(1);
            $table->boolean('is_refundable')->default(FALSE);
            $table->boolean('is_featured')->default(TRUE);
            $table->boolean('is_trending')->default(TRUE);
            $table->boolean('is_sellable')->default(TRUE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
