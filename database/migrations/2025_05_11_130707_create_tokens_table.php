<?php

use App\Models\CompanySubscriptionLog;
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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CompanySubscriptionLog::class)->constrained();
            $table->string('token', 64); // Unique token for the record
            $table->boolean('isActive')->default(false);
            $table->unsignedInteger('message_quota'); // Total message quota
            $table->foreignIdFor(\App\Models\Company::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
