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
        Schema::create('events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('thumbnail')->default('thumbnails/thumbnail.jpg');
            $table->string('location');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->string('coordination');
            $table->text('whyRejected')->nullable();
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->enum('validation', ['pending', 'rejected', 'approved']);
            $table->dateTime('started_at');
            $table->dateTime('end_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
