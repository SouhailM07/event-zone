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
            $table->id();
            $table->string("title");
            $table->text('description');
            $table->string("thumbnail")->default('');
            $table->string('location');
            $table->foreignId('userId')->constrained("users")->cascadeOnDelete();
            $table->string('coordination');
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->enum('validation',["pending","rejected",'approved']);
            $table->dateTime('stated_at');
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
