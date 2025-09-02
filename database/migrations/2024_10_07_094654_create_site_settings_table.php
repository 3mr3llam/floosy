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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('default_lang')->default('ar');
			$table->string('default_payment')->nullable();
			$table->string('default_currancy')->default('IQD');
            $table->string('site_name')->nullable();
            $table->string('meta_title')->nullable(); //
            $table->string('meta_description')->nullable();
            $table->string('meta_keyWords')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('fav_icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
