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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('cycle_id')->nullable()->constrained('cycles')->nullOnDelete();
            $table->string('reference')->unique();
            $table->decimal('gross_amount', 12, 2);
            $table->decimal('fee_amount', 12, 2)->default(0);
            $table->decimal('net_amount', 12, 2);
            $table->string('status')->default('pending'); // pending, suspended, scheduled, overdue, paid, not_received
            $table->dateTime('entered_at');
            $table->dateTime('scheduled_at')->nullable();
            $table->dateTime('overdue_at')->nullable();
            $table->dateTime('paid_at')->nullable();
            $table->dateTime('not_received_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['merchant_id', 'status']);
            $table->index(['status', 'entered_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
