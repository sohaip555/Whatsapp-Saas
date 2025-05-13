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
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the package
            $table->text('description')->nullable(); // Description of the package
            $table->integer('price', ); // Pricing for the package
            $table->integer('message_balance', ); // Pricing for the package
            $table->string('features')->nullable()->comment('Comma-separated features'); // Features included
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_packages');
    }
};
