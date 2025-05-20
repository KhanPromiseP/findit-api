<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('help_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('color');
            $table->string('location');
            $table->string('contact');
            $table->text('description');
            $table->date('date_lost')->nullable();
            $table->string('reward')->nullable();
            $table->string('status')->default('pending'); // pending, in_progress, resolved
            $table->timestamps();
        });

        Schema::create('help_request_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('help_request_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('help_request_images');
        Schema::dropIfExists('help_requests');
    }
}