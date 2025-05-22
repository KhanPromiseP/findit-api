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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_id')->unique();
            $table->string('tx_ref')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3);
            $table->string('status'); // successful, failed, pending
            $table->string('payment_method')->nullable();
            $table->string('customer_email');
            $table->text('failure_reason')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            
            // Add index for better performance on frequently queried columns
            $table->index(['status', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};