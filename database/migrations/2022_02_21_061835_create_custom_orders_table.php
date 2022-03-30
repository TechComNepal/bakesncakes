<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomOrdersTable extends Migration
{
   
    public function up()
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('email');
            $table->string('city');
            $table->string('address');
            $table->string('primary_number');
            $table->string('secondary_number');
            $table->integer('quantity');
            $table->dateTime('date');
            $table->text('description');      
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_orders');
    }
}
