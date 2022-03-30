<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_email');
            $table->string('company_phone');
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        \App\Models\Settings::create([
            'company_name' => 'Bakes And Cakes',
            'company_email' => 'bakesnadcakes@gmail.com',
            'company_phone' => '+977-9800000000',
            'website' => \Illuminate\Support\Facades\URL::to('/'),
            'address' => 'BaKes and Cakes',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
