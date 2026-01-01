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
        Schema::create('global_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("website_name")->default("My Website");
            $table->string("website_logo")->default("/public/images/logo.png");
            $table->text("contact_numbers")->nullable();
            $table->string("contact_email")->nullable();
            $table->string("address")->nullable();
            $table->text("about_us")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_data');
    }
};
