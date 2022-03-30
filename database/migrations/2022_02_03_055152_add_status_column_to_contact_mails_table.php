<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToContactMailsTable extends Migration
{
   
    public function up()
    {
        Schema::table('contact_mails', function (Blueprint $table) {
            $table->boolean('status')->default(false)->after('subject');
        });
    }


    public function down()
    {
        Schema::table('contact_mails', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
