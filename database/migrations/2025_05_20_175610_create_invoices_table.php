<?php
// namespace App\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// use Illuminate\Database\Eloquent\Model;

// class Invoice extends Model
class CreateInvoicesTable extends Migration

{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::create('invoices', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id')->nullable();
        //     $table->string('order_id')->nullable();
        //     $table->string('invoice_id')->unique();
        //     $table->string('file_path');
        //     $table->decimal('amount', 10, 2);
        //     $table->string('currency', 10);
        //     $table->string('status')->default('generated');
        //     $table->timestamps();
        // });

         Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('invoice_id')->unique();
            $table->string('file_path');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10);
            $table->string('status')->default('generated');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
