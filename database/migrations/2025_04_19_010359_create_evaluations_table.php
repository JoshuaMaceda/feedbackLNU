<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                  ->constrained('users')->onDelete('cascade');
            $table->foreignId('evaluator_id')
                  ->constrained('users')->onDelete('cascade');
            $table->enum('source_type', ['student','peer','self']);
            $table->json('scores');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
