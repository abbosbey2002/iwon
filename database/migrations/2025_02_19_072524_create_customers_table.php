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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nulable();
            $table->string('password')->nulable();
            $table->string('phone');
            $table->string('voucher_id');
            $table->string('mac_address')->nullable();
            $table->integer('days');
            $table->string('lang')->nullable();
            $table->integer('status')->default(0);
            $table->date('active_date')->nullable();
            $table->date('date_begin');
            $table->date('date_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
