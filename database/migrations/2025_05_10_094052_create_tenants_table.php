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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');// اسم الشركة
            $table->string('email')->unique(); // البريد الإلكتروني للشركة
            $table->string('password');
            $table->string('phone')->unique()->nullable();
            $table->integer('message_balance')->nullable(); // عدد الرسائل المتاحة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
