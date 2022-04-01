<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSellerIdColumnToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('address_id')->nullable()->constrained('customer_shipping_addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('seller_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign('seller_id');
            $table->dropColumn('seller_id');
            $table->dropForeign('address_id');
            $table->dropColumn('address_id');
        });
    }
}
