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
        Schema::create('fingerprint_actions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('fingerprint_id');
            $table->string('device_id')->nullable();
            $table->string('employee_id')->nullable();

            $table->string('action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fingerprint_actions');
    }
};
