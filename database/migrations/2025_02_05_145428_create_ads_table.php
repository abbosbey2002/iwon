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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desktop');
            $table->string('mobile');
            $table->string('video')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
