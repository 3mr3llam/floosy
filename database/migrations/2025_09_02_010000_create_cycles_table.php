<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->dateTime('window_start');
            $table->dateTime('window_end');
            $table->decimal('total_net_amount', 12, 2)->default(0);
            $table->string('status')->default('pending'); // pending, suspended, scheduled, closed
            $table->timestamps();

            $table->index(['window_start', 'window_end']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
