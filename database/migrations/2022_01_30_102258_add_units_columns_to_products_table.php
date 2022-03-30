<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitsColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('units')->nullable();
            $table->boolean('order_custom_msg')->default(FALSE);
            $table->double('tax_amount',9,2)->nullable();
            $table->enum('tax_type',['flat', 'percent'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['units', 'order_custom_msg', 'tax_amount', 'tax_type']);
        });
    }
}
