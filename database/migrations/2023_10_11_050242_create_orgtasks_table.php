<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orgtasks', function (Blueprint $table) {
            $table->string('date');
            $table->foreignId('creator_id')->constrained('users');
            $table->string('activity');
            $table->text('description');
            $table->boolean('completed')->default(false);
            $table->string('severity')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgtasks');
    }
};