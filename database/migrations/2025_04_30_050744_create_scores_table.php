<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id(); // score_id
            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
            $table->bigInteger('evaluator_id')->unsigned()->nullable(); // Add this line to match controller
            $table->text('comments')->nullable();
            $table->string('course_id');
            
            // Use integer columns instead of SET for scores (1-5)
            $table->json('professionalism');
            $table->json('commitment');
            $table->json('knowledge');
            $table->json('independent_learning');
            $table->json('management');
            $table->json('critical_factors');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
};