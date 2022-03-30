<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryDateColumnToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Carts', function (Blueprint $table) {
            $table->dateTime('delivery_date')->after('quantity');
            $table->longText('user_note')->after('delivery_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Carts', function (Blueprint $table) {
            $table->dropColumn('delivery_date');
            $table->dropColumn('user_note');
        });
    }
}
