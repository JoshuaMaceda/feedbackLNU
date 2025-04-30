<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // database/migrations/xxxx_xx_xx_create_evaluations_table.php
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id(); // evaluation_id
            $table->string('teacher_id');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
            
            $table->foreignId('score_id')->nullable()->constrained('scores')->onDelete('set null');
            $table->foreignId('evaluator_id')->nullable()->constrained('users')->onDelete('cascade');

            $table->enum('source_type', ['student', 'peer', 'supervisor', 'self']);
            $table->string('course_id');
            $table->string('semester');
            $table->string('school_year');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};
