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
        Schema::create('tenant_subscription_logs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignIdFor(\App\Models\Tenant::class)->constrained('tenants')->onDelete('cascade'); // الشركة
            $table->integer('message_balance'); // Pricing for the package
            $table->foreignIdFor(\App\Models\SubscriptionPackage::class)->constrained('subscription_packages')->onDelete('cascade'); // الباقة
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_subscription_logs');
    }
};
