<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->float('temp_min')->default(18);
            $table->float('temp_max')->default(25);
            $table->float('hum_min')->default(40);
            $table->float('hum_max')->default(60);
            $table->float('pres_min')->default(500);
            $table->float('pres_max')->default(1013);
            $table->boolean('enable_notifications')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}; 