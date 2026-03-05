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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // optionnel (ex: tâche cron)
            $table->string('action'); // ex: 'delete_order', 'update_product'
            $table->string('ip_address')->nullable();
            $table->string('location')->nullable(); // ex: pays, ville
            $table->string('user_agent')->nullable(); // navigateur, appareil
            $table->text('description')->nullable(); // description de l'action
            $table->timestamp('logged_at')->useCurrent(); // moment de l'action
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};