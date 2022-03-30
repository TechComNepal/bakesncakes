<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactMailsTable extends Migration
{
   
    public function up()
    {
        Schema::create('contact_mails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('number');
            $table->string('subject');
            $table->text('usermessage');            
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('contact_mails');
    }
}
