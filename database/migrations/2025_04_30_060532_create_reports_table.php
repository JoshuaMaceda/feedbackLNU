<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id(); // report_id
            $table->string('teacher_id');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
            
            $table->foreignId('evaluation_period')->nullable()->constrained('evaluations')->onDelete('set null');

            $table->enum('student_score', ['student', 'peer', 'self']);
            $table->json('peer_score')->nullable();

            $table->text('comments')->nullable();
            $table->text('summary_metadata')->nullable();
            $table->text('llm_summary')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
