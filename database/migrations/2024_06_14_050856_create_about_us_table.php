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
        Schema::create('about_us', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('title');
          $table->string('image');
          $table->longText('description');
          $table->longText('what_to_do');
          $table->longText('what_we_are');
          $table->longText('our_aim_mission');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
