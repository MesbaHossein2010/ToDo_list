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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();                // Auto-increment ID
            $table->string('name');     // Title column (varchar)
            $table->text('description');     // Content column (text)
            $table->enum('status', ['completed', 'not completed'])->default('not completed');     // Content column (text)
            $table->integer('phone_id')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks'); // Delete posts table
    }
};
